<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceWorkBehavior extends Model
{
    use HasFactory;
    protected $table = 'reference_work_behavior';
    protected $casts = [
      'id' => 'string',
      ];
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'is_deleted'
    ];

    public function performanceTargetWorkBehavior()
    {
      return $this->hasMany('App\Models\PerformanceTargetWorkBehavior', 'id');
    }
}
