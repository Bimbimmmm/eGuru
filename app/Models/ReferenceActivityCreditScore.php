<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceActivityCreditScore extends Model
{
    use HasFactory;
    protected $table = 'reference_activity_credit_score';

    protected $primaryKey = "id";

    protected $fillable = [
        'element',
        'sub_element',
        'activity_item',
        'grain_item',
        'sub_grain_item',
        'code',
        'output',
        'credit_score',
        'is_deleted'
    ];

    public function performanceTargetScore()
    {
      return $this->hasMany('App\Models\PerformanceTargetScore', 'id');
    }
}
