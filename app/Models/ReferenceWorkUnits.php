<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceWorkUnits extends Model
{
    use HasFactory;
    protected $table = 'reference_work_units';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code'
    ];

    public function personalDatas()
    {
      return $this->hasMany('App\Models\PersonalData', 'id');
    }

    public function schoolOfficials()
    {
      return $this->hasMany('App\Models\SchoolOfficial', 'id');
    }

    public function performanceTarget()
    {
      return $this->hasMany('App\Models\PerformanceTarget', 'id');
    }

    public function positionMapping()
    {
      return $this->hasMany('App\Models\PositionMapping', 'id');
    }

    public function principalMapping()
    {
      return $this->hasMany('App\Models\PrincialMapping', 'id');
    }

    public function newperformanceTarget()
    {
      return $this->hasMany('App\Models\NewPerformanceTarget', 'id');
    }
}
