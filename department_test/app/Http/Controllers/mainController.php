<?php

namespace App\Http\Controllers;
use App\Http\Service\BaseService;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;
class mainController extends Controller
{
    protected $baseService;
    public function __construct(BaseService $baseService){
        $this->baseService = $baseService;
    }
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
    
}
