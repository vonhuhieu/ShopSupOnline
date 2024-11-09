<?php

namespace App\Http\Controllers\member\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Country;
use App\Http\Requests\member\UpdateMemberAccountRequest;

class AccountController extends Controller
{
    public function account()
    {
        return view('member/account/account');
    }

    public function account_update_form()
    {
        $user_info = User::findOrFail(Auth::id());
        $countries = Country::all();
        return view('member/account/account_update', compact('user_info', 'countries'));
    }

    public function account_update(UpdateMemberAccountRequest $request)
    {
        $old_user_info = User::findOrFail(Auth::id());
        $old_avatar = $old_user_info->avatar ?? '';
        $data = $request->except(['password','password_confirm','avatar']);
        if($request->filled('password'))
        {
            $data['password'] = bcrypt($request->password);
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
                if($old_avatar != '' && file_exists(public_path('/member/avatar/'.Auth::id().'/'.$old_avatar)))
                {
                    unlink(public_path('/member/avatar/'.Auth::id().'/'.$old_avatar));
                }
                $request->file('avatar')->move(public_path('/member/avatar/'.Auth::id()),$new_avatar);
            }
            return redirect()->back()->with('success', __('Cập nhật tài khoản thành công'));
        }
        else
        {
            return redirect()->back()->withErrors('Cập nhật tài khoản thất bại');
        }
    }
}
