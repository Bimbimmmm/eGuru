<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMappingFinish extends Model
{
  use HasFactory;
  protected $table = 'principal_mapping_finish';
  protected $casts = [
    'id' => 'string',
    ];

  protected $primaryKey = "id";

  protected $fillable = [
    'principal_mapping_id',
    'reference_subject_id',
    'total_hour',
    'total_teacher_need',
    'total_teacher_hour',
    'total_teacher',
    'total_difference',
    'is_excess',
    'is_ideal',
    'is_lack'
  ];

  public function principalMapping()
  {
    return $this->belongsTo('App\Models\PrincipalMapping', 'principal_mapping_id');
  }

  public function referenceSubject()
  {
    return $this->belongsTo('App\Models\ReferenceSubject', 'reference_subject_id');
  }

}
