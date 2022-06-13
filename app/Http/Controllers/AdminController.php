<?php

namespace App\Http\Controllers;

use App\Models\Authority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('thongke');
        } else {
            return view('admin_login');
        }
    }
    public function makeAcc(Request $request)
    {
        $data = $request->all();
        $login_id = $data['login_id'];
        $password = $data['password'];
        $login = Member::where('login_id', $login_id)->where('password', md5($password))->first();
        if ($login) {
            $login_count = $login->count();
            if ($login_count > 0) {
                // Session::put(['admin_name' => $login->admin_name]);
                Session::put(['id' => $login->id]);
                return Redirect::to('/statistical');
            }
        } else {
            Session::put('message', "Làm ơn nhập lại");
            return Redirect::to('/admin');
        }
    }
    public function resgiter()
    {
        $getAuthority = Authority::get();
        return view('admin_ress', compact('getAuthority'));
    }
    public function adminRegister(Request $request)
    {
        $data = array();
        $data['login_id'] = $request->login_id;
        $data['password'] = md5($request->password);
        $data['authority_id'] = $request->authority_id;
        $exitEmail = Member::where('login_id', $request->login_id)->first();
        // dd($exitEmail);
        if (!$exitEmail) {
            $id = Member::insertGetId($data);
            Session::put('id', $id);
            // Session::put('customer_name', $request->customer_name);
            // return Redirect::to('/checkout');
        } else {
            // return redirect()->back()->with('message', 'Tên email hoặc số điện thoại đã tồn tại');
            echo ('Erorr');
        }
    }
    public function statistical(){
        return view('admin.statistical.statistical');
    }
}
