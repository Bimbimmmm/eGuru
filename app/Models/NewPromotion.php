<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPromotion extends Model
{
    use HasFactory;
    protected $table = 'new_promotion';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'reference_promotion_credit_score_id',
      'user_id',
      'promotion_period',
      'new_assesment_credit_id',
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

    public function newAssementCredit()
    {
      return $this->belongsTo('App\Models\NewAssesmentCredit', 'new_assesment_credit_id');
    }

    public function newPromotionScore()
    {
      return $this->hasMany('App\Models\NewPromotionScore', 'id');
    }

    public function newPromotionFile()
    {
      return $this->hasMany('App\Models\NewPromotionFile', 'id');
    }

}
