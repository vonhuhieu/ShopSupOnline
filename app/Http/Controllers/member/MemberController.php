<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\member\MemberRegisterRequest;
use App\Models\User;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\admin\Country;
use App\Http\Requests\member\MemberLoginRequest;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function member_register_form()
    {
        $countries = Country::all();
        return view('member/member/member_register', compact('countries'));
    }

    public function member_register(MemberRegisterRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = time().'_'.$request->file('avatar')->getClientOriginalName();
        }
        try {
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->email;
            $new_user->password = bcrypt($request->password);
            $new_user->phone = $request->phone;
            $new_user->address = $request->address;
            $new_user->country_id = ($request->has('country_id')) ? $request->country_id : null;
            $new_user->avatar = ($request->hasFile('avatar')) ? $avatar : null;
            $new_user->level = 0;
            $new_user->save();
            if (!is_dir(public_path('/member/avatar/' . $new_user->id))) {
                mkdir(public_path('/member/avatar/' . $new_user->id));
            }
            if($request->hasFile('avatar'))
            {
                $request->file('avatar')->move(public_path('/member/avatar/'.$new_user->id), $avatar);
            }
            return redirect('/member/member_login')->with('success', __('Đăng ký thành công'));
        } catch (Exception $th) {
            return redirect()->back()->withErrors('Đăng ký thất bại');
        }
    }

    public function member_login_form()
    {
        return view('member/member/member_login');
    }

    public function member_login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];
        $remember = false;
        if($request->remember_me)
        {
            $remember = true;
        }
        if(Auth::attempt($login, $remember))
        {
            
            return redirect('/member/home');
        }
        else
        {
            return redirect()->back()->withErrors('Đăng nhập thất bại');
        }
    }

    public function member_logout()
    {
        Auth::logout();
        return redirect('/member/member_login');
    }
}
