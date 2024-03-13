@extends('master')

@section('content')
<div class="container-full mt-2">
        <div class="card mb-5 title">
            <div style="border-right: 5px solid #f87729;border-radius: 0.25rem 0 0 0.25rem;"></div>
            <div style="padding: 10px">
                Danh sách tài khoản/Sửa thông tin tài khoản
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span style="font-weight: 600;">Sửa thông tin tài khoản</span>
                <div style="border-top: 2px solid #f87729; margin-top: 5px;"></div>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <input name='function' type="text" hidden value="update">
                    <input name='id' type="text" hidden value="{{$user->id}}">
                    <div class="d-lg-flex justify-content-between">
                        <div class="mb-3 w-100" style="align-items: center;">
                            <div class="mx-5 my-3">
                                <label class="col-label-form">Tên đăng nhập:</label>
                                <div class="">
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                        value="{{ $user->username }}"/>
                                    @error('username')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-5 my-3">
                                <label class="col-label-form">Mật khẩu:</label>
                                <div class="">
                                    <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" value="" />
                                    @error('password')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-5 my-3">
                                <label class="col-label-form">Nhân viên:</label>
                                <div class="d-flex align-items-center">
                                    <select name="staff_id" id="staff_id" class="form-select @error('staff_id') is-invalid @enderror" onchange="display_name_by_id(document.getElementById('staff_id'), document.getElementById('staff_name'))">
                                        <option value="--chọn mã nhân viên--">--chọn mã nhân viên--</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{$staff->id}}" data-staffname="{{ $staff->name }}" @php if($user->staff_id ==$staff->id ) {echo 'selected'; $tennv = $staff->name; } @endphp>{{$staff->id}}</option>
                                        @endforeach
                                    </select>
                                    <div id="staff_name" class="w-100 text-nowrap ms-4">{{$tennv}}</div>
                                </div>
                                @error('staff_id')
                                    <div style="color: red;font-style: italic">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 w-100">
                            <div class="mx-5 my-3">
                                <label class="col-label-form">Trạng thái:</label>
                                <div class="d-flex justify-content-evenly p-2">
                                    <div class="form-check" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault0" value="0" @if($user->status ==0 ) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault0">dừng</label>
                                    </div>
                                    <div class="form-check" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="1" @if($user->status ==1 ) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault1">hoạt động</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-5 my-3">
                                <label class="col-label-form">Phân quyền:</label>
                                <div class="d-flex justify-content-evenly p-2">
                                    <div class="form-check" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="role_id" id="flexRadioDefault2" value="1" @if($user->role_id ==1 ) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault2">nhân viên</label>
                                    </div>
                                    <div class="form-check" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="role_id" id="flexRadioDefault3" value="2" @if($user->role_id ==2 ) checked @endif>
                                        <label class="form-check-label" for="flexRadioDefault3">quản lý</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-luu m-2" value="Lưu" />
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="btn btn-huy m-2">Hủy</button>
                    </div>
                </form>
            </div>
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
                <div>Bạn chưa lưu dữ liệu! </div>
                <div>Bạn có chắc chắn muốn thoát khỏi chức năng sửa thông tin tài khoản không?</div>
            </div>
            <div class="modal-footer" style="justify-content: center; display: flex;">
                <a href="{{ route('users.search') }}" class="btn btn-luu">có</a>
                <button type="button" class="btn btn-huy" data-bs-dismiss="modal">không</button>
            </div>
        </div>
    </div>
</div>

@endsection('content')

@section('footer')
<script src="{{ asset('js/master.js') }}"></script>
@endsection