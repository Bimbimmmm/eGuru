<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePromotionFile extends Model
{
    use HasFactory;
    protected $table = 'reference_promotion_file';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function promotionFile()
    {
      return $this->hasMany('App\Models\PromotionFile', 'id');
    }

    public function newPromotionFile()
    {
      return $this->hasMany('App\Models\NewPromotionFile', 'id');
    }
}
