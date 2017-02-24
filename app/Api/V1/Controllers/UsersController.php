<?php

namespace App\Api\V1\Controllers;

use App\User;
use Dingo\Api\Contract\Http\Request;

class UsersController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return User::all();
    }

    public function userFindByCategory(Request $request, Request $request2){
        $query = User::query();

        //...api/auth/users/?category=cleaners&gender=female

        if($request) {
            $query->where('category', $request);
        }

        if($request2) {
            $query->where('gender', $request2);
        }

        $users = $query->get();
        return $users;
    }


    //@Path("/todo/{varX}/{varY}")
    //@Produces({"application/xml", "application/json"})
//    public function todoWhatYouLike(@PathParam("varX") String varX, @PathParam("varY") String varY) {
//            User todo = new User();
//            todo.setSummary(varX);
//            todo.setDescription(varY);
//            return todo;
//    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \App\User::where('id',$id)->take(1)->get();
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }
        else{
            return response()->json([
                'status' => 'ok',
                $user
            ], 201);
        }

//        $input = \Input::json();
//        $users = new User($request->all());
//        $users->name = $input->get('name');
//        $users->email = $input->get('email');
//        $users->password = $input->get('password');
//        $users->save();
//
//        return response($users)->json([
//            'status' => 'ok',
//        ], 201);
        //return response($users, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = \Input::json();
        $users = \App\Users::findOrFail($id);
        $users->name = $input->get('name');
        $users->description = $input->get('description');
        $users->location_id = $input->get('location_id');
        $users->save();
        return response($users, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return response('Deleted.', 200);
    }
}