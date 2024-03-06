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
    public function search($searchString){
        $teams = Team::query()
        ->where('team_name','LIKE',"%{$searchString}%")->get();
        return $teams;
    }
    public function sortIdaz() {
        $teams = Team::get()->sortBy('team_id')->all();
        return $teams;
    }
    public function sortIdza(){
        $teams = Team::get()->sortByDesc('team_id')->all();
        return $teams;
    }
    public function sortNameaz(){
        $teams = Team::get()->sortBy('team_name')->all();
        return $teams;
    }
    public function sortNameza(){
        $teams = Team::get()->sortByDesc('team_name')->all();
        return $teams;
    }
}