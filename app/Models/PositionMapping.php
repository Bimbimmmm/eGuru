<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionMapping extends Model
{
    use HasFactory;
    protected $table = 'position_mapping';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'principal_id',
      'supervisor_id',
      'work_unit_id',
      'is_active',
      'is_deleted'
    ];

    public function principal()
    {
      return $this->belongsTo('App\Models\User', 'principal_id');
    }

    public function supervisor()
    {
      return $this->belongsTo('App\Models\User', 'supervisor_id');
    }

    public function workUnit()
    {
      return $this->belongsTo('App\Models\ReferenceWorkUnits', 'work_unit_id');
    }

    public function performanceTarget()
    {
      return $this->hasMany('App\Models\PerformanceTarget', 'id');
    }

    public function positionMapping()
    {
      return $this->hasMany('App\Models\PositionMapping', 'id');
    }

    public function newperformanceTarget()
    {
      return $this->hasMany('App\Models\NewPerformanceTarget', 'id');
    }
}
