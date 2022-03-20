<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePermissions extends Model
{
    use HasFactory;
    protected $table = 'leave_permissions';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'leave_excuse',
        'leave_duration',
        'leave_address',
        'is_direct_supervisor_approved',
        'direct_supervisor_note',
        'position_mapping_id',
        'is_official_approve',
        'official_note',
        'file_recommendation_letter',
        'file_temporary_permission',
        'file_leave_application',
        'file_proof',
        'is_rejected',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'end_date'
  ];

  public function leaveType()
  {
    return $this->belongsTo('App\Models\ReferenceLeaveType', 'leave_type_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function positionMapping()
  {
    return $this->belongsTo('App\Models\PositionMapping', 'position_mapping_id');
  }

  public function decreeNumber()
  {
    return $this->hasMany('App\Models\DecreeNumber', 'id');
  }
}
