<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Input;
use Validator;
use Redirect;
use Session;

class AgentsController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            return view('agents');
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request){
        $agent = new Agent;

        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        $avatar =Input::file('image');  // getting image and assigning to avatar var
        $extension = $avatar->getClientOriginalExtension(); // getting image extension
        $fileName = 'spotpata_' . time() . '_' . rand(11111, 99999) . '.' . $extension; // renaming image

        $agent->avatar= $request['image'];
        $agent->name = Input::get("name");
        $agent->email = Input::get("email");
        $agent->phone = Input::get("mobile");
        $agent->category = Input::get("category");
        $agent->heard_of_us = Input::get("heard_of_us");
        $agent->about = Input::get("about");
        $agent->location = Input::get("location");
        $agent->latitude = Input::get("lat");
        $agent->longitude = Input::get("lng");

        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('agents')->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if ($avatar->isValid()) {
                $destinationPath = 'uploads/avatars'; // upload path

                $agent->avatar = $avatar->getClientOriginalName(); // to get the real name of uploaded file
                $url = public_path().'/avatars/'. $fileName;

                $agent->avatar_url = $url;

                $agent->avatar_size = $avatar->getClientSize();
                $agent->avatar_type = $extension;

                $avatar->move($destinationPath, $fileName); // uploading file to given path
                //$avatar->move($destinationPath, $avatar->getClientOriginalName());  // save with original name
                $agent->save();

                // sending back with message
                Session::flash('success', 'You have successfully registered');
                return Redirect::to('agents');
            } else {
                // sending back with error message.
                Session::flash('error', 'There was an error! The uploaded file is not valid');
                return Redirect::to('agents');
            }
        }
    }
}
