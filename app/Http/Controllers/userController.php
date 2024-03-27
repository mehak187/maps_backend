<?php

namespace App\Http\Controllers;
use App\Models\quardinates;
use Illuminate\Http\Request;
use App\Mail\PublishSite;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    //
    public function map(){
        return view('user.map');
    }
    public function publishsite(request $request){
        $request->validate([
        '*'=>'required',
        ]);
        $data =$request->all();
        quardinates::create($data);
        $requestMail = $request->all();
        $to_email = "Wearemillenland@gmail.com";
        Mail::to($to_email)->send(new PublishSite($requestMail));
        return redirect()->route('map')->with('success', 'Site Published successfully');
    }
}