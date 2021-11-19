<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceTargetScore extends Model
{
    use HasFactory;
    protected $table = 'performance_target_score';
    protected $casts = [
      'id' => 'string',
    ];

    protected $primaryKey = "id";

    protected $fillable = [
        'performance_target_id',
        'reference_activity_credit_score_id',
        'target_credit_score',
        'target_qty',
        'target_output',
        'target_quality',
        'target_time',
        'target_time_unit',
        'target_cost',
        'file',
        'realization_credit_score',
        'realization_qty',
        'realization_output',
        'realization_quality',
        'realization_time',
        'realization_time_unit',
        'realization_cost',
        'calculation',
        'performance_value',
        'is_rejected_by_assesor',
        'is_deleted'
    ];

    public function performanceTarget()
    {
      return $this->belongsTo('App\Models\PerformanceTarget', 'performance_target_id');
    }

    public function refActivityCreditScore()
    {
      return $this->belongsTo('App\Models\ReferenceActivityCreditScore', 'reference_activity_credit_score_id');
    }


}
