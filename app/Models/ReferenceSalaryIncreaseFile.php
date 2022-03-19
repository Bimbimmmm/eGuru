<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceSalaryIncreaseFile extends Model
{
    use HasFactory;
    protected $table = 'reference_salary_increase_file';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function salaryIncreaseFile()
    {
      return $this->hasMany('App\Models\SalaryIncreaseFile', 'id');
    }
}
