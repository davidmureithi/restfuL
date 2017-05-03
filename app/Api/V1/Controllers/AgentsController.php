<?php

namespace App\Api\V1\Controllers;

use App\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Validator;
use Redirect;
use Session;

class AgentsController extends Controller
{
    public function index(){
        return Agent::all();
    }

    public function show($id){
        $query = Agent::query();

        if($id){
            $query->where('id', $id);
        }

        $agent = $query->get();

        return response()->json([
            "The Agent" => $agent
        ], 200);

    }

    public function getCategory($cat)
    {
        $query = Agent::query();

        if($cat){
            $query->where('category', $cat);
        }
//        if($id){
//            $query->where('id', $id);
//        }

        $agents = $query->get()->all();

        return response()->json([
            "The Categories" => $agents
        ], 200);

        //return Agent::where('category', $cat)->take(5)->get();
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */

    public function store(Request $request){
        $agent = new Agent;

        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        $avatar =Input::file('image');  // getting image and assigning to avatar var
        if($avatar){
            $extension = $avatar->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '_' . rand(11111, 99999) . '.' . $extension; // renaming image
        }

        $agent->avatar_blob = $request['image'];

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

                $agent->avatar = $avatar->getRealPath(); // to get the real path of uploaded file
                //$agent->avatar_name = $fileName;
                //$agent->avatar_name = $avatar->getClientOriginalName();
                $agent->avatar_url = $avatar->getClientOriginalName();

                $agent->avatar_size = $avatar->getClientSize();
                $agent->avatar_type = $avatar->getClientMimeType();

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

    public function destroy($id){

    }
}