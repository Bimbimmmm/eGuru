<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAppreciationHistory extends Model
{
    use HasFactory;
    protected $table = 'teacher_data_appreciation_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'year',
        'issued_by',
        'file',
        'user_id',
        'is_deleted'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
