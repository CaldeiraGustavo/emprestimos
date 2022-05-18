<?php

namespace App\Providers;

use App\Http\Adapter\Contracts\ConvenioAdapterInterface;
use App\Http\Adapter\Contracts\InstituicaoAdapterInterface;
use App\Http\Adapter\Contracts\TaxaInstituicaoAdapterInterface;
use App\Http\Adapter\Eloquent\ConvenioAdapter;
use App\Http\Adapter\Eloquent\InstituicaoAdapter;
use App\Http\Adapter\Eloquent\TaxaInstituicaoAdapter;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConvenioAdapterInterface::class, ConvenioAdapter::class);
        $this->app->bind(InstituicaoAdapterInterface::class, InstituicaoAdapter::class);
        $this->app->bind(TaxaInstituicaoAdapterInterface::class, TaxaInstituicaoAdapter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
