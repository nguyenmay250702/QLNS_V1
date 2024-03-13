@extends('master')

@section('content')
<div class="container-full mt-2">
        <div class="card mb-5 title">
            <div style="border-right: 5px solid #f87729;border-radius: 0.25rem 0 0 0.25rem;"></div>
            <div style="padding: 10px">
                Danh sách nhân viên/Tạo mới nhân viên
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span style="font-weight: 600;">Tạo mới nhân viên</span>
                <div style="border-top: 2px solid #f87729; margin-top: 5px;"></div>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('staffs.store') }}">
                    @csrf
                    <input name='function' type="text" hidden value="create">
                    <div class="d-lg-flex justify-content-between">
                        <div class="mb-3 w-100" style="align-items: center;">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Tên nhân viên:</label>
                                <div class="">
                                    <input type="text" name="txt_name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('txt_name') }}"/>
                                    @error('name')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Địa chỉ:</label>
                                <div class="">
                                    <input type="text" name="txt_address" class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('txt_address') }}"/>
                                    @error('address')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Số điện thoai:</label>
                                <div class="">
                                    <input type="text" name="txt_phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('txt_phone_number') }}" oninput="validateInput_int(this, 9999999999)"/>
                                    @error('phone_number')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Ngày sinh:</label>
                                <div class="">
                                    <input type="date" name="txt_birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ old('txt_birthday') }}" />
                                    @error('birthday')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="mb-3 w-100">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Phòng ban:</label>
                                <div class="d-flex align-items-center">
                                    <select name="txt_department" id="staff_id" class="form-select @error('department_id') is-invalid @enderror">
                                        <option value=-1>--chọn phòng ban--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <div id="staff_name" class="w-100 text-nowrap ms-4">--tên nhân viên--</div> --}}
                                </div>
                                @error('department_id')
                                    <div style="color: red;font-style: italic">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Giới tính:</label>
                                <div class="d-flex justify-content-evenly p-2">
                                    <div class="form-check m-0" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="txt_gender" id="flexRadioDefault1" value="0" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">nam</label>
                                    </div>
                                    <div class="form-check m-0" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="txt_gender" id="flexRadioDefault2" value="1">
                                        <label class="form-check-label" for="flexRadioDefault2">nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Trạng thái:</label>
                                <div class="d-flex justify-content-evenly p-2">
                                    <div class="form-check m-0" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="txt_status" id="flexRadioDefault2" value="1" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">hoạt động</label>
                                    </div>
                                    <div class="form-check m-0" style="width: 100px;">
                                        <input class="form-check-input" type="radio" name="txt_status" id="flexRadioDefault1" value="0">
                                        <label class="form-check-label" for="flexRadioDefault1">nghỉ việc</label>
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
                <div>Bạn có chắc chắn muốn thoát khỏi chức năng thêm nhân viên không?</div>
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