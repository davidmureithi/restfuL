<?php

namespace App\Api\V1\Controllers;

use App\Agent;
use App\Http\Controllers\Controller;

class AgentsController extends Controller
{
    public function index(){
        return Agent::all();
    }

    public function show($id){
        return Agent::where('id', $id)->take(1)->get();
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store()
    {
        $input = \Input::json();
        $agent = new Agent();
        $agent->name = $input->get('name');
        $agent->category = $input->get('category');
        $agent->specialty = $input->get('specialty');
        $agent->about = $input->get('about');
        $agent->email = $input->get('email');
        $agent->phone = $input->get('phone');
        $agent->mobile = $input->get('mobile');
        $agent->location = $input->get('location');
        $agent->save();
        return response($agent, 201);
    }

    public function destroy($id){

    }
}