<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\Operation;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Dedoc\Scramble\Support\RouteInfo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        /****************************************************************************
         * Scramble Documentation Configuration Section
         *
         * Add bearer token requirements
         * Remove the authentication requirements from routes that do not need it
         ***************************************************************************/
        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });

        Scramble::configure()
            ->withOperationTransformers(function (Operation $operation, RouteInfo $routeInfo) {
                $routeMiddleware = $routeInfo->route->gatherMiddleware();

                $hasAuthMiddleware = collect($routeMiddleware)->contains(
                    fn($m) => Str::startsWith($m, 'auth:')
                );

                if (!$hasAuthMiddleware) {
                    $operation->security = [];
                }
            });


        /****************************************************************************
         * API Version 1 Scramble Documentation Configuration
         *
         * Register the api as v1.0.0
         * Set Endpoint path to api/v1
         * Register the docs/v1 web endpoint
         * Register the docs/v1.json endpoint for the OpenAPI Json download
         ***************************************************************************/
        /* API Version 1 Docs */
        Scramble::registerApi('v1',
            [
                'info' => ['version' => '1.0.0'],
                'api_path' => 'api/v1',
            ]);

        Scramble::registerUiRoute(path: 'docs/v1', api: 'v1');
        Scramble::registerJsonSpecificationRoute(path: 'docs/v1.json', api: 'v1');


        /****************************************************************************
         * API Version 2 Scramble Documentation Configuration
         *
         * Register the api as v2.0.0
         * Set Endpoint path to api/v2
         * Register the docs/v2 web endpoint
         * Register the docs/v2.json endpoint for the OpenAPI Json download
         ***************************************************************************/
        Scramble::registerApi('v2',
            [
                'info' => ['version' => '2.0.0'],
                'api_path' => 'api/v2',
            ]);

        Scramble::registerUiRoute(path: 'docs/v2', api: 'v2');
        Scramble::registerJsonSpecificationRoute(path: 'docs/v2.json', api: 'v2');

        /****************************************************************************
         * API Version X Scramble Documentation Configuration
         * Add each version using the same pattern as for v1 and v2 above
         ***************************************************************************/


        /****************************************************************************
         * Ignore the default /docs/api endpoint
         ***************************************************************************/
        Scramble::ignoreDefaultRoutes();

    }
}
