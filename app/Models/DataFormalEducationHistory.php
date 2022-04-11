<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFormalEducationHistory extends Model
{
    use HasFactory;

    protected $table = 'teacher_data_formal_education_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'education_level',
        'name',
        'place',
        'diploma_number',
        'file',
        'user_id',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'graduation_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
