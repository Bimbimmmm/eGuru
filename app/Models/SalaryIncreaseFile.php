<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryIncreaseFile extends Model
{
    use HasFactory;
    protected $table = 'salary_increase_file';
    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
      'salary_increase_id',
      'reference_salary_increase_file_id',
      'file'
    ];

    public function salaryIncrease()
    {
      return $this->belongsTo('App\Models\SalaryIncrease', 'salary_increase_id');
    }

    public function refSalaryIncreaseFile()
    {
      return $this->belongsTo('App\Models\ReferenceSalaryIncreaseFIle', 'reference_salary_increase_file_id');
    }

}
