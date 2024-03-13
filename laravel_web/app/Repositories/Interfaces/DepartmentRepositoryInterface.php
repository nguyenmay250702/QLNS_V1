<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface{
    public function search(array $request);
}

?>