<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPerformanceTargetWorkBehaviour extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'new_performance_target_work_behaviour';
    protected $casts = [
      'id' => 'string',
    ];

    protected $primaryKey = "id";

    protected $fillable = [
        'new_performance_target_id',
        'reference_new_work_behaviour_id',
        'score',
        'is_deleted'
    ];

    public function newPerformanceTarget()
    {
      return $this->belongsTo('App\Models\NewPerformanceTarget', 'new_performance_target_id');
    }

    public function refNewWorkBehavior()
    {
      return $this->belongsTo('App\Models\ReferenceNewWorkBehaviour', 'reference_new_work_behaviour_id');
    }
}
