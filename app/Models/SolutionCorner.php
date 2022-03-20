<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionCorner extends Model
{
    use HasFactory;
    protected $table = 'solution_corner';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'problem',
        'queue_number',
        'user_id',
        'handles_id',
        'note',
        'satisfaction_level',
        'feedback',
        'is_finish',
        'is_deleted'
    ];

    protected $dates = [
      'confide_date'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function handle()
    {
      return $this->belongsTo('App\Models\User', 'handles_id');
    }

}
