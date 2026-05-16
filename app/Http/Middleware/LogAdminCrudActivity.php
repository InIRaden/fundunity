<?php

namespace App\Http\Middleware;

use App\Models\AdminActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LogAdminCrudActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()?->getName();
        $action = $this->resolveAction($request, $routeName);

        if ($action === null) {
            return $next($request);
        }

        $resource = $this->resolveResource($routeName);
        $resourceId = $this->resolveResourceId($request);
        $payload = $this->sanitizePayload(array_merge(
            $request->except([
                '_token',
                '_method',
                'password',
                'password_confirmation',
                'current_password',
                'new_password',
            ]),
            $request->allFiles()
        ));

        $response = $next($request);

        if ($response->getStatusCode() >= 400) {
            return $response;
        }

        try {
            $resourceLabel = $this->resolveResourceLabel($resource, $request->route('type'));
            $responseMessage = $this->extractResponseMessage($response);

            AdminActivityLog::create([
                'user_id' => $request->user()?->id,
                'route_name' => $routeName,
                'http_method' => strtoupper($request->method()),
                'action' => $action,
                'resource' => $resource,
                'resource_id' => $resourceId,
                'title' => $this->resolveTitle($action, $resourceLabel),
                'description' => $responseMessage ?: $this->resolveDescription($action, $resourceLabel, $resourceId),
                'payload' => empty($payload) ? null : $payload,
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
            ]);
        } catch (\Throwable) {
            // Logging should never break CRUD execution.
        }

        return $response;
    }

    private function resolveAction(Request $request, ?string $routeName): ?string
    {
        if (! $routeName || ! Str::startsWith($routeName, 'admin.')) {
            return null;
        }

        if (! in_array(strtoupper($request->method()), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return null;
        }

        if (Str::endsWith($routeName, '.store')) {
            return 'create';
        }

        if (Str::endsWith($routeName, '.update')) {
            return 'update';
        }

        if (Str::endsWith($routeName, '.destroy')) {
            return 'delete';
        }

        return null;
    }

    private function resolveResource(?string $routeName): string
    {
        $name = Str::after((string) $routeName, 'admin.');

        foreach (['store', 'update', 'destroy'] as $suffix) {
            if (Str::endsWith($name, '.'.$suffix)) {
                return Str::beforeLast($name, '.'.$suffix);
            }
        }

        return $name;
    }

    private function resolveResourceId(Request $request): ?string
    {
        $route = $request->route();
        if (! $route) {
            return null;
        }

        foreach ($route->parameters() as $key => $value) {
            if ($key === 'type') {
                continue;
            }

            if (is_object($value) && method_exists($value, 'getKey')) {
                return (string) $value->getKey();
            }

            if (is_scalar($value)) {
                return (string) $value;
            }
        }

        return null;
    }

    private function resolveResourceLabel(string $resource, mixed $stakeType): string
    {
        if ($resource === 'databasestakeholder') {
            $stakeLabel = match ((string) $stakeType) {
                'donatur' => 'Stakeholder Donatur',
                'penerima' => 'Stakeholder Penerima Bantuan',
                'relawan' => 'Stakeholder Relawan',
                default => 'Stakeholder',
            };

            return $stakeLabel;
        }

        $labels = [
            'campaign' => 'Campaign',
            'messages' => 'Pesan',
            'aboutus' => 'Profil Lembaga',
            'focusareas' => 'Fokus Area',
            'faqs' => 'FAQ',
            'partners' => 'Mitra',
            'gallery' => 'Galeri',
            'imageslider' => 'Banner Slider',
            'identity' => 'Identitas Website',
            'programs' => 'Program',
            'focus-areas' => 'Fokus Area',
            'gallery-items' => 'Item Galeri',
        ];

        if (array_key_exists($resource, $labels)) {
            return $labels[$resource];
        }

        return Str::title(str_replace(['-', '.'], ' ', $resource));
    }

    private function resolveTitle(string $action, string $resourceLabel): string
    {
        return match ($action) {
            'create' => 'Menambahkan '.$resourceLabel,
            'update' => 'Memperbarui '.$resourceLabel,
            'delete' => 'Menghapus '.$resourceLabel,
            default => 'Aktivitas Admin',
        };
    }

    private function resolveDescription(string $action, string $resourceLabel, ?string $resourceId): string
    {
        $verb = match ($action) {
            'create' => 'Data baru ditambahkan untuk',
            'update' => 'Data berhasil diperbarui pada',
            'delete' => 'Data berhasil dihapus dari',
            default => 'Aktivitas tercatat pada',
        };

        $suffix = $resourceId ? ' (ID: '.$resourceId.')' : '.';

        return $verb.' '.$resourceLabel.$suffix;
    }

    private function extractResponseMessage(Response $response): ?string
    {
        $content = $response->getContent();
        if (! $content) {
            return null;
        }

        $decoded = json_decode($content, true);
        if (! is_array($decoded)) {
            return null;
        }

        $message = $decoded['message'] ?? null;

        return is_string($message) ? Str::limit($message, 1000) : null;
    }

    private function sanitizePayload(mixed $value): mixed
    {
        if ($value instanceof UploadedFile) {
            return [
                'filename' => $value->getClientOriginalName(),
                'mime' => $value->getClientMimeType(),
                'size' => $value->getSize(),
            ];
        }

        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = $this->sanitizePayload($item);
            }

            return $result;
        }

        if (is_string($value)) {
            return Str::limit($value, 2000);
        }

        if (is_bool($value) || is_numeric($value) || $value === null) {
            return $value;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return Str::limit((string) $value, 2000);
        }

        return null;
    }
}
