<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPostionHistory extends Model
{
    use HasFactory;

    protected $table = 'teacher_data_position_history';
    protected $casts = [
      'id' => 'string',
    ];


    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'position',
        'reference_position_id',
        'number_of_decree',
        'file',
        'user_id',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'end_date',
      'starting_from_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function referencePosition()
    {
      return $this->belongsTo('App\Models\ReferencePositions', 'reference_position_id');
    }
}
