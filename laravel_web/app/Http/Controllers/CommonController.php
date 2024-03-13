<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Staff;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\SalaryDetailRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Interfaces\TimeKeepingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller
{
    protected $staffRepository;
    protected $contractRepository;
    protected $departmentRepository;
    protected $userRepository;
    protected $timeKeeping;
    protected $salaryDetail;
    protected $positionRepository;

    public function __construct(SalaryDetailRepositoryInterface $salaryDetail, PositionRepositoryInterface $positionRepository, TimeKeepingRepositoryInterface $timeKeeping, StaffRepositoryInterface $staffRepository, ContractRepositoryInterface $contractRepository, DepartmentRepositoryInterface $departmentRepository, UserRepositoryInterface $userRepository)
    {
        $this->staffRepository = $staffRepository;
        $this->contractRepository = $contractRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
        $this->timeKeeping = $timeKeeping;
        $this->salaryDetail = $salaryDetail;
        $this->positionRepository = $positionRepository;
    }

    public function search(Request $request)
    {
        $table_name = explode(".", $request->route()->getName())[0];

        if ($table_name == "staffs") $data = $this->staffRepository->search1($request->all());
        elseif ($table_name == "users") $data = $this->userRepository->search($request->all());
        elseif ($table_name == "departments") $data = $this->departmentRepository->search($request->all());
        elseif ($table_name == "positions") $data = $this->positionRepository->search($request->all());

        $perPage = 10;
        $total = $data->count();
        $page = $request->query('page', 1);
        $data = new LengthAwarePaginator(
            $data->slice(($page - 1) * $perPage, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => $request->fullUrl()]
        );

        $departments = $this->departmentRepository->all();
        $current_account = Auth::user();
        return view($table_name . "/index", compact('data', 'current_account', 'departments'));
    }


    public function index()
    {
    }

    public function create(Request $request)
    {
        $table_name = explode(".", $request->route()->getName())[0];

        $current_account = Auth::user();
        $compacts = [];
        if ($table_name == "staffs") {
            $departments = $this->departmentRepository->all();
            $compacts = ['current_account', 'departments'];
        } elseif ($table_name == "users") {
            $staffs = $this->staffRepository->getStaffsWithoutAccount();
            $compacts = ['current_account', 'staffs'];
        } else {
            $compacts = ['current_account'];
        }

        return view($table_name . '/create', compact($compacts));

    }

    public function show($id, Request $request)
    {
        $table_name = explode(".", $request->route()->getName())[0];

        $current_account = Auth::user();

        $compacts = [];
        if ($table_name == "staffs") {
            $staff = $this->staffRepository->find($id);
            $contracts = $this->contractRepository->getContractByStaffId($id);
            $compacts = ['staff', 'contracts', 'current_account'];
        }

        return view($table_name . '/show', compact($compacts));
    }

    public function edit($id, Request $request)
    {
        $table_name = explode(".", $request->route()->getName())[0];
        $current_account = Auth::user();

        $compacts = [];
        if ($table_name == "staffs") {
            $departments = $this->departmentRepository->all();
            $staff = $this->staffRepository->find($id);
            $compacts = ['current_account', 'departments', 'staff'];
        } elseif ($table_name == "users") {
            $staffs = $this->staffRepository->getStaffsWithoutAccount();
            $user = $this->userRepository->find($id);
            $staff = new Staff();
            $staffs->push($staff->find($user->staff_id));
            $staffs = $staffs->sortBy('id');
            $compacts = ['current_account', 'staffs', 'user'];
        } elseif ($table_name == "departments") {
            $department = $this->departmentRepository->find($id);
            $compacts = ['current_account', 'department'];
        } elseif ($table_name == "positions") {
            $position = $this->positionRepository->find($id);
            $compacts = ['current_account', 'position'];
        }

        return view($table_name . '/edit', compact($compacts));
    }
}
