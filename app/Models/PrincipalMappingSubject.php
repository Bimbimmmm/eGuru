<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMappingSubject extends Model
{
    use HasFactory;
    protected $table = 'principal_mapping_subject';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'principal_mapping_id',
      'reference_subject_id',
      'school_statistic_number',
      'total_hour',
      'is_deleted'
    ];

    public function principalMapping()
    {
      return $this->belongsTo('App\Models\PrincipalMapping', 'principal_mapping_id');
    }

    public function referenceSubject()
    {
      return $this->belongsTo('App\Models\ReferenceSubject', 'reference_subject_id');
    }

    public function PrincipalMappingTeacher()
    {
      return $this->hasMany('App\Models\PrincipalMappingTeacher', 'id');
    }

}
