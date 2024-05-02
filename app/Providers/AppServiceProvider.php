<?php

namespace App\Providers;

use App\Models\CertifiedProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies\CertifiedProviderPolicy;


class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CertifiedProvider::class => CertifiedProviderPolicy::class,
    ];
    
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
        Gate::policy(CertifiedProvider::class, CertifiedProviderPolicy::class);    
    }
}
