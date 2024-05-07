<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CertifiedProvider;
use App\Policies\CertifiedProviderPolicy;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CertifiedProvider::class => CertifiedProviderPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {

        $this->registerCertifiedProviderPolicy();
        // dd(Gate::policies());
    }

    public function registerCertifiedProviderPolicy()
    {
        Gate::policy(CertifiedProvider::class, CertifiedProviderPolicy::class);    
       
    }
}
