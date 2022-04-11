<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSalaryIncreaseHistory extends Model
{
    use HasFactory;

    protected $table = 'teacher_data_salary_increase_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'number_of_decree',
        'last_rank',
        'last_salary',
        'new_salary',
        'issued_by',
        'file',
        'user_id',
        'is_deleted'
    ];

    protected $dates = [
      'starting_from_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
