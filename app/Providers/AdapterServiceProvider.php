<?php

namespace App\Providers;

use Acme\Point\Application\AddPoint\Adapters\AppAddPointAdapter;
use Acme\Point\Application\AddPointDomain\Adapters\AppAddPointAdapter as AppAddPointAdapterDomain;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCase;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCase as AddPointUseCaseDomain;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AddPointUseCase::class, function () {
            $adapter = $this->app->make(AppAddPointAdapter::class);
            return new AddPointUseCase($adapter, $adapter);
        });

        $this->app->bind(AddPointUseCaseDomain::class, function () {
            $adapter = $this->app->make(AppAddPointAdapterDomain::class);
            return new AddPointUseCaseDomain($adapter, $adapter);
        });
    }
}
