<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface{
    public function search(array $data);


}

?>