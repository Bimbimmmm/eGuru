<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPromotionScore extends Model
{
    use HasFactory;
    protected $table = 'new_promotion_score';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'new_promotion_id',
      'reference_assesment_credit_score_activity_id',
      'old_credit_score',
      'new_credit_score',
      'get_credit_score'
    ];

    public function newPromotion()
    {
      return $this->belongsTo('App\Models\NewPromotion', 'new_promotion_id');
    }

    public function refAssesmentCreditScoreAct()
    {
      return $this->belongsTo('App\Models\ReferenceAssesmentCreditScoreActivity', 'reference_assesment_credit_score_activity_id');
    }
}
