<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNonFormalEducationHistory extends Model
{
    use HasFactory;

    protected $table = 'teacher_data_non_formal_education_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'place',
        'certificate_number',
        'file',
        'user_id',
        'is_deleted'
    ];

    protected $dates = [
      'graduation_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
