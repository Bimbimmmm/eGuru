<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceWorkUnits extends Model
{
    use HasFactory;
    protected $table = 'reference_work_units';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code'
    ];

    public function personalDatas()
    {
      return $this->hasMany('App\Models\PersonalData', 'id');
    }

    public function schoolOfficials()
    {
      return $this->hasMany('App\Models\SchoolOfficial', 'id');
    }
}
