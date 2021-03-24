<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //user
        Gate::define('user', function($user){
            return $user->roles == 'ADMIN';
        });

        //jurusan
        Gate::define('index-jurusan', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('create-jurusan', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('delete-jurusan', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        //kelas
        Gate::define('index-kelas', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('create-kelas', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('delete-kelas', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        //siswa
        Gate::define('index-siswa', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('create-siswa', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('update-siswa', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('delete-siswa', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('show-siswa', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });


        //pembayaran
        Gate::define('index-pembayaran', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('create-pembayaran', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        //spp
        Gate::define('index-spp', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        Gate::define('create-spp', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('delete-spp', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('show-spp', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN' || $user->roles == 'GURU';
        });

        // laporan
        Gate::define('laporan', function($user){
            return $user->roles == 'STAFF' || $user->roles == 'ADMIN';
        });

        Gate::define('database', function($user){
            return $user->roles == 'ADMIN';
        });
    }
}
