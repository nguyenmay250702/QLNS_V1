<?php 
namespace App\Repositories\Repository;

use App\Contract;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class ContractRepository extends BaseRepository implements ContractRepositoryInterface{
   public function __construct(Contract $contract){
      parent::__construct($contract);
   }

   public function getContractByStaffId($staff_id){
      return $this->model->selectRaw('contracts.*, positions.name as position_name')
            ->join('positions', 'contracts.position_id', '=', 'positions.id')
            ->where('contracts.staff_id', $staff_id)
            ->get();
   }

}
?>