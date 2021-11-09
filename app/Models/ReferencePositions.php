<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePositions extends Model
{
    use HasFactory;
    protected $table = 'reference_positions';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'is_functional',
        'echelon'
    ];

    public function personalDatas()
    {
      return $this->hasMany('App\Models\PersonalData', 'id');
    }
}
