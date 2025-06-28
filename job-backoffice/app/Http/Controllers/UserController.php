<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query=User::latest();
        
        if($request->has("archived")){
            $query->onlyTrashed();
        }
        $users=$query->paginate(10)->onEachSide(1);
        return view('users.index',compact('users'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user=User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        //
        $user=User::findOrFail($id);
        $user->update([
            'password'=>Hash::make($request->input('password')) ,
        ]);

        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','User Archived Successfully');
    }

    public function restore(string $id) 
    {
        //
        $user=User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index',['archived'=>true])->with('success','User Restored Successfully');
    }
}
