<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMapping extends Model
{
    use HasFactory;
    protected $table = 'principal_mapping';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'school_type',
      'study_year',
      'school_statistic_number',
      'national_school_number',
      'school_date',
      'school_accreditation',
      'work_unit_id',
      'user_id',
      'principal_starting_from_date',
      'total_study_group',
      'total_student',
      'is_locked',
      'is_finish',
      'is_deleted'
    ];

    public function workUnit()
    {
      return $this->belongsTo('App\Models\ReferenceWorkUnits', 'work_unit_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function principalMappingSubject()
    {
      return $this->hasMany('App\Models\PrincipalMappingSubject', 'id');
    }

    public function PrincipalMappingFinish()
    {
      return $this->hasMany('App\Models\PrincipalMappingFinish', 'id');
    }

}
