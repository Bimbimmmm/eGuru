<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceLeaveType extends Model
{
    use HasFactory;
    protected $table = 'reference_leave_type';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function leavePermissions()
    {
      return $this->hasMany('App\Models\LeavePermissions', 'id');
    }
}
