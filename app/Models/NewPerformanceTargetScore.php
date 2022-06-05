<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPerformanceTargetScore extends Model
{
    use HasFactory;
    protected $table = 'new_performance_target_score';
    protected $casts = [
      'id' => 'string',
    ];

    protected $primaryKey = "id";

    protected $fillable = [
        'new_performance_target_id',
        'reference_performance_target_element_id',
        'target_credit_score',
        'target_qty',
        'target_output',
        'target_quality',
        'target_time',
        'file',
        'realization_credit_score',
        'realization_qty',
        'ach_qty',
        'cat_qty',
        'realization_quality',
        'ach_quality',
        'cat_quality',
        'realization_time',
        'ach_time',
        'cat_time',
        'category',
        'score',
        'weighted_value',
        'is_rejected_by_assesor',
        'is_deleted'
    ];

    public function newPerformanceTarget()
    {
      return $this->belongsTo('App\Models\NewPerformanceTarget', 'new_performance_target_id');
    }

    public function refPerformanceElement()
    {
      return $this->belongsTo('App\Models\ReferencePerformanceTargetElement', 'reference_performance_target_element_id');
    }

}
