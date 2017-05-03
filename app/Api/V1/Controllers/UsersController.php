<?php

namespace App\Api\V1\Controllers;

use App\User;
use Dingo\Api\Contract\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function userFindByCategory($request, $request2){
        $query = User::query();

        //...api/auth/users/?category=cleaners&gender=female

        if($request) {
            $query->where('category', $request);
        }

        if($request2) {
            $query->where('gender', $request2);
        }

        $users = $query->get();
        return response()->json([
            "Users" => $users
        ]);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $query = User::query();

        if($id) {
            $query->where('id', $id);
        }

        $user = $query->get();

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $query = User::query();

        if($id) {
            $query->where('id', $id);
        }

        if(!$query->update($request->all())) {
            throw new HttpException(500);
        }

        return response()->json([
            'user' => User::where('id', $id)->get()
        ], 200);
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
                $user
            ], 201);
        }
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
     * Change user password with give id
     * @param  int  $id
     * @return Response
     */
    public function changePassword(Request $request, $id)
    {
        if($id) {
            $user = User::query()->where('id', $id);
        }

        $oldPassword = $request['old_password'];
        $newPassword = $request['new_password'];

        $checkOldPassword = User::query()->where('id', $id)->value('password');

        if($oldPassword && $checkOldPassword){
            if (!Hash::check($oldPassword, $checkOldPassword)){
                return response()->json([
                    "status" => "error",
                ], 404);
            }
            $newHashPassword = Hash::make($newPassword);
            $user->update(['password' => $newHashPassword]);
        }
        return response()->json([
            'status' => 'success'
        ], 200);
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