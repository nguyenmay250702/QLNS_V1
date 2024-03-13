<?php 
namespace App\Repositories\Interfaces;
use App\Repositories\BaseRepositoryInterface;

interface StaffRepositoryInterface extends BaseRepositoryInterface{
    public function getStaffsWithoutAccount();
    public function search1($request);
    public function getStaffByCitizenIdentityCard($citizen_identity_card);
    public function calculateStaffSalary();   

}   

?>