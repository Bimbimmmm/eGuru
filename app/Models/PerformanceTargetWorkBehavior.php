<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceTargetWorkBehavior extends Model
{
    use HasFactory;
    protected $table = 'performance_target_work_behavior';
    protected $casts = [
      'id' => 'string',
    ];

    protected $primaryKey = "id";

    protected $fillable = [
        'performance_target_id',
        'reference_work_behavior_id',
        'score',
        'is_deleted'
    ];

    public function performanceTarget()
    {
      return $this->belongsTo('App\Models\PerformanceTarget', 'performance_target_id');
    }

    public function refWorkBehavior()
    {
      return $this->belongsTo('App\Models\ReferenceWorkBehavior', 'reference_work_behavior_id');
    }

}
