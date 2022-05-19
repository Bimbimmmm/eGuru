<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceSubject extends Model
{
    use HasFactory;
    protected $table = 'reference_subject';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'subject_type',
        'lesson_level',
        'is_deleted'
    ];

    public function principalMappingSubject()
    {
      return $this->hasMany('App\Models\PrincipalMappingSubject', 'id');
    }

    public function PrincipalMappingFinish()
    {
      return $this->hasMany('App\Models\PrincipalMappingFinish', 'id');
    }
}
