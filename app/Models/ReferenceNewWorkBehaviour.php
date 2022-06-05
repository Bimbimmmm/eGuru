<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceNewWorkBehaviour extends Model
{
    use HasFactory;
    protected $table = 'reference_new_work_behaviour';
    protected $casts = [
      'id' => 'string',
      ];
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'is_deleted'
    ];

    public function newPerformanceTargetWorkBehavior()
    {
      return $this->hasMany('App\Models\NewPerformanceTargetWorkBehavior', 'id');
    }
}
