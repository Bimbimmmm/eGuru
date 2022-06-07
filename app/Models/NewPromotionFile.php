<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPromotionFile extends Model
{
    use HasFactory;
    protected $table = 'new_promotion_file';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'new_promotion_id',
      'reference_promotion_file_id',
      'file'
    ];

    public function newPromotion()
    {
      return $this->belongsTo('App\Models\NewPromotion', 'new_promotion_id');
    }

    public function refPromotionFile()
    {
      return $this->belongsTo('App\Models\ReferencePromotionFile', 'reference_promotion_file_id');
    }
}
