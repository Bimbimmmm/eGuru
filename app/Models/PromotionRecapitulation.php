<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionRecapitulation extends Model
{
    use HasFactory;
    protected $table = 'promotion_recapitulation';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'recapitulation_period',
      'recapitulation_year',
      'is_deleted'
    ];

    public function promotionRecapData()
    {
      return $this->hasMany('App\Models\PromotionRecapitulationData', 'id');
    }

}
