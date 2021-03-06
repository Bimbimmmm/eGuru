<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\Roles;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Gate::define('isAdmin', function($user) {
          $getisadminid=Roles::where('name', 'Administrator')->first();
          return $user->role_id == $getisadminid->id;
      });

      Gate::define('isTeacher', function($user) {
          $getiteacherid=Roles::where('name', 'Guru')->first();
          return $user->role_id == $getiteacherid->id;
      });

      Gate::define('isPrincipal', function($user) {
          $getisprincipaldid=Roles::where('name', 'Kepala Sekolah')->first();
          return $user->role_id == $getisprincipaldid->id;
      });

      Gate::define('isDivisionHead', function($user) {
          $getisdivisionheadid=Roles::where('name', 'Kepala Bidang')->first();
          return $user->role_id == $getisdivisionheadid->id;
      });

      Gate::define('isOfficeHead', function($user) {
          $getisofficeheadid=Roles::where('name', 'Kepala Dinas')->first();
          return $user->role_id == $getisofficeheadid->id;
      });

      Gate::define('isAssesor', function($user) {
          $getisassesorid=Roles::where('name', 'Penilai Angka Kredit')->first();
          return $user->role_id == $getisassesorid->id;
      });

      Gate::define('isOperator', function($user) {
          $getisoperatorid=Roles::where('name', 'Operator')->first();
          return $user->role_id == $getisoperatorid->id;
      });

      Gate::define('isExecutive', function($user) {
          $getisexcecutiveid=Roles::where('name', 'Bupati')->first();
          return $user->role_id == $getisexcecutiveid->id;
      });
    }
}
