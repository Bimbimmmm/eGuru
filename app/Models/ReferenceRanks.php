<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceRanks extends Model
{
    use HasFactory;
    protected $table = 'reference_ranks';

    protected $primaryKey = "id";

    protected $fillable = [
        'group',
        'rank'
    ];

    public function personalDatas()
    {
      return $this->hasMany('App\Models\PersonalData', 'id');
    }

    public function performanceTarget()
    {
      return $this->hasMany('App\Models\PerformanceTarget', 'id');
    }

    public function newperformanceTarget()
    {
      return $this->hasMany('App\Models\NewPerformanceTarget', 'id');
    }
}
