<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'reference_promotion_credit_score_id',
      'user_id',
      'promotion_period',
      'assesment_credit_id',
      'last_promotion_credit_score',
      'old_work_year',
      'new_work_year',
      'file',
      'is_locked',
      'is_assesed',
      'asseseed_by',
      'is_finish',
      'is_rejected',
      'rejected_reason',
      'is_deleted'
    ];

    public function refPromotionCreditScore()
    {
      return $this->belongsTo('App\Models\ReferencePromotionCreditScore', 'reference_promotion_credit_score_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function assementCredit()
    {
      return $this->belongsTo('App\Models\AssesmentCredit', 'assesment_credit_id');
    }

    public function promotionScore()
    {
      return $this->hasMany('App\Models\PromotionScore', 'id');
    }

    public function promotionFile()
    {
      return $this->hasMany('App\Models\PromotionFile', 'id');
    }

    public function promotionRecapData()
    {
      return $this->hasMany('App\Models\PromotionRecapitulationData', 'id');
    }

}
