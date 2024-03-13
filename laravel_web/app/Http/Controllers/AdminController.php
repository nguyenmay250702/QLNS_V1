<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $current_account = Auth::user();
        return view("admins/index", compact("current_account"));
    }

    public function login(){
        Auth::logout();
        return view("login");
    }

    public function authLogin(UserRequest $request)
    {
        $request = $request->validated(); 

        // so sánh thông tin nhập ở form xem có trùng với db hay không
        if(Auth::attempt(["username"=>$request['username'], "password"=>$request['password']])){
            if($this->userRepository->find(Auth::user()->id)->status == 1){
                if(Auth::user()->role_id == 2) return redirect()->route("admins.index");
            }else{
                return redirect()->route("login")->withErrors(['wrong_information' => 'Tài khoản không hoạt động vui lòng kiểm tra lại thông tin đăng nhập!']);
            }
        }
        return redirect()->route("login")->withErrors(['wrong_information' => 'Tên đăng nhập hoặc mật khẩu không đúng!']);    
    }
}
