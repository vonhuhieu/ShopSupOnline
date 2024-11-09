<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\admin\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\Country;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_profile_form()
    {
        $user_info = User::findOrFail(Auth::id());
        $countries = Country::all();
        return view('admin/profile/profile', compact('user_info','countries'));
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $old_user_info = User::findOrFail(Auth::id());
        $old_avatar = $old_user_info->avatar ?? '';
        $data = $request->except(['password','password_confirm','avatar']);
        if($request->filled('password'))
        {
            $data['password'] = bcrypt($request->password);
        }
        if(!is_dir(public_path('/admin/avatar/'.Auth::id())))
        {
            mkdir(public_path('/admin/avatar/'.Auth::id()));
        }
        if($request->hasFile('avatar'))
        {
            $new_avatar = time().'_'.$request->file('avatar')->getClientOriginalName();
            $data['avatar'] = $new_avatar;
        }
        if($old_user_info->update($data))
        {
            if($request->hasFile('avatar'))
            {
                if($old_avatar != '' && file_exists(public_path('/admin/avatar/'.Auth::id().'/'.$old_avatar)))
                {
                    unlink(public_path('/admin/avatar/'.Auth::id().'/'.$old_avatar));
                }
                $request->file('avatar')->move(public_path('/admin/avatar/'.Auth::id()), $new_avatar);
            }
            return redirect()->back()->with('success', __('Cập nhật trang cá nhân thành công'));
        }
        else
        {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại');
        }
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect('/');
    }
}
