<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMappingTeacher extends Model
{
    use HasFactory;
    protected $table = 'principal_mapping_teacher';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'principal_mapping_subject_id',
      'user_id',
      'teaching_hour',
      'is_certification',
      'is_deleted'
    ];

    public function PrincipalMappingSubject()
    {
      return $this->belongsTo('App\Models\PrincipalMappingSubject', 'principal_mapping_subject_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

}
