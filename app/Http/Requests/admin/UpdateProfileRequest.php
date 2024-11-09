<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id_user = Auth::id();
        return [
            'name' => 'required|max:200',
            'email' => [
                'required',
                'email',
                'max:200',
                Rule::unique('users')->where(function ($query) use ($id_user) {
                    return $query->where('id', '<>', $id_user);
                }),
            ],
            'password' => 'nullable|min:8|max:200',
            'password_confirm' => 'nullable|same:password',
            'phone' => [
                'required',
                Rule::unique('users')->where(function ($query) use ($id_user) {
                    return $query->where('id', '<>', $id_user);
                }),
            ],
            'address' => 'required|max:200',
            'country_id' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được nhập quá :max ký tự',
            'email' => ':attribute sai định dạng',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải nhập tối thiểu :min ký tự',
            'same' => ':attribute không khớp',
            'image' => ':attribute sai định dạng',
            'mimes' => ':attribute chỉ cho phép có dạng jpg, jpeg, png hoặc gif',
            'image.max' => ':attribute chỉ cho phép dung lượng dưới 1MB',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirm' => 'Mật khẩu nhập lại',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'avatar' => 'Ảnh đại diện'
        ];
    }
}
