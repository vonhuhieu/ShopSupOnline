<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Country;
use App\Http\Requests\admin\AddCountryRequest;
class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function country_list()
    {
        $countries = Country::all();
        return view('admin/country/country_list', compact('countries'));
    }

    public function country_add_form()
    {
        return view('admin/country/country_add');
    }

    public function country_add(AddCountryRequest $request)
    {
        $data = $request->all();
        if(Country::create($data))
        {
            return redirect('/admin/country_list')->with('success', __('Thêm thành công'));
        }
        else
        {
            return redirect('/admin/country_list')->withErrors('Thêm thất bại');
        }
    }

    public function country_delete($country_id)
    {
        if(Country::where('id',$country_id)->delete())
        {
            return redirect('/admin/country_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/country_list')->withErrors('Xóa thất bại');
        }
    }
}
