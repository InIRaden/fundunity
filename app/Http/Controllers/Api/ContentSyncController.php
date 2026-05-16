<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUsItem;
use App\Models\Faq;
use App\Models\FocusArea;
use App\Models\GalleryItem;
use App\Models\ImageSlider;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContentSyncController extends Controller
{
    public function sync(): JsonResponse
    {
        $homePage = Page::where('slug', 'home')->first();
        $aboutPage = Page::where('slug', 'about')->first();

        $settingKeys = [
            'site_name',
            'site_short_name',
            'site_logo',
            'identity_tagline',
            'email',
            'phone',
            'instagram_url',
            'address',
            'newsletter_title',
            'newsletter_description',
            'newsletter_cta_text',
            'newsletter_placeholder',
            'legal_privacy_policy',
            'legal_terms_conditions',
        ];

        $settings = SiteSetting::query()
            ->whereIn('key', $settingKeys)
            ->pluck('value', 'key');

        return response()->json([
            'meta' => [
                'generated_at' => now()->toISOString(),
                'source' => 'database',
            ],
            'site_settings' => $settings,
            'home' => [
                'slug' => 'home',
                'meta_title' => $homePage?->meta_title,
                'hero_title' => $homePage?->hero_title,
                'hero_subtitle' => $homePage?->hero_subtitle,
                'hero_image' => $homePage?->hero_image,
                'hero_btn_primary_text' => $homePage?->hero_btn_primary_text,
                'hero_btn_primary_url' => $homePage?->hero_btn_primary_url,
                'hero_btn_secondary_text' => $homePage?->hero_btn_secondary_text,
                'hero_btn_secondary_url' => $homePage?->hero_btn_secondary_url,
            ],
            'about' => [
                'slug' => 'about',
                'meta_title' => $aboutPage?->meta_title,
                'vision_title' => $aboutPage?->vision_title,
                'vision_content' => $aboutPage?->vision_content,
                'mission_title' => $aboutPage?->mission_title,
                'story_title' => $aboutPage?->story_title,
                'story_content' => $aboutPage?->story_content,
                'team_section_title' => $aboutPage?->team_section_title,
                'team_section_subtitle' => $aboutPage?->team_section_subtitle,
                'mission_items' => $this->getMissionItems(),
                'organization_values' => $this->getOrganizationValues(),
                'team_members' => $this->getTeamMembers(),
                'impact_stats' => $this->getImpactStats(),
                'general_profile' => $this->getGeneralProfile(),
                'structure_profile' => $this->getStructureProfile(),
            ],
            'sliders' => ImageSlider::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'programs' => Program::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'focus_areas' => FocusArea::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'gallery' => GalleryItem::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'partners' => Partner::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'faqs' => Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
            'involvement_types' => $this->getInvolvementTypes(),
            'involvement_benefits' => $this->getInvolvementBenefits(),
        ]);
    }

    public function about(): JsonResponse
    {
        $aboutPage = Page::where('slug', 'about')->first();

        return response()->json([
            'data' => [
                'slug' => 'about',
                'meta_title' => $aboutPage?->meta_title,
                'vision_title' => $aboutPage?->vision_title,
                'vision_content' => $aboutPage?->vision_content,
                'mission_title' => $aboutPage?->mission_title,
                'story_title' => $aboutPage?->story_title,
                'story_content' => $aboutPage?->story_content,
                'team_section_title' => $aboutPage?->team_section_title,
                'team_section_subtitle' => $aboutPage?->team_section_subtitle,
                'mission_items' => $this->getMissionItems(),
                'organization_values' => $this->getOrganizationValues(),
                'team_members' => $this->getTeamMembers(),
                'impact_stats' => $this->getImpactStats(),
                'general_profile' => $this->getGeneralProfile(),
                'structure_profile' => $this->getStructureProfile(),
            ],
        ]);
    }

    public function programs(): JsonResponse
    {
        return response()->json([
            'data' => Program::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function focusAreas(): JsonResponse
    {
        return response()->json([
            'data' => FocusArea::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function gallery(): JsonResponse
    {
        return response()->json([
            'data' => GalleryItem::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function partners(): JsonResponse
    {
        return response()->json([
            'data' => Partner::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function faqs(): JsonResponse
    {
        return response()->json([
            'data' => Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function getInvolved(): JsonResponse
    {
        return response()->json([
            'types' => $this->getInvolvementTypes(),
            'benefits' => $this->getInvolvementBenefits(),
        ]);
    }

    private function getInvolvementTypes(): array
    {
        if (! Schema::hasTable('involvement_types')) {
            return [];
        }

        return DB::table('involvement_types')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'icon' => $item->icon,
                    'button_text' => $item->button_text,
                    'form_type' => $item->form_type,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getInvolvementBenefits(): array
    {
        if (! Schema::hasTable('involvement_benefits')) {
            return [];
        }

        return DB::table('involvement_benefits')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'icon' => $item->icon,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getMissionItems(): array
    {
        if (! Schema::hasTable('mission_items')) {
            return [];
        }

        return DB::table('mission_items')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'text' => $item->text,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getOrganizationValues(): array
    {
        if (! Schema::hasTable('organization_values')) {
            return [];
        }

        return DB::table('organization_values')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'icon' => $item->icon,
                    'color' => $item->color,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getTeamMembers(): array
    {
        if (! Schema::hasTable('team_members')) {
            return [];
        }

        return DB::table('team_members')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'position' => $item->position,
                    'bio' => $item->bio,
                    'photo' => $item->photo,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getImpactStats(): array
    {
        if (! Schema::hasTable('impact_stats')) {
            return [];
        }

        return DB::table('impact_stats')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (object $item): array {
                return [
                    'id' => $item->id,
                    'label' => $item->label,
                    'value' => $item->value,
                    'icon' => $item->icon,
                    'sort_order' => $item->sort_order,
                    'is_active' => (bool) $item->is_active,
                ];
            })
            ->all();
    }

    private function getGeneralProfile(): array
    {
        return AboutUsItem::where('section', 'general')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (AboutUsItem $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'image_url' => $item->image_url,
                    'sort_order' => $item->sort_order,
                ];
            })
            ->all();
    }

    private function getStructureProfile(): array
    {
        return AboutUsItem::where('section', 'structure')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(static function (AboutUsItem $item): array {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'position' => $item->position,
                    'description' => $item->description,
                    'image_url' => $item->image_url,
                    'sort_order' => $item->sort_order,
                ];
            })
            ->all();
    }
}
