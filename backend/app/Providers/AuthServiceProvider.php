<?php

namespace App\Providers;

use App\Models\Act;
use App\Policies\ActPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Act::class => ActPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
