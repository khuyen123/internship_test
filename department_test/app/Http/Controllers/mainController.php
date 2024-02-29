<?php

namespace App\Http\Controllers;
use App\Http\Service\BaseService;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;
class mainController extends Controller
{
    protected $baseSevice;
    public function __construct(BaseService $baseSevice){
        $this->baseSevice = $baseSevice;
    }
    public function index(){
        dd($this->baseSevice->getAll());
    }
    public function find(BaseRequest $request)
    {
        dd($this->baseSevice->find($request->team_id));
    }
    public function create(BaseRequest $request){
        $data = $request->input();
        if ($this->baseSevice->create($data)) {
            echo "Thanh Cong";
        } else {echo "That Bai";}
    }
    public function update($id,BaseRequest $request){
        $data = $request->input();
        if ($this->baseSevice->update('rec',$data)) {
            echo "Thanh Cong";
        } else {echo "That Bai";}
    }
    public function delete($id){
        if ($this->baseSevice->delete('net')) {
            echo "Thanh Cong";
        } else {echo "That bai";}
    }
    
}
