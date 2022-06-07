<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewAssesmentCreditScoreRejected extends Model
{
    use HasFactory;
    protected $table = 'new_assesment_credit_score_rejected';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'new_assesment_credit_id',
        'new_assesment_credit_score_id',
        'new_performance_target_score_id',
        'qty',
        'reason',
        'suggestion'
    ];

  public function newAssesmentCredit()
  {
    return $this->belongsTo('App\Models\NewAssesmentCredit', 'new_assesment_credit_id');
  }

  public function newAssesmentCreditScore()
  {
    return $this->belongsTo('App\Models\NewAssesmentCreditScore', 'new_assesment_credit_score_id');
  }

  public function newPerformanceTargetScore()
  {
    return $this->belongsTo('App\Models\NewPerformanceTargetScore', 'new_performance_target_score_id');
  }
}
