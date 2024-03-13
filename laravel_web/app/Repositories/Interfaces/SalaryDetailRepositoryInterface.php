<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface SalaryDetailRepositoryInterface extends BaseRepositoryInterface{
    public function search($request);


}

?>