<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.admin',[
            'admins' => User::where('role_id', '!=', 3)->where('id', '!=', Auth::user()->id)->get()
        ]);
    }

    public function create(){
        return view('admin.signup');
    }

    public function store(SignRequest $request){
       if(User::create($request->validated())){
        return back();
       };
       return back();
    }

    public function updateAdmin(Request $request){
        $affected = DB::table('users')
              ->where('id', $request->id)
              ->update(['role_id'=> 2]);
        if ($affected) {
            return back();
        }
        return back();
    }

    public function updateSadmin(Request $request){
        $affected = DB::table('users')
              ->where('id', $request->id)
              ->update(['role_id'=> 1]);
        if ($affected) {
            return back();
        }
        return back();
    }

    public function retirer(Request $request){
        $affected = DB::table('users')
              ->where('id', $request->id)
              ->update(['role_id'=> 3]);
        if ($affected) {
            return back();
        }
        return back();
    }
}
