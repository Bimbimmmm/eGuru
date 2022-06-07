<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePromotionCreditScore extends Model
{
    use HasFactory;
    protected $table = 'reference_promotion_credit_score';

    protected $primaryKey = "id";

    protected $fillable = [
        'current_rank',
        'promotion_rank',
        'cumulative_credit_score',
        'major_credit_score',
        'self_development_credit_score',
        'scientific_credit_score',
        'support_credit_score'
    ];

    public function promotion()
    {
      return $this->hasMany('App\Models\Promotion', 'id');
    }

    public function newPromotion()
    {
      return $this->hasMany('App\Models\NewPromotion', 'id');
    }
}
