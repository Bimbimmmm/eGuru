<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecreeNumber extends Model
{
    use HasFactory;
    protected $table = 'decree_number';

    protected $primaryKey = 'id';

    protected $fillable = [
        'leave_permissions_id',
        'salary_increase_id',
        'month',
        'year',
        'assesed_by'
    ];

    public function leavePermission()
    {
      return $this->belongsTo('App\Models\LeavePermissions', 'leave_permissions_id');
    }

    public function salaryIncrease()
    {
      return $this->belongsTo('App\Models\SalaryIncrease', 'salary_increase_id');
    }
}
