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
      'is_locked',
      'is_finish',
      'is_rejected',
      'rejected_reason',
      'is_deleted'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function salaryIncreaseFile()
    {
      return $this->hasMany('App\Models\SalaryIncreaseFile', 'id');
    }
}
