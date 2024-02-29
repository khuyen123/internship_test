<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    use HasFactory;
    protected $fillable= [
        'department_id',
        'department_name',
        'description'
    ];
    protected $table='Department_tb';
}
