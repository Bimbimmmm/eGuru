<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentCredit extends Model
{
    use HasFactory;
    protected $table = 'assesment_credit';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'performance_target_id',
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

  public function performanceTarget()
  {
    return $this->belongsTo('App\Models\PerformanceTarget', 'performance_target_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

  public function refEduCreditScore()
  {
    return $this->belongsTo('App\Models\ReferenceEducationCreditScore', 'reference_education_credit_score_id');
  }

  public function assesmentCreditScore()
  {
    return $this->hasMany('App\Models\AssesmentCreditScore', 'id');
  }

  public function assesmentCreditScoreRejected()
  {
    return $this->hasMany('App\Models\AssesmentCreditScoreRejected', 'id');
  }

  public function promotion()
  {
    return $this->hasMany('App\Models\Promotion', 'id');
  }

}
