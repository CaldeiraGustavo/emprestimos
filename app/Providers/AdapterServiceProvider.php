<?php

namespace App\Providers;

use App\Http\Adapters\Contracts\ConvenioAdapterInterface;
use App\Http\Adapters\Contracts\InstituicaoAdapterInterface;
use App\Http\Adapters\Contracts\TaxaInstituicaoAdapterInterface;
use App\Http\Adapters\Eloquent\ConvenioAdapter;
use App\Http\Adapters\Eloquent\InstituicaoAdapter;
use App\Http\Adapters\Eloquent\TaxaInstituicaoAdapter;
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
