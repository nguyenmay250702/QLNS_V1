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
                Danh sách tài khoản
            </div>
        </div>

        {{-- from tìm kiếm --}}
        <div class="card">
            <div class="card-body">
                <span style="font-weight: 600;">Tìm kiếm</span>
                <div style="border-top: 2px solid #f87729; margin-top: 5px;"></div>
            </div>

            <div class="card-body">
                <form method="get" action="{{ route('salaryDetails.search') }}">
                    {{-- <input name='function' type="text" hidden value="search"> --}}
                    <div class="d-lg-flex justify-content-between">
                        <div class="mb-3 w-100" style="align-items: center;">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Ngày nhận lương:</label>
                                <div class="">
                                    <input type="date" name="txt_pay_date" class="form-control"
                                    value="{{isset($_GET['txt_pay_date'])? $_GET['txt_pay_date']:''}}"/>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Tài khoản:</label>
                                <div class="">
                                    <input type="text" name="txt_username" class="form-control"
                                        value="@if(isset($_GET['txt_username'])) {{$_GET['txt_username']}} @endif"/>
                                </div>
                            </div>
                            <div class="mx-5 my-4">
                                <label class="col-label-form">tên nhân viên:</label>
                                <div class="">
                                    <input type="text" name="txt_staff_name" class="form-control" value="@if(isset($_GET['txt_staff_name'])) {{$_GET['txt_staff_name']}} @endif"/>
                                </div>
                            </div>      
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Lương cơ bản:</label>
                                <div class="">
                                    <input type="number" name="txt_basic_salary" class="form-control" value="{{isset($_GET['txt_basic_salary'])? $_GET['txt_basic_salary']:''}}"/>
                                </div>
                            </div>                       
                        </div>
                        <div class="mb-3 w-100">
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Thời gian OT:</label>
                                <div class="">
                                    <input type="number" name="txt_overtime" class="form-control" value="{{isset($_GET['txt_overtime'])? $_GET['txt_overtime']:''}}"/>
                                </div>
                            </div>  
                           
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Số ngày đi muộn:</label>
                                <div class="">
                                    <input type="number" name="txt_late_arrival_date" class="form-control" value="{{isset($_GET['txt_late_arrival_date'])? $_GET['txt_late_arrival_date']:''}}"/>
                                </div>
                            </div>  
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Nghỉ không lương:</label>
                                <div class="">
                                    <input type="number" name="txt_unpaid_leave_days" class="form-control" value="{{isset($_GET['txt_unpaid_leave_days'])? $_GET['txt_unpaid_leave_days']:''}}"/>
                                </div>
                            </div>   
                            <div class="mx-5 my-4">
                                <label class="col-label-form">Tổng tiền:</label>
                                <div class="">
                                    <input type="number" name="txt_total_salary" class="form-control" value="{{isset($_GET['txt_total_salary'])? $_GET['txt_total_salary']:''}}"/>
                                </div>
                            </div>              
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-luu m-2" value="Tìm kiếm" />
                        <a type="button" href="{{route("salaryDetails.search")}}" class="btn btn-huy m-2">Hủy</a>
                    </div>
                </form>
            </div>
        </div>


        {{-- Bảng dữ liệu --}}
        <div class="card mt-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <form method="post" action="{{ route('salaryDetails.store') }}">
                        @csrf
                        <button type="submit" class="btn btn-mau btn-sm" style="width: 130px;">Tính lương</button>
                    </form>

                    <button class="btn btn-mau btn-sm ms-2" style="submit; display: inline-block; width: 130px; "
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
                        <th>Tài khoản</th>
                        <th>Tên nhân viên</th>
                        <th>Lương cơ bản</th>
                        <th>Thời gian OT</th>
                        <th>Số ngày đi muộn</th>
                        <th>Nghỉ không lương</th>
                        <th>Tổng tiền</th>
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
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->basic_salary }}</td>
                                <td>{{ $row->overtime }}</td>
                                <td>{{ $row->late_arrival_date }}</td>
                                <td>{{ $row->unpaid_leave_days }}</td>
                                <td>{{ $row->total_salary }}</td>                            
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
    {{-- <div class="modal fade" id="xoaModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <div>Bạn có chắc chắn muốn xóa tài khoản không?</div>
                        <div class="modal-footer mt-5 justify-content-center">
                            <button type="submit" class="btn btn-luu">Có</button>
                            <button type="button" class="btn btn-huy" data-bs-dismiss="modal">Không</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @error('notdelete')block @enderror --}}
    

    {{-- model xóa --}}
    {{-- <div class="modal fade show d-block" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" style="margin: 275px auto;">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #121a2f; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel1">Xác nhận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>Không thể xóa tài khoản đang hoạt động?</div>
                    <div class="modal-footer mt-5 justify-content-center">
                        <button type="button" class="btn btn-huy" data-bs-dismiss="modal">Đã hiểu</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection('content')

@section('footer')
    {{-- <script>
        var xoaModal = document.getElementById('xoaModal');
        xoaModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var recipient = button.getAttribute('data-bs-whatever');

            var form = xoaModal.querySelector('form');
            form.action = "{{ route('users.destroy', 'RECIPIENT') }}".replace('RECIPIENT', recipient);
        });
    </script> --}}
    <script src="{{ asset('js/master.js') }}"></script>
@endsection
