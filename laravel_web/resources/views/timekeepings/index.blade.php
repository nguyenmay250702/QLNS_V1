@extends('master')

@section('content')
<div class="d-flex justify-content-between mb-1 mt-5">
    <div class="d-flex align-items-center">
        <button class="btn btn-luu @if($data['status'] == 'chưa vào') d-inline-block @else d-none @endif m-0" data-bs-toggle="modal" data-bs-target="#timekeeping_start" data-bs-whatever="@getbootstrap">Chấm công đầu giờ</button>
        <button class="btn btn-luu @if($data['status'] == 'đã vào') d-inline-block @else d-none @endif m-0" data-bs-toggle="modal" data-bs-target="#timekeeping_end" data-bs-whatever="@getbootstrap">Chấm công cuối giờ</button>
        <div class="@if($data['status'] == 'đã ra') d-inline-block @else d-none @endif"><i class="fa-solid fa-check-double" style="color: #379668; font-size: 17px;"></i> Đã hoàn thành chấm công.</div>
    </div>
    <div class="d-flex align-items-center">
        <form id="form_search_timeKeepings" method="get" action="{{route('timeKeepings.search')}}">
            <select name="month" id="select-search-timeKeepings" class="form-select" onchange="submit(document.getElementById('form_search_timeKeepings'))">
                <option value="1" @if ($data['selected_month'] == 1) selected @endif>Tháng 1</option>
                <option value="2" @if ($data['selected_month'] == 2) selected @endif>Tháng 2</option>
                <option value="3" @if ($data['selected_month'] == 3) selected @endif>Tháng 3</option>
                <option value="4" @if ($data['selected_month'] == 4) selected @endif>Tháng 4</option>
                <option value="5" @if ($data['selected_month'] == 5) selected @endif>Tháng 5</option>
                <option value="6" @if ($data['selected_month'] == 6) selected @endif>Tháng 6</option>
                <option value="7" @if ($data['selected_month'] == 7) selected @endif>Tháng 7</option>
                <option value="8" @if ($data['selected_month'] == 8) selected @endif>Tháng 8</option>
                <option value="9" @if ($data['selected_month'] == 9) selected @endif>Tháng 9</option>
                <option value="10" @if ($data['selected_month'] == 10) selected @endif>Tháng 10</option>
                <option value="11" @if ($data['selected_month'] == 11) selected @endif>Tháng 11</option>
                <option value="12" @if ($data['selected_month'] == 12) selected @endif>Tháng 12</option>
            </select>
        </form>
        <span class="p-2">/</span>
        <div class="text-nowrap">{{date('Y')}}</div>
    </div>


