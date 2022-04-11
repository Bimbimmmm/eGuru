<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRankHistory extends Model
{
    use HasFactory;

    protected $table = 'teacher_data_rank_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'last_rank',
        'last_group',
        'number_of_decree',
        'file',
        'user_id',
        'is_deleted'
    ];

    protected $dates = [
      'starting_from_date',
      'decree_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
