<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface ContractRepositoryInterface extends BaseRepositoryInterface{
    public function getContractByStaffId($staffId);
}

?>