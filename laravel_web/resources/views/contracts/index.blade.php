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
        {{-- <div class="card mb-5 title">
            <div style="border-right: 5px solid #f87729;border-radius: 0.25rem 0 0 0.25rem;"></div>
            <div style="padding: 10px">
                Danh sách nhân viên
            </div>
        </div> --}}

        {{-- from tìm kiếm --}}
        <div class="card">
            <div class="card-body">
                <span style="font-weight: 600;">Tìm kiếm nhân viên</span>
                <div style="border-top: 2px solid #f87729; margin-top: 5px;"></div>
            </div>

            <div class="card-body">
                <form method="get" action="{{ route('staffs.search') }}" id="form_search">
                    @csrf
                    <input name='function' type="text" hidden value="search">
                    <div class="d-lg-flex justify-content-between">
                        <div class="mb-3 w-100" style="align-items: center;">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Tên nhân viên:</label>
                                <div class="">
                                    <input type="text" name="txt_name" class="form-control"
                                        value="@if(isset($_GET['txt_name'])) {{$_GET['txt_name']}} @endif"/>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Địa chỉ:</label>
                                <div class="">
                                    <input type="text" name="txt_address" class="form-control"
                                    value="@if(isset($_GET['txt_address'])) {{$_GET['txt_address']}} @endif"/>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Số điện thoai:</label>
                                <div class="">
                                    <input type="text" name="txt_phone_number" class="form-control" value="@if(isset($_GET['txt_phone_number'])) {{$_GET['txt_phone_number']}} @endif" oninput="validateInput_int(this, 9999999999)"/>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Ngày sinh:</label>
                                <div class="">
                                    <input type="date" name="txt_birthday" class="form-control" value="{{ isset($_GET['txt_birthday']) ? $_GET['txt_birthday'] : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 w-100">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Giới tính:</label>
                                <div class="d-flex align-items-center">
                                    <select name="txt_gender" id="staff_id" class="form-select">
                                        <option value="-1">--chọn giới tính--</option>
                                        <option value=0 @if(isset($_GET['txt_gender'])&& ($_GET['txt_gender']==0)) selected @endif>nam</option>
                                        <option value=1 @if(isset($_GET['txt_gender'])&& ($_GET['txt_gender']==1)) selected @endif>nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Phòng ban:</label>
                                <div class="d-flex align-items-center">
                                    <select name="txt_department" id="staff_id" class="form-select">
                                        <option value=-1>--chọn phòng ban--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}" @if(isset($_GET['txt_department'])&& ($_GET['txt_department']==$department->id)) selected @endif>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Trạng thái:</label>
                                <div class="d-flex align-items-center">
                                    <select name="txt_status" id="staff_id" class="form-select">
                                        <option value="-1">--chọn trạng thái--</option>
                                        <option value=0 @if(isset($_GET['txt_status'])&& ($_GET['txt_status']==0)) selected @endif>nghỉ việc</option>
                                        <option value=1 @if(isset($_GET['txt_status'])&& ($_GET['txt_status']==1)) selected @endif>hoạt động</option>
                                    </select>
                                </div>
                            </div>                           
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-luu m-2" value="Tìm kiếm" />
                        <a type="button" href="{{route("staffs.search")}}" class="btn btn-huy m-2">Hủy</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Bảng dữ liệu --}}
        <div class="card mt-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('staffs.create') }}" class="btn btn-mau btn-sm" style="width: 130px;">+ Tạo mới</a>
                    {{-- <button type="button" class="btn btn-sm btn-mau" data-bs-toggle="modal" data-bs-target="#searchModal"
                        style="margin: 0 10px; width: 130px;"><i class="fa-brands fa-searchengin"></i> Tìm kiếm</button> --}}
                    <button class="btn btn-mau btn-sm" style="submit; display: inline-block; width: 130px; "
                        data-bs-toggle="modal" data-bs-target="#xuatdulieuModal"><i class="fa-solid fa-download"></i> Xuất dữ
                        liệu</button>
                </div>

                {{-- phân trang --}}
                <div class="d-flex align-items-center">
                    <div class="mx-2">1 - {{$data->perPage()}} of {{$data->total()}}</div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination m-0">
                            @if ($data->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-hidden="true">&lt; black</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->previousPageUrl() }}"  aria-label="Previous" style="border: 1px solid #597cf3a6;">
                                        <span aria-hidden="true">&lt; black</span>
                                    </a>
                                </li>
                            @endif
                            
                            @if ($data->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next" style="border: 1px solid #597cf3a6;">
                                        <span aria-hidden="true">next &gt;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-hidden="true">next &gt;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div style="border-top: 1px solid rgb(234, 231, 231);"></div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: #646464; color: white">
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th>Giới tính</th>
                        <th>Phòng ban</th>
                        <th>Trạng thái</th>
                        <th class="border-0">Thao tác</th>
                    </thead>
                    @if (count($data) > 0)
                        @php
                            $stt = $data->perPage() * $data->currentPage() - $data->perPage();
                            $count = 0;
                        @endphp
                        @foreach ($data as $row)
                            @php
                                $stt++;
                                $count++;
                            @endphp
                            <tr>
                                <td class="text-end" style="width: 83px;">{{ $stt }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td>{{ $row['phone_number'] }}</td>
                                <td>{{ $row['birthday'] }}</td>
                                <td>{{ $row['address'] }}</td>
                                <td>@if($row['gender'] == 1) nữ @else nam @endif</td>
                                <td>{{ $row['department_name'] }}</td>
                                <td>@if($row['status']==0) nghỉ việc @else hoạt động @endif</td>
                                <td class="position-relative" style="text-align: center;">
                                    {{-- <a href="{{ route('staffs.show', $row->id) }}" class="btn btn-sm btn-mau"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('staffs.edit', $row->id) }}" class="btn btn-sm btn-mau"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="btn btn-sm btn-mau" data-bs-toggle="modal" data-bs-target="#xoaModal"
                                        data-bs-whatever="{{ $row->id }}"><i class="fa-solid fa-trash"></i></button> --}}
                                    {{-- <button class="border-0 bg-transparent w-100 h-100" data-bs-toggle="collapse" data-bs-target="#list_action{{$stt}}" aria-expanded="true"><i class="fa-solid fa-ellipsis-vertical m-0"></i></button> --}}

                                    <button class="border-0 bg-transparent w-100 h-100 position-relative" style="z-index: 3" onclick="action({{$count}}, document.querySelectorAll('.action'))"><i class="fa-solid fa-ellipsis-vertical m-0"></i></button>
                                    <div id="list_action{{$stt}}" class="action d-none position-absolute bg-secondary-subtle ">
                                        <a href="{{ route('staffs.show', $row['id']) }}" class="action_item px-3 py-2"><i class="fa-solid fa-eye"></i>xem</a>
                                        <a href="{{ route('staffs.edit', $row['id']) }}" class="action_item px-3 py-2"><i class="fa-solid fa-pen-to-square" style="margin-right: 11px;"></i>sửa</a>
                                        <button class="action_item px-3 py-2 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#xoaModal" data-bs-whatever="{{ $row['id'] }}"><i class="fa-solid fa-trash"></i> xóa</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">Chưa có dữ liệu</td>
                        </tr>
                    @endif
                </table>
                {{-- {!! $data->links() !!} --}}
            </div>
        </div>
    </div>

    {{-- model xóa --}}
    <div class="modal fade" id="xoaModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="margin: 275px auto;">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #121a2f; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_delete" method="post" action="">
                        @csrf
                        @method('DELETE')
                        <div>Bạn có chắc chắn muốn xóa thông tin nhân viên không?</div>
                        <div class="modal-footer mt-5 justify-content-center">
                            <button type="submit" class="btn btn-luu">Có</button>
                            <button type="button" class="btn btn-huy" data-bs-dismiss="modal">Không</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @error('notdelete')block @enderror
    
@endsection('content')

@section('footer')
    <script>
        var xoaModal = document.getElementById('xoaModal');
        xoaModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var recipient = button.getAttribute('data-bs-whatever');

            var form = xoaModal.querySelector('form');
            form.action = "{{ route('staffs.destroy', 'RECIPIENT') }}".replace('RECIPIENT', recipient);
        });

        // window.addEventListener('scroll', function() {
        //     if (window.pageYOffset > 100) {
        //         window.scrollTo(0, 100);
        //     }
        // });
    </script>
    <script src="{{ asset('js/master.js') }}"></script>
@endsection
