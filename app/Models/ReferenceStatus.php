<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceStatus extends Model
{
    use HasFactory;
    protected $table = 'reference_status';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function personalDatas()
    {
      return $this->hasMany('App\Models\PersonalData', 'id');
    }
}
