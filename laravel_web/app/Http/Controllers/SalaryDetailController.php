<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SalaryDetailRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\SalaryDetail;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class SalaryDetailController extends Controller
{
    protected $salaryDetailRepository;
    protected $staffRepository;
    public function __construct(SalaryDetailRepositoryInterface $salaryDetailRepository, StaffRepositoryInterface $staffRepository){
        $this->salaryDetailRepository = $salaryDetailRepository;
        $this->staffRepository = $staffRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request){
        // $data = $this->staffRepository->calculateStaffSalary();

        $data = $this->salaryDetailRepository->search($request);
        // Số mục hiển thị trên mỗi trang
        $perPage = 10;

        // Tổng số mục
        $total = $data->count();

        // Trang hiện tại: lấy ra giá trị của biến page trong request nếu trong request không có biến page thì gán $page=1
        $page = $request->query('page', 1);

        // Tạo một đối tượng LengthAwarePaginator
        $data = new LengthAwarePaginator(
            $data->slice(($page - 1) * $perPage, $perPage), //($page - 1) * $perPage: vị trí bắt đầu cắt; $perPage: số lượng phần tử cần cắt
            $total,
            $perPage,
            $page,
            ['path' => $request->fullUrl()]
        );

        $current_account = Auth::user();
        return view('salaryDetails/index', compact('current_account', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->staffRepository->calculateStaffSalary();
        foreach($data as $item){
            $year = 2023;
            $month = 1; // Tháng 1

            $numberOfSaturdaysSundays = 0;
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $currentDate = date('Y-m-d', strtotime("$year-$month-$day"));
                $dayOfWeek = date('N', strtotime($currentDate));

                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    $numberOfSaturdaysSundays++;
                }
            }

            $unpaid_leave_days = $daysInMonth - $numberOfSaturdaysSundays;
            if($item->number_working_day == $unpaid_leave_days || $item->number_working_day == $unpaid_leave_days-1) $total_salary = $item->basic_salary + $item->overtime*80 - $item->late_arrival_date*5000;
            else $total_salary = $item->number_working_day*$item->basic_salary/$unpaid_leave_days - $item->late_arrival_date*5000;

            $this->salaryDetailRepository->store([
                'staff_id'=>$item->staff_id,
                'contract_id'=>$item->contract_id,
                'pay_date'=>date('Y-m-d'),
                'overtime'=>$item->overtime,
                'late_arrival_date'=>$item->late_arrival_date,
                'unpaid_leave_days'=>$unpaid_leave_days,
                'late_penalty_per_day'=>20,
                'total_salary'=>$total_salary
            ]);
        }

        return redirect()->route("salaryDetails.search")->with('success', 'Tính lương cho nhân viên thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryDetail $salaryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryDetail $salaryDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryDetail $salaryDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryDetail $salaryDetail)
    {
        //
    }
}
