@extends('master')

@section('content')
@if ($message = Session::get('success'))
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-absolute top-0 end-0" style="z-index: 7; background: #19681f; padding: 1px;">
        <div class="toast" delay="10000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa-solid fa-circle-check" style="color: #0c7a0a; font-size: 21px;"></i>
                <strong class="me-auto"><b>Thông báo</b></strong>
                <small class="text-muted" id="toast-timestamp">vừa xong</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('error'))
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-absolute top-0 end-0"
        style="z-index: 7; background: #fc0101;; padding: 1px;">
        <div class="toast" delay="10000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa-solid fa-circle-xmark" style="color: red; font-size: 21px;"></i>
                <strong class="me-auto"><b>Thông báo</b></strong>
                <small class="text-muted" id="toast-timestamp">vừa xong</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>
</div>
@endif



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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Thêm 1 nhân
                            viên</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Thêm nhiều
                            nhân viên</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <form method="post" action="{{ route('staffs.store') }}" class="tab-pane fade show active"
                        id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @csrf
                        <input name='function' type="text" hidden value="create">
                        <div class="d-lg-flex justify-content-between">
                            <div class="mb-3 w-100" style="align-items: center;">
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Tên nhân viên:</label>
                                    <div class="">
                                        <input type="text" name="txt_name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('txt_name') }}" />
                                        @error('name')
                                            <div style="color: red;font-style: italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Địa chỉ:</label>
                                    <div class="">
                                        <input type="text" name="txt_address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('txt_address') }}" />
                                        @error('address')
                                            <div style="color: red;font-style: italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Số điện thoai:</label>
                                    <div class="">
                                        <input type="text" name="txt_phone_number"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            value="{{ old('txt_phone_number') }}" oninput="validateInput_int(this)" />
                                        @error('phone_number')
                                            <div style="color: red;font-style: italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Căn cước công dân:</label>
                                    <div class="">
                                        <input type="text" id ="citizen_identity_card" name="txt_citizen_identity_card"
                                            class="form-control @error('citizen_identity_card') is-invalid @enderror"
                                            value="{{ old('txt_citizen_identity_card') }}"
                                            oninput="validateInput_int(this)" />
                                        @error('citizen_identity_card')
                                            <div style="color: red;font-style: italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 w-100">
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Ngày sinh:</label>
                                    <div class="">
                                        <input type="date" name="txt_birthday"
                                            class="form-control @error('birthday') is-invalid @enderror"
                                            value="{{ old('txt_birthday') }}" />
                                        @error('birthday')
                                            <div style="color: red;font-style: italic">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Phòng ban:</label>
                                    <div class="d-flex align-items-center">
                                        <select name="txt_department" id="staff_id"
                                            class="form-select @error('department_id') is-invalid @enderror">
                                            <option value=-1>--chọn phòng ban--</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if ($department->id == old('txt_department')) selected @endif>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department_id')
                                        <div style="color: red;font-style: italic">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Giới tính:</label>
                                    <div class="d-flex justify-content-evenly p-2">
                                        <div class="form-check m-0" style="width: 100px;">
                                            <input class="form-check-input" type="radio" name="txt_gender"
                                                id="flexRadioDefault1" value="0" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">nam</label>
                                        </div>
                                        <div class="form-check m-0" style="width: 100px;">
                                            <input class="form-check-input" type="radio" name="txt_gender"
                                                id="flexRadioDefault2" value="1">
                                            <label class="form-check-label" for="flexRadioDefault2">nữ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-5 my-4">
                                    <label class="col-label-form">Trạng thái:</label>
                                    <div class="d-flex justify-content-evenly p-2">
                                        <div class="form-check m-0" style="width: 100px;">
                                            <input class="form-check-input" type="radio" name="txt_status"
                                                id="flexRadioDefault2" value="1" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">hoạt động</label>
                                        </div>
                                        <div class="form-check m-0" style="width: 100px;">
                                            <input class="form-check-input" type="radio" name="txt_status"
                                                id="flexRadioDefault1" value="0">
                                            <label class="form-check-label" for="flexRadioDefault1">nghỉ việc</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-luu m-2" value="Lưu" onclick="updateElement()" />
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-huy m-2">Hủy</button>
                        </div>
                    </form>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="tap_import_staff">
                            <div class="position-relative d-flex align-items-center">
                                <div class="position-absolute d-md-inline-block d-none" style=" width: 180px; left: calc(60% - 410px);">Tải xuống mẫu điền danh sách thông tin nhân viên.</div>
                                <div class="download_template btn-mau d-flex align-items-center justify-content-center"><a class="d-inline-block text-align-center text-decoration-none p-3" href="{{ asset('templates/mẫu danh sách nhân viên cần thêm.xlsx') }}" style="color: #212529">download template</a></div>
                            </div>
                            <form method="post" action="{{ route('staffs.import') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="position-relative d-flex align-items-center">
                                    <div class="position-absolute d-md-inline-block d-none" style=" width: 180px; left: calc(60% - 320px);">Tải lên danh sách thông tin nhân viên.</div>
                                    <div class="import_file_data btn-mau d-flex align-items-center justify-content-center position-relative">   
                                        <input name="txt_file" type="file" accept=".xlsx" onchange="getValue()" class="position-absolute btn" style="opacity: 0">
                                        <span>import file data</span>
                                        <div id="txt_file_value" class="position-absolute end-0 text-end fw-normal" style="bottom: -35px; width: 300px;"></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-luu">Thêm nhân viên</button>
                            </form>  
                            @if(Session::has('importError'))
                                <div>Hiện có 4 nhân viên chưa được thêm thành công! <a href="{{ asset('templates/') }}/{{ Session::get('importError') }}">xem</a></div>                    
                            @endif
                        </div>
                    </div>
                </div>
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

    <!-- Modal nhân viên đã từng làm việc tại cty -->
    <div class="modal @if ($errors->has('isPastStaff')) d-flex @endif align-items-center" id="modal2" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #364150; color: #f4f7f9">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 600;">Xác nhận</h5>
                </div>
                <div class="modal-body" style="font-size: 15px;color: black">
                    <div>Nhân viên này đã từng làm việc tại công ty.</div>
                    <div>Bạn có muốn cập nhật trạng thái làm việc và thông tin cho nhân viên này không?</div>
                </div>
                <div class="modal-footer" style="justify-content: center; display: flex;">
                    <a id="modal2a" href="{{ route('staffs.edit', $errors->first('isPastStaff')) }}"
                        class="btn btn-luu">có</a>
                    <button type="button" class="btn btn-huy"
                        onclick="menu(document.getElementById('modal2'), document.getElementById('model_2_1'))">không</button>
                </div>
            </div>
        </div>
    </div>
    <div id="model_2_1" class="modal-backdrop show @if (!$errors->has('isPastStaff')) d-none @endif"></div>
@endsection('content')

@section('footer')
    <script src="{{ asset('js/master.js') }}"></script>
@endsection
