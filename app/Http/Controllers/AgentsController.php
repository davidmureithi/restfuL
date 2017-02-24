<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

class AgentsController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
//            return AgentsController::orderBy('id', 'asc')->get();
            return view('agents');

        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request){
        $agent = new Agent;

        $agent->name = Input::get("name");

//        If(Request::hasFile('avatar')){
//
//            $avatar = Request::file('avatar');
//            //$avatar->move(public_path(). '/', $avatar->getClientOriginalName());
//
//            $filename = time() . '.' . $avatar->getClientOriginalExtension();
//            //Image::make($avatar)->resize(197, 137)->save( public_path('/uploads/avatars/' . $filename ) );
//
//            $agent->avatar = $filename;
//           // $agent->avatar_name = $avatar->getClientOriginalName();
//            $agent->avatar_size = $avatar->getClientSize();
//            $agent->avatar_type = $avatar->getClientMimeType();
//        }

        $agent->email = Input::get("email");
        $agent->phone = Input::get("mobile");
        $agent->category = Input::get("category");
        $agent->about = Input::get("about");
        $agent->location = Input::get("location");
        $agent->latitude = Input::get("lat");
        $agent->longitude = Input::get("lng");
        $agent->save();

        flash('Welcome Aboard!', 'success');
    }
}
