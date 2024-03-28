<?php

namespace App\Http\Controllers;
use App\Http\Service\BaseService;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;
use App\Exports\ExportExcel;
use Maatwebsite\Excel\Facades\Excel;
class mainController extends Controller
{
    protected $baseService;
    public function __construct(BaseService $baseService){
        $this->baseService = $baseService;
    }
    //Index function when load home
    public function index(){
        $teams = $this->baseService->getAll();
        $departments = $this->baseService->getDepartments();
        return view('index',[
            'teams'=>$teams,
            'departments'=>$departments
        ]);
    }
    public function find($id)
    {
        $team = $this->baseService->find($id);
        return response()->json([
            'team'=>$team
        ]);
    }
    //Create new Team
    public function create(BaseRequest $request){
        
        if ($this->baseService->create($request)) {
            return response()->json([
                'status'=>200
            ]);
        }
        return response()->json([
            'status'=>404
        ]);
    }
    //Update a team
    public function update($id,BaseRequest $request){
        if ($this->baseService->update($id,$request)) {
            return response()->json([
                'status'=>200
            ]);
        } 
        return response()->json([
            'status'=>404
        ]);
    }
    //Delete a team
    public function delete($id){
        if ($this->baseService->delete($id)) {
            return response()->json([
                'status' => 200
            ]);
        }
        return response()->json([
            'status'=>404
        ]);
    }
    //Search
    function search(Request $request){
        $departments = $this->baseService->getDepartments();
        $teams = $this->baseService->search($request->searchString);
        return view('index',[
            'teams'=>$teams,
            'departments'=>$departments
        ]);
    }
    //Export Excel
    function export(){
        return Excel::download(new ExportExcel,'team.xlsx');
    }
    //Sort by ID ASC
    function sortIdaz(){
        $teams =  $this->baseService->sortIdaz();
        $departments = $this->baseService->getDepartments();
        return view('index',[
            'teams'=> $teams,
            'departments'=>$departments
        ]);
    }
    //Sort By ID DESC
    function sortIdza(){
        $teams =  $this->baseService->sortIdza();
        $departments = $this->baseService->getDepartments();
        return view('index',[
            'teams'=> $teams,
            'departments'=>$departments
        ]);
    }
    //Sort By Name ASC
    function sortNameaz(){
        $teams =  $this->baseService->sortNameaz();
        $departments = $this->baseService->getDepartments();
        return view('index',[
            'teams'=> $teams,
            'departments'=>$departments
        ]);
    }
    //Sort By Name DESC
    function sortNameza(){
        $teams =  $this->baseService->sortNameza();
        $departments = $this->baseService->getDepartments();
        return view('index',[
            'teams'=> $teams,
            'departments'=>$departments
        ]);
    }
    public function getAll(){
        $teams = $this->baseService->getAll();
        return response()->json([$teams,200]);
    }
}
