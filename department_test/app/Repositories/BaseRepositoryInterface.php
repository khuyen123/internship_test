<?php
namespace App\Repositories;
use App\Models\Team;
interface BaseRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function delete($id);
   
}