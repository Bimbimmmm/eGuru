<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionFile extends Model
{
    use HasFactory;
    protected $table = 'promotion_file';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'promotion_id',
      'reference_promotion_file_id',
      'file'
    ];

    public function promotion()
    {
      return $this->belongsTo('App\Models\Promotion', 'promotion_id');
    }

    public function refPromotionFile()
    {
      return $this->belongsTo('App\Models\ReferencePromotionFile', 'reference_promotion_file_id');
    }
}
