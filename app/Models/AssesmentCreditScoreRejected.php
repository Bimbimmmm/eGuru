<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentCreditScoreRejected extends Model
{
    use HasFactory;
    protected $table = 'assesment_credit_score_rejected';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'assesment_credit_id',
        'assesment_credit_score_id',
        'performance_target_score_id',
        'qty',
        'reason',
        'suggestion'
    ];

  public function assesmentCredit()
  {
    return $this->belongsTo('App\Models\AssesmentCredit', 'assesment_credit_id');
  }

  public function assesmentCreditScore()
  {
    return $this->belongsTo('App\Models\AssesmentCreditScore', 'assesment_credit_score_id');
  }

  public function performanceTargetScore()
  {
    return $this->belongsTo('App\Models\PerformanceTargetScore', 'performance_target_score_id');
  }

}
