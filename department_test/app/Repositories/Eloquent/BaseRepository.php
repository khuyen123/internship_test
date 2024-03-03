<?php
namespace App\Repositories\Eloquent;
use App\Models\Team;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepositoryInterface;
class BaseRepository implements BaseRepositoryInterface
{
    public function getAll(){
        return Team::all();
    }
    public function find($id){
        $team = Team::where('team_id',$id)->first();
        return $team;
    }
    public function create($data){
        $team = new Team;
        $team->team_id = $data->team_id;
        $team->team_name = $data->team_name;
        $team->department_id = $data->department_id;
        try {
            $team->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function update($id,$data){
        try {
            $team = Team::where('team_id',$id)->update(['team_name'=>$data->team_name,'department_id'=>$data->department_id]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
      
    }

    public function delete($id){
        $team = Team::where('team_id',$id);
        try {
            $team->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function getDepartments(){
        $departments = Department::all();
        return $departments;
    }
}