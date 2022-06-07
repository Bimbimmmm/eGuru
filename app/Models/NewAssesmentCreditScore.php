<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewAssesmentCreditScore extends Model
{
    use HasFactory;
    protected $table = 'new_assesment_credit_score';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'new_assesment_credit_id',
        'reference_assesment_credit_score_activity_id',
        'old_credit_score',
        'new_user_credit_score',
        'new_evaluator_credit_score',
        'total_user_credit_score',
        'total_evaluator_credit_score'
    ];

  public function newAssesmentCredit()
  {
    return $this->belongsTo('App\Models\NewAssesmentCredit', 'new_assesment_credit_id');
  }

  public function refAsCSActivity()
  {
    return $this->belongsTo('App\Models\ReferenceAssesmentCreditScoreActivity', 'reference_assesment_credit_score_activity_id');
  }

  public function newAssesmentCreditScoreRejected()
  {
    return $this->hasMany('App\Models\NewAssesmentCreditScoreRejected', 'id');
  }
}
