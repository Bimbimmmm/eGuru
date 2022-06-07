<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceEducationCreditScore extends Model
{
    use HasFactory;
    protected $table = 'reference_education_credit_score';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'credit_score'
    ];

    public function assesmentCreditScore()
    {
      return $this->hasMany('App\Models\AssesmentCreditScore', 'id');
    }
    public function assesmentCredit()
    {
      return $this->hasMany('App\Models\AssesmentCredit', 'id');
    }

    public function newAssesmentCredit()
    {
      return $this->hasMany('App\Models\NewAssesmentCredit', 'id');
    }
}
