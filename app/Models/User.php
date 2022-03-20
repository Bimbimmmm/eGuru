<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'personal_data_id',
        'role_id',
        'is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function leavePermissions()
    {
      return $this->hasMany('App\Models\LeavePermissions', 'id');
    }

    public function schoolOfficials()
    {
      return $this->hasMany('App\Models\SchoolOfficial', 'id');
    }

    public function assesmentCredit()
    {
      return $this->hasMany('App\Models\AssesmentCredit', 'id');
    }

    public function personalData()
    {
      return $this->belongsTo('App\Models\PersonalData', 'personal_data_id');
    }

    public function role()
    {
      return $this->belongsTo('App\Models\Roles', 'role_id');
    }

    public function performanceTarget()
    {
      return $this->hasMany('App\Models\PerformanceTarget', 'id');
    }

    public function positionMappingPrincipal()
    {
      return $this->hasMany('App\Models\PositionMapping', 'id');
    }

    public function positionMappingSupervisor()
    {
      return $this->hasMany('App\Models\PositionMapping', 'id');
    }

    public function promotion()
    {
      return $this->hasMany('App\Models\Promotion', 'id');
    }

    public function salaryIncrease()
    {
      return $this->hasMany('App\Models\SalaryIncrease', 'id');
    }

    public function solutionCorner()
    {
      return $this->hasMany('App\Models\SolutionCorner', 'id');
    }

    public function solutionCornerHandle()
    {
      return $this->hasMany('App\Models\SolutionCorner', 'id');
    }

}
