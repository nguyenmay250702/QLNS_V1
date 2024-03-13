<?php 
namespace App\Repositories\Repository;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{
     public function __construct(Role $role){
        parent::__construct($role);
     }

}
?>