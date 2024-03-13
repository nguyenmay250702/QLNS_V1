<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends CommonController
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $this->userRepository->store($data);
        return redirect()->route("users.search")->with('success', 'Tạo mới tài khoản thành công.');
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        unset($data['password']);

        $user = $this->userRepository->update($user->id, $data);
        return redirect()->route("users.search")->with('success', 'Cập nhật thông tin tài khoản thành công.');
    }

    public function destroy(User $user)
    {
        if( $user->id == Auth::user()->id ) return redirect()->back()->with('error', 'Không thể xóa tài khoản đang hoạt động.');
        $this->userRepository->update($user->id, ['status'=> 0]);
        return redirect()->back()->with('success', 'Xóa tài khoản thành công thành công.');
    }

}
