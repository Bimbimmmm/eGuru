<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionScore extends Model
{
    use HasFactory;
    protected $table = 'promotion_score';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'promotion_id',
      'reference_assesment_credit_score_activity_id',
      'old_credit_score',
      'new_credit_score',
      'get_credit_score'
    ];

    public function promotion()
    {
      return $this->belongsTo('App\Models\Promotion', 'promotion_id');
    }

    public function refAssesmentCreditScoreAct()
    {
      return $this->belongsTo('App\Models\ReferenceAssesmentCreditScoreActivity', 'reference_assesment_credit_score_activity_id');
    }
}
