<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePerformanceTargetElement extends Model
{
    use HasFactory;
    protected $table = 'reference_performance_target_element';

    protected $primaryKey = "id";

    protected $fillable = [
        'element',
        'direct_supervisor_performance_plan',
        'performance',
        'activity_item',
        'yield_unit',
        'credit_score',
        'quantity',
        'quality',
        'time',
        'code'
    ];

    public function newPerformanceTargetScore()
    {
      return $this->hasMany('App\Models\NewPerformanceTargetScore', 'id');
    }
}
