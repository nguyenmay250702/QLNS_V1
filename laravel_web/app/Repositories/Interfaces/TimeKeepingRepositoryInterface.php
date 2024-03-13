<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface TimeKeepingRepositoryInterface extends BaseRepositoryInterface{
    public function search($day, $month, $staff_id);
}

?>