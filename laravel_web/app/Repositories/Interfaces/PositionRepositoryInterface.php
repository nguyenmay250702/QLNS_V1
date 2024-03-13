<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface PositionRepositoryInterface extends BaseRepositoryInterface{
    public function search(array $request);
}

?>