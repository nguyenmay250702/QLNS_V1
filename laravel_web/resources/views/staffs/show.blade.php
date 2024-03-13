@extends('master')

@section('content')
<div class="container-full mt-2">
        <div class="card mb-5 title">
            <div style="border-right: 5px solid #f87729;border-radius: 0.25rem 0 0 0.25rem;"></div>
            <div style="padding: 10px">
                Danh sách nhân viên/Xem thông tin nhân viên
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span style="font-weight: 600;">Xem thông tin nhân viên</span>
                <div style="border-top: 2px solid #f87729; margin-top: 5px;"></div>
            </div>

            <div class="card-body p-5" style="margin: 3% 20%; border: 1px solid #d7d7d7;">
                <div class="d-flex justify-content-between mb-5">
                    <div style="width: 130px; height: 160px; border: 1px solid #bbbbbb;">4x6</div>
                    <div>
                        <div class="fw-bold">Thông tin cá nhân</div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Họ tên: </span> <span>{{$staff->name}}</span></div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Ngày sinh: </span> <span>{{$staff->birthday}}</span></div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Căn cước công dân: </span> <span>{{$staff->citizen_identity_card}}</span></div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Số điện thoại: </span> <span>{{$staff->phone_number}}</span></div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Địa chỉ: </span> <span>{{$staff->address}}</span></div>
                        <div class="py-1"><span class="d-inline-block" style="width: 150px">Giới tính: </span> <span> @if($staff->gender==1) nữ @else nam @endif </span></div>
                    </div>
                </div>
                <div>
                    <div class="fw-bold">Thông tin làm việc TMQ</div>
                    <table class="table">
                        <thead>
                          <tr>
                            <td>#</td>
                            <td>Công việc</td>
                            <td>Thời gian bắt đầu</td>
                            <td>Thời gian kết thúc</td>
                            <td>Mã hợp đồng</td>
                            <td>Trạng thái</td>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($contracts) > 0)
                                @php $stt = 1; @endphp
                                @foreach ($contracts as $contract)
                                    <tr>
                                        <td>{{$stt}}</td>
                                        <td>{{$contract->position_name}}</td>
                                        <td>{{$contract->start_date}}</td>
                                        <td>{{$contract->end_date}}</td>
                                        <td>Mã hợp đồng</td>
                                        <td>@if($contract->status == 0) đã kết thúc @else tiếp tục @endif</td>
                                    </tr>
                                    @php $stt ++; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                      </table>
                </div>
            </div>

            @if(!isset($_GET['qlcn']))  
                <div class="text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-huy m-2">Quay lại</button>
                </div>
            @endif
        </div>
    </div>

 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #364150; color: #f4f7f9">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 600;">Xác nhận</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 15px;color: black">
                <div>Bạn có chắc chắn muốn thoát khỏi chức năng xem thông tin nhân viên không?</div>
            </div>
            <div class="modal-footer" style="justify-content: center; display: flex;">
                <a href="{{ route('staffs.search') }}" class="btn btn-luu">có</a>
                <button type="button" class="btn btn-huy" data-bs-dismiss="modal">không</button>
            </div>
        </div>
    </div>
</div>

@endsection('content')

@section('footer')
<script src="{{ asset('js/master.js') }}"></script>
@endsection