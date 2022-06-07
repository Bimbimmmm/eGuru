<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceAssesmentCreditScoreActivity extends Model
{
    use HasFactory;
    protected $table = 'reference_assesment_credit_score_activity';

    protected $primaryKey = "id";

    protected $fillable = [
        'element',
        'sub_element',
        'activity_item'
    ];

    public function assesmentCreditScore()
    {
      return $this->hasMany('App\Models\AssesmentCreditScore', 'id');
    }

    public function promotionScore()
    {
      return $this->hasMany('App\Models\PromotionScore', 'id');
    }

    public function newAssesmentCreditScore()
    {
      return $this->hasMany('App\Models\NewAssesmentCreditScore', 'id');
    }

    public function newPromotionScore()
    {
      return $this->hasMany('App\Models\NewPromotionScore', 'id');
    }
}
