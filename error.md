# Illuminate\Database\QueryException - Internal Server Error

SQLSTATE[42S22]: Column not found: 1054 Unknown column 'status' in 'where clause' (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: fundinity, SQL: select count(*) as aggregate from `volunteers` where `status` = aktif)

PHP 8.2.4
Laravel 12.52.0
127.0.0.1:8000

## Stack Trace

0 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:838
1 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:794
2 - vendor\laravel\framework\src\Illuminate\Database\Connection.php:411
3 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3438
4 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3423
5 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:4013
6 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3422
7 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3937
8 - vendor\laravel\framework\src\Illuminate\Database\Query\Builder.php:3865
9 - vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php:2235
10 - app\Http\Controllers\LandingController.php:58
11 - vendor\laravel\framework\src\Illuminate\Routing\ControllerDispatcher.php:46
12 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:265
13 - vendor\laravel\framework\src\Illuminate\Routing\Route.php:211
14 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:822
15 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
16 - app\Http\Middleware\EnsurePublicSiteAvailable.php:24
17 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
18 - vendor\laravel\framework\src\Illuminate\Routing\Middleware\SubstituteBindings.php:50
19 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
20 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken.php:87
21 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
22 - vendor\laravel\framework\src\Illuminate\View\Middleware\ShareErrorsFromSession.php:48
23 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
24 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:120
25 - vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php:63
26 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
27 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse.php:36
28 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
29 - vendor\laravel\framework\src\Illuminate\Cookie\Middleware\EncryptCookies.php:74
30 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
31 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
32 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:821
33 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:800
34 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:764
35 - vendor\laravel\framework\src\Illuminate\Routing\Router.php:753
36 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:200
37 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:180
38 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
39 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull.php:31
40 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
41 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TransformsRequest.php:21
42 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\TrimStrings.php:51
43 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
44 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePostSize.php:27
45 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
46 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance.php:109
47 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
48 - vendor\laravel\framework\src\Illuminate\Http\Middleware\HandleCors.php:61
49 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
50 - vendor\laravel\framework\src\Illuminate\Http\Middleware\TrustProxies.php:58
51 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
52 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks.php:22
53 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
54 - vendor\laravel\framework\src\Illuminate\Http\Middleware\ValidatePathEncoding.php:26
55 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:219
56 - vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php:137
57 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:175
58 - vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php:144
59 - vendor\laravel\framework\src\Illuminate\Foundation\Application.php:1220
60 - public\index.php:20
61 - vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php:23

## Request

GET /landing

## Headers

* **host**: 127.0.0.1:8000
* **connection**: keep-alive
* **cache-control**: max-age=0
* **sec-ch-ua**: "Chromium";v="148", "Google Chrome";v="148", "Not/A)Brand";v="99"
* **sec-ch-ua-mobile**: ?0
* **sec-ch-ua-platform**: "Windows"
* **upgrade-insecure-requests**: 1
* **user-agent**: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36
* **accept**: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
* **sec-fetch-site**: none
* **sec-fetch-mode**: navigate
* **sec-fetch-user**: ?1
* **sec-fetch-dest**: document
* **accept-encoding**: gzip, deflate, br, zstd
* **accept-language**: en-US,en;q=0.9,id;q=0.8
* **cookie**: locale=eyJpdiI6ImowejdjSFM2NjFKY1Vza0pSVFV5SHc9PSIsInZhbHVlIjoiQTRRQithN1ZGRXJYSlFNYXNuR2luellPcHhvYldBUktvQ1NFVUZibHFDV01ES05ScHdpc254SmdGVXRNdlNjViIsIm1hYyI6Ijc4Mjc4ODZkZjg2MGU1NDkwNmNiYjc1Yzk3MWI4YzBiMzNmMWNiNDAxOTU3ZjNlZDhmMTIwNDljNjllNzU2MjkiLCJ0YWciOiIifQ%3D%3D; XSRF-TOKEN=eyJpdiI6IndHZnN6MjJiUTd5KytnSG9MRk5KWnc9PSIsInZhbHVlIjoic05kdWNpY1prYXBHUFZTODJsVXhsMHV0TUlWS2Z3UnI1K2FQamdTT3hhZndMb2J4eFFDNW11S04xbFNHNGZyRFY0RWFCNXBuUndyWDVxc3crOUQ3dXU4K2ZFYlQ4WnZkM0wvK1RoVGFHSktNOXAwUDJIeExjRFRsc0EvUmNDQ3giLCJtYWMiOiJkMGZjYTI1NzRmMTA4MzA0ZmM1NWE5MGVjYmNjZTUyM2E2YmQ3YzVkNjY2N2Q2OTQyYzk1OTk3M2ZmNzU0NTJlIiwidGFnIjoiIn0%3D; laravel-session=eyJpdiI6IktjQlhFVTluNzBrNFhnMnhKQXZRYmc9PSIsInZhbHVlIjoiSWExSG1zdHVpM2VQeFZLb2ZSck41RU5rMU1GR2tMU091Q0o3aFlGSG5HUlpsSWpYWDhvTWs3b1hIazVPbTRlanlDZWM3TFdKL3c4WTdqYzFHcUxjSllFRHpVQklhZDA0Um0rQlhidG1oWE1nSGxJcWk2LzJKYWdoWEdhOGQxR08iLCJtYWMiOiIzOTQ1NjMzMzFkMzYyYTk1MGE2MDNjNTNiOGJjMWY0MDZiZGI3Yzc4ZjY0NTkwYmRiOTIzMzZkZWUwYWFiYmJjIiwidGFnIjoiIn0%3D

## Route Context

controller: App\Http\Controllers\LandingController@index
route name: landing.home
middleware: web

## Route Parameters

No route parameter data available.

## Database Queries

* mysql - select exists (select 1 from information_schema.tables where table_schema = schema() and table_name = 'site_settings' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED')) as `exists` (2.52 ms)
* mysql - select `value`, `key` from `site_settings` (0.5 ms)
* mysql - select * from `sessions` where `id` = 'SuKRxkm61OLneZHw70RLqOUOlKBp15Fw1i0KhFrQ' limit 1 (0.49 ms)
* mysql - select exists (select 1 from information_schema.tables where table_schema = schema() and table_name = 'site_settings' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED')) as `exists` (0.48 ms)
* mysql - select `value` from `site_settings` where `key` = 'maintenance_mode' limit 1 (0.35 ms)
* mysql - select * from `pages` where `slug` = 'home' limit 1 (0.57 ms)
* mysql - select * from `image_sliders` where `is_active` = 1 order by `sort_order` asc, `created_at` desc limit 8 (0.43 ms)
* mysql - select * from `campaigns` where `is_active` = 1 and `status` = 'aktif' order by `deadline` asc, `created_at` desc limit 3 (0.43 ms)
* mysql - select * from `focus_areas` where `is_active` = 1 order by `sort_order` asc, `created_at` desc limit 4 (0.32 ms)
* mysql - select * from `partners` where `is_active` = 1 order by `sort_order` asc, `created_at` desc limit 12 (0.42 ms)
* mysql - select count(*) as aggregate from `donors` where `is_active` = 1 (0.39 ms)
* mysql - select sum(`collected`) as aggregate from `campaigns` where `is_active` = 1 (0.24 ms)
* mysql - select count(*) as aggregate from `campaigns` where `is_active` = 1 and `status` = 'selesai' (0.26 ms)
* mysql - select * from `users` where `id` = 1 limit 1 (0.69 ms)
