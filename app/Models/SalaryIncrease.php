<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryIncrease extends Model
{
    use HasFactory;
    protected $table = 'salary_increase';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'year',
      'type',
      'user_id',
      'old_salary',
      'old_decree_number',
      'old_work_year',
      'new_salary',
      'new_work_year',
      'is_locked',
      'is_finish',
      'is_rejected',
      'rejected_reason',
      'is_deleted'
    ];

    protected $dates = [
      'old_decree_date',
      'old_date',
      'new_date'
  ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function salaryIncreaseFile()
    {
      return $this->hasMany('App\Models\SalaryIncreaseFile', 'id');
    }

    public function decreeNumber()
    {
      return $this->hasMany('App\Models\DecreeNumber', 'id');
    }
}
