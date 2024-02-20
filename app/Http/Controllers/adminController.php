<?php

namespace App\Http\Controllers;
use App\Models\quardinates;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function dashboard(){
        $data = quardinates::orderBy('id', 'desc')->get();
        return view('admin.dashboard', ['maps' => $data]);
    }    
    public function map($id){
        $data['map'] =quardinates::find($id);
        return view('admin.map',$data);
    }

}
