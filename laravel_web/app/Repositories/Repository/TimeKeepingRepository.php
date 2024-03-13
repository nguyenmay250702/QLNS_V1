<?php 
namespace App\Repositories\Repository;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TimeKeepingRepositoryInterface;
use App\Timekeeping;
use Illuminate\Support\Carbon;

class TimeKeepingRepository extends BaseRepository implements TimeKeepingRepositoryInterface{
   public function __construct(Timekeeping $timekeeping){
      parent::__construct($timekeeping);
   }

   public function search($day=0, $month, $staff_id)
   {
      if($day==0){
         $data = $this->model->where('staff_id', '=', $staff_id)
                           ->whereMonth('start_time', '=', $month)
                           ->whereYear('start_time', '=', date('Y'))
                           ->get();
      }else{
         $data = $this->model->where('staff_id', '=', $staff_id)
                           ->whereDay('start_time', '=', $day)
                           ->whereMonth('start_time', '=', $month)
                           ->whereYear('start_time', '=', date('Y'))
                           ->first();
      }
      return $data;
   }

}
?>