</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead style="background-color: #646464; color: white">
                <th class="text-center">Thứ 2</th>
                <th class="text-center">Thứ 3</th>
                <th class="text-center">Thứ 4</th>
                <th class="text-center">Thứ 5</th>
                <th class="text-center">Thứ 6</th>
                <th class="text-center">Thứ 7</th>
                <th class="text-center">Chủ nhật</th>
            </thead>
        
            <tbody>
                <tr>
                    @php
                        $late_day = 0;
                        $day_off = 0;
                        $year = date('Y'); // Lấy năm hiện tại
                        $month = $data['selected_month']; // Lấy tháng hiện tại
                        
                        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Số ngày trong tháng
                        $currentDay = 1;
                        $firstDayOfWeek = date('N', strtotime("$year-$month-01")); // lấy tên thứ của ngày đầu tiên trong tháng. các số 1-7 đại diện cho các thứ trong tuần bắt đầu từ t2-cn

                        // Điều chỉnh để đúng với thứ trong bảng
                        if ($firstDayOfWeek > 1) {
                            $currentDay -= $firstDayOfWeek - 1;         //$currentDay = $currentDay - ($firstDayOfWeek - 1);
                        }

                    @endphp
        
                    @for ($i = 0; $i < 7; $i++)
                        @if ($currentDay > 0)
                            <td style="
                                @php 
                                    if(isset($data[$currentDay]) && (date('H', strtotime(substr($data[$currentDay], 0, 8)))>8 || (date('H', strtotime(substr($data[$currentDay], 0, 8)))==8 && date('i', strtotime(substr($data[$currentDay], 0, 8))) >30 ))){
                                        echo 'background-color: #efd4b970;';
                                        $late_day += 1;
                                    }elseif ($data['selected_month'] < date('m') && !isset($data[$currentDay])) {
                                        echo 'background-color: #dbdbdb5c;';
                                        $day_off += 1;
                                    }elseif($data['selected_month'] == date('m') && !isset($data[$currentDay]) && $currentDay<date('d')){
                                        echo 'background-color: #dbdbdb5c;';
                                        $day_off += 1;
                                    }
                                    if($data['selected_month'] == date('m') && $currentDay==date('d')){
                                        echo 'box-shadow: inset 0px 0px 5px 0px #0072ffb0;';
                                    }
                                @endphp">
                                <div class="text-center fw-bold fs-5">{{ $currentDay }}</div>
                                <div class="d-flex justify-content-evenly">
                                    @if (isset($data[$currentDay]))
                                        {{ $data[$currentDay] }}
                                    @endif
                                </div>
                            </td>
                        @else
                            <td></td>
                        @endif

                        @php $currentDay++; @endphp
                    @endfor
                </tr>
        
                @php 
                    $count_row = ceil(($numDays - $currentDay + 1)/7);
                @endphp

                @for ($row = 1; $row <= $count_row; $row++)
                    <tr>
                        @for ($col = 0; $col < 7; $col++)
                            @if ($currentDay <= $numDays)
                            <td style="
                                @php 
                                    if(isset($data[$currentDay]) && (date('H', strtotime(substr($data[$currentDay], 0, 8)))>8 || (date('H', strtotime(substr($data[$currentDay], 0, 8)))==8 && date('i', strtotime(substr($data[$currentDay], 0, 8))) >30 ))){
                                        echo 'background-color: #efd4b970;';
                                        $late_day += 1;
                                    }elseif ($data['selected_month'] < date('m') && !isset($data[$currentDay])) {
                                        echo 'background-color: #dbdbdb5c;';
                                        $day_off += 1;
                                    }elseif($data['selected_month'] == date('m') && !isset($data[$currentDay]) && $currentDay<date('d')){
                                        echo 'background-color: #dbdbdb5c;';
                                        $day_off += 1;
                                    }
                                    if($data['selected_month'] == date('m') && $currentDay==date('d')){
                                        echo 'box-shadow: inset 0px 0px 5px 0px #0072ffb0;';
                                    }
                                @endphp">
                                    <div class="text-center fw-bold fs-5">{{ $currentDay }}</div>
                                    <div class="d-flex justify-content-evenly">
                                        @if (isset($data[$currentDay]))
                                            {{ $data[$currentDay] }}
                                        @endif
                                    </div>
                                </td>
                                @php
                                    $currentDay++;
                                @endphp
                            @else
                                <td></td>
                            @endif
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

<div>                                        
    <div class="d-flex align-items-center"><span class="d-inline-block rounded-circle m-2" style="width: 20px; height: 20px; border: 1px solid; background-color: #efd4b970"></span> <span>Đi muộn : {{$late_day}} ngày</span></div>
    <div class="d-flex align-items-center"><span class="d-inline-block rounded-circle m-2" style="width: 20px; height: 20px; border: 1px solid; background-color: #dbdbdb5c"></span> <span>Nghỉ : {{$day_off}} ngày</span></div>
</div>


{{-- model chấm công đầu giờ --}}
<div class="modal fade" id="timekeeping_start" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin: 275px auto;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #121a2f; color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Chấm công đầu giờ làm việc</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('timeKeepings.store') }}">
            @csrf
            <div>Thời gian bắt đầu ngày làm việc: {{date('Y-m-d H:i:s')}}</div>
            <input type="text" name="txt_start_time" id="" value="{{date('Y-m-d H:i:s')}}" readonly class="d-none">
            <div class="modal-footer mt-5 justify-content-center">
              <button type="submit" class="btn btn-luu">Lưu</button>
              <button type="button" class="btn btn-huy" data-bs-dismiss="modal">Hủy</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- model chấm công cuối giờ --}}
<div class="modal fade" id="timekeeping_end" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin: 275px auto;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #121a2f; color: white;">
          <h5 class="modal-title" id="exampleModalLabel">Chấm công cuối giờ làm việc</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('timeKeepings.update', $data['id']) }}">
              @csrf
              @method('PUT')
              <div>Thời gian kết thúc ngày làm việc: {{date('Y-m-d H:i:s')}}</div>
              <input type="text" name="txt_end_time" id="" value="{{date('Y-m-d H:i:s')}}" readonly class="d-none">
              <div class="modal-footer mt-5 justify-content-center">
                <button type="submit" class="btn btn-luu">Lưu</button>
                <button type="button" class="btn btn-huy" data-bs-dismiss="modal">Hủy</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection('content')


@section('footer')
<script src="{{ asset('js/master.js') }}"></script>
@endsection
