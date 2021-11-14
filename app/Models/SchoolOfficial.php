<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolOfficial extends Model
{
    use HasFactory;
    protected $table = 'school_official';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'work_unit_id',
        'is_active',
        'is_deleted'
    ];


  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function workUnit()
  {
    return $this->belongsTo('App\Models\ReferenceWorkUnits', 'work_unit_id');
  }

  public function leavePermissions()
  {
    return $this->hasMany('App\Models\LeavePermissions', 'id');
  }
}
