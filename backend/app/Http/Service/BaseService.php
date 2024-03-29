<?php
namespace App\Http\Service;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Team;
class BaseService
{
    protected $baseRepository;
    public function __construct(BaseRepository $baseRepository){
        $this->baseRepository = $baseRepository;
    }
    public function getAll(){
        return $this->baseRepository->getAll();
    }
    public function find($id){
        return $this->baseRepository->find($id);
    }
    public function create($data){
        return $this->baseRepository->create($data);
    }
    public function update($id,$data){
        return $this->baseRepository->update($id,$data);
    }
    public function delete($id){
        return $this->baseRepository->delete($id);
    }
    public function getDepartments(){
        return $this->baseRepository->getDepartments();
    }
    public function search($searchString){
        return $this->baseRepository->search($searchString);
    }
    public function sortIdaz(){
        return $this->baseRepository->sortIdaz();
    }
    public function sortIdza(){
        return $this->baseRepository->sortIdza();
    }
    public function sortNameaz(){
        return $this->baseRepository->sortNameaz();
    }
    public function sortNameza(){
        return $this->baseRepository->sortNameza();
    }
}