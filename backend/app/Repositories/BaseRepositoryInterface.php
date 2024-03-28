<?php
namespace App\Repositories;
use App\Models\Team;
interface BaseRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function delete($id);
    public function getDepartments();
    public function search($searchString);
    public function sortIdaz();
    public function sortIdza();
    public function sortNameaz();
    public function sortNameza();
}