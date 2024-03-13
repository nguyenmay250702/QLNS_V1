<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- fontawesome-icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- font chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;600;700&display=swap" rel="stylesheet">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/master.css') }}">


</head>

<body>
    <!-- header -->
    <div class="header row d-flex justify-content-between">
        <div class="col-1 p-0">
            <img src="{{ asset('images/logo.png') }}" class="logo" alt="logo">
        </div>
        <div class="col d-flex p-0">
            <div class="col p-0 d-flex align-items-center text-end">
                <div class="col">
                    <span>
                        <img src="/images/avata.png" class="avatar rounded-circle" alt="logo">
                    </span>
                    <div class="d-none d-sm-inline-block">{{$current_account->username}}</div>
                </div>
            </div>
            <button class="col-1 w-auto fs-4 d-lg-none ms-3 rounded"
                onclick="menu(document.querySelector('.control'))">
                <i class="fa-solid fa-bars m-0"></i>
            </button>
        </div>
    </div>

    @php
        $currentUrl = $_SERVER['REQUEST_URI'];
        // echo $currentUrl;
        $keyword = '';

        if (strpos($currentUrl, 'qlcn=true') !== false) {
            if (strpos($currentUrl, 'staffs') !== false) {
                $keyword = 'qlcn/hscn';
            }elseif (strpos($currentUrl, 'dailyWorks') !== false) {
                $keyword = 'qlcn/cvhn';
            }elseif (strpos($currentUrl, 'contracts') !== false) {
                $keyword = 'qlcn/hdld';
            }

        }else{
            if (strpos($currentUrl, 'admins/index') !== false) {
                $keyword = 'admins/index';
            }elseif (strpos($currentUrl, 'users') !== false) {
                $keyword = 'users';
            }elseif (strpos($currentUrl, 'departments') !== false) {
                $keyword = 'departments';
            }elseif (strpos($currentUrl, 'positions') !== false) {
                $keyword = 'positions';
            }elseif (strpos($currentUrl, 'timeKeepings') !== false) {
                $keyword = 'timeKeepings';
            }elseif (strpos($currentUrl, 'staffs') !== false) {
                $keyword = 'staffs';
            }
        }
    @endphp
    <!-- main -->

    <div class="d-lg-flex main m-0">
        <!-- menu -->
        <div class="p-0" >
            <ul class="dropdown-menu control">
                <li>
                    <div class="dropdown-item p-0 img1"></div>
                </li>
                <li><a class="dropdown-item" @if ($keyword === 'admins/index') id="home" @endif
                        href="{{ route('admins.index') }}"><i class="fa-solid fa-house"></i>Trang chủ</a></li>
                <li data-bs-toggle="collapse" data-bs-target="#list_QLCN" aria-expanded="true"><a class="dropdown-item" href="#">
                    <i class="fa-solid fa-user-large"></i>
                    Quản lý cá nhân 
                    <i class="fa-solid fa-angle-down" style="margin-left: 45px"></i> 
                    </a> 
                </li>
                <ul class="list-group collapse " id="list_QLCN">
                    <li class="list-group-item" @if ($keyword === 'timeKeepings') id='home' @endif aria-disabled="true" style="padding-left: 43px; border-right: 0"> <a href="{{ route('timeKeepings.search') }}" class="text-decoration-none d-block border-0 p-0 bg-transparent"> Chấm công</a></li>
                    <li class="list-group-item" @if ($keyword === 'qlcn/cvhn') id='home' @endif style="padding-left: 43px; border-right: 0"> <a href="" class="text-decoration-none d-block border-0 p-0 bg-transparent">Công việc hàng ngày </a> </li>
                    <li class="list-group-item" @if ($keyword === 'qlcn/hscn') id='home' @endif style="padding-left: 43px; border-right: 0"> <a href="{{ route('staffs.show', $current_account->staff_id) }}?qlcn=true" class="text-decoration-none d-block border-0 p-0 bg-transparent">Hồ sơ cá nhân </a> </li>
                    <li class="list-group-item" @if ($keyword === 'qlcn/hdld') id='home' @endif style="padding-left: 43px; border-right: 0"> <a href="" class="text-decoration-none d-block border-0 p-0 bg-transparent">Hợp đồng lao động </a> </li>
                    <li class="list-group-item" @if ($keyword === 'qlcn/hdld') id='home' @endif style="padding-left: 43px; border-right: 0"> <a href="" class="text-decoration-none d-block border-0 p-0 bg-transparent">Đổi mật khẩu </a> </li>
                </ul>

                <li>
                    <a class="dropdown-item" href="{{route('staffs.search')}}" @if ($keyword === 'staffs') id='home' @endif>
                    <i class="fa-solid fa-users-gear"></i> Quản lý nhân viên </a>
                </li>
                <li data-bs-toggle="collapse" data-bs-target="#list_QLL" aria-expanded="true"><a class="dropdown-item" href="#">
                    <i class="fa-solid fa-user-large"></i>
                    Quản lý lương
                    <i class="fa-solid fa-angle-down" style="margin-left: 45px"></i> 
                    </a> 
                </li>
                <ul class="list-group collapse " id="list_QLL">
                    <li class="list-group-item" @if ($keyword === 'timeKeepings') id='home' @endif aria-disabled="true" style="padding-left: 43px; border-right: 0"> <a href="{{ route('staffs.index') }}" class="text-decoration-none d-block border-0 p-0 bg-transparent">Điều chỉnh bậc lương</a></li>
                    <li class="list-group-item" @if ($keyword === 'qlcn/cvhn') id='home' @endif style="padding-left: 43px; border-right: 0"> <a href="{{ route('salaryDetails.search') }}" class="text-decoration-none d-block border-0 p-0 bg-transparent">Tính lương nhân viên</a> </li>
                </ul>
                <li><a class="dropdown-item" href="{{route('users.search')}}" @if ($keyword === 'users') id='home' @endif><i class="fa-solid fa-user-shield"></i> Quản lý tài khoản</a></li>
                <li>
                <li><a class="dropdown-item" href="{{route('departments.search')}}" @if ($keyword === 'departments') id='home' @endif><i class="fa-solid fa-building"></i> Quản lý phòng ban</a></li>
                <li>
                <li><a class="dropdown-item" href="{{route('positions.search')}}" @if ($keyword === 'positions') id='home' @endif><i class="fa-solid fa-map"></i> Quản lý chức vụ</a></li>
                <li>
                    <li><a class="dropdown-item"
                        href="#"><i class="fa-solid fa-address-book"></i> Quản lý hợp đồng lao động</a></li>
                    <li>
                <li><a class="dropdown-item"
                    href="#"><i class="fa-solid fa-gear"></i> Cấu hình</a></li>
                <li>
                    <div style="border-top: 1px solid; height: 7px; border-bottom: 1px solid;"></div>
                </li>
                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fa-solid fa-right-from-bracket"></i>
                        Đăng xuất</a></li>
            </ul>
        </div>

        <!-- content -->
        <div class="container-full" style="color: black; font-size: 15px">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('footer')

</body>

</html>
