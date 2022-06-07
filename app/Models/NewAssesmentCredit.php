<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewAssesmentCredit extends Model
{
    use HasFactory;
    protected $table = 'new_assesment_credit';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'new_performance_target_id',
        'user_id',
        'old_work_year',
        'new_work_year',
        'reference_education_credit_score_id',
        'last_assessment_credit_score',
        'file',
        'is_ready',
        'is_finished',
        'assessed_by',
        'total_assessment_credit_score',
        'is_deleted'
    ];

    protected $dates = [
      'assessment_date',
      'end_date'
  ];

  public function newPerformanceTarget()
  {
    return $this->belongsTo('App\Models\NewPerformanceTarget', 'new_performance_target_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function refEduCreditScore()
  {
    return $this->belongsTo('App\Models\ReferenceEducationCreditScore', 'reference_education_credit_score_id');
  }

  public function newAssesmentCreditScore()
  {
    return $this->hasMany('App\Models\NewAssesmentCreditScore', 'id');
  }

  public function newAssesmentCreditScoreRejected()
  {
    return $this->hasMany('App\Models\NewAssesmentCreditScoreRejected', 'id');
  }

  public function newPromotion()
  {
    return $this->hasMany('App\Models\NewPromotion', 'id');
  }
}
