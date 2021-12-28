<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionRecapitulationData extends Model
{
    use HasFactory;
    protected $table = 'promotion_recapitulation';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'promotion_recapitulation_id',
      'promotion_id'
    ];

    public function promotionRecapitulation()
    {
      return $this->belongsTo('App\Models\PromotionRecapitulation', 'promotion_recapitulation_id');
    }

    public function promotion()
    {
      return $this->belongsTo('App\Models\Promotion', 'promotion_id');
    }


}
