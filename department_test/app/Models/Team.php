<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_id',
        'team_name',
        'department_id'
    ];
    protected $table = 'Team_tb';
    public function team(){
        return $this->hasOne(Department::class,'department_id','department_id');
    }
}
