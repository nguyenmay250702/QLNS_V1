<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\TimeKeepingRepositoryInterface;
use App\Timekeeping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimekeepingController extends Controller
{
    protected $timekeepingRepository;

    public function __construct(TimeKeepingRepositoryInterface $timekeepingRepository)
    {
        $this->timekeepingRepository = $timekeepingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data["start_time"] = $request->txt_start_time;
        // $data["end_time"] = null;
        $data["staff_id"] = Auth::user()->id;

        $result = $this->timekeepingRepository->store($data);
        return redirect()->route("timeKeepings.search")->with('success', 'Thêm mới sách thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timekeeping  $timekeeping
     * @return \Illuminate\Http\Response
     */
    public function show(Timekeeping $timekeeping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timekeeping  $timekeeping
     * @return \Illuminate\Http\Response
     */
    public function edit(Timekeeping $timekeeping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timekeeping  $timekeeping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timekeeping $timekeeping)
    {
        $data["end_time"] = $request->txt_end_time;

        $result = $this->timekeepingRepository->update($request->route('timeKeeping'), $data);
        return redirect()->route("timeKeepings.search")->with('success', 'Thêm mới sách thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timekeeping  $timekeeping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timekeeping $timekeeping)
    {
        //
    }

    public function search(Request $request){
        if($request->month==null) $data['selected_month'] = date('m');
        else $data['selected_month'] = $request->month;

        $timeKeeping = $this->timekeepingRepository->search(date('d'), date('m'), Auth::user()->id);
        if($timeKeeping !=null){
            $data['id'] = $timeKeeping->id;
            if($timeKeeping->start_time != null && $timeKeeping->end_time == null) $data['status'] = 'đã vào';
            elseif($timeKeeping->start_time != null && $timeKeeping->end_time != null) $data['status'] = 'đã ra';
        }else{
            $data['id'] = -1;
            $data['status'] = 'chưa vào';
        }

        $data1 = $this->timekeepingRepository->search(0,$data['selected_month'], Auth::user()->id);
        foreach ($data1 as $key => $value) {
            $key1 = intval(date('d', strtotime($value->start_time)));
            if($value->end_time==null){
                $value = date('H:i:s', strtotime($value->start_time)).' - H:i:s';
            }else{
                $value = date('H:i:s', strtotime($value->start_time)).' - '.date('H:i:s', strtotime($value->end_time));
            }
            $data[$key1] = $value;
        }
        $current_account = Auth::user();
        return view("timekeepings/index", compact("data", 'current_account'));
    }
}
