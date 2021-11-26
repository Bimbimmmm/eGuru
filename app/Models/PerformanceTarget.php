<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceTarget extends Model
{
    use HasFactory;
    protected $table = 'performance_target';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'user_id',
      'work_unit_id',
      'assessment_year',
      'rank_id',
      'period',
      'position_mapping_id',
      'performance_score',
      'is_ready',
      'is_direct_supervisor_approve',
      'is_official_asseseed',
      'is_correction',
      'correction_note',
      'file_lesson_plan',
      'file_instrument',
      'file_mapping',
      'is_deleted'
    ];

    protected $dates = [
    'direct_supervisor_asseseed_time',
    'official_asseseed_time'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function workUnit()
    {
      return $this->belongsTo('App\Models\ReferenceWorkUnits', 'work_unit_id');
    }

    public function rank()
    {
      return $this->belongsTo('App\Models\ReferenceRanks', 'rank_id');
    }

    public function positionMapping()
    {
      return $this->belongsTo('App\Models\PositionMapping', 'position_mapping_id');
    }

    public function performanceTargetScore()
    {
      return $this->hasMany('App\Models\PerformanceTargetScore', 'id');
    }

    public function performanceTargetWorkBehavior()
    {
      return $this->hasMany('App\Models\PerformanceTargetWorkBehavior', 'id');
    }

    public function assesmentCredit()
    {
      return $this->hasMany('App\Models\AssesmentCredit', 'id');
    }

    public function assesmentCreditScoreRejected()
    {
      return $this->hasMany('App\Models\AssesmentCreditScoreRejected', 'id');
    }

}
