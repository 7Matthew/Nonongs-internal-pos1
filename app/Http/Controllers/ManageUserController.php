<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/manage_users', [
            'user'=> Users::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user-folder/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required','int']
        ]);
        $new_user = new Users();
        $new_user->name = strip_tags($request->input('name'));
        $new_user->username = strip_tags($request->input('username'));
        $new_user->email = strip_tags($request->input('email'));
        $new_user->role = $request->input('role');
        $new_user->password = Hash::make(strip_tags($request->input('password')));
        $new_user->save();

        return redirect()->route('manage-users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('user-folder/edit',[
            'user' => Users::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required','int'],
        ]);
        
        $new_user = Users::findOrFail($id);
        $new_user->name = strip_tags($request->input('name'));
        $new_user->username = strip_tags($request->input('username'));
        $new_user->email = strip_tags($request->input('email'));
        $new_user->role = $request->input('role');
        $new_user->update();

        return redirect()->route('manage-users.index', $id)->with('success','Edited Successfully');
    }

    public function change_password()
    {
        return view('auth/change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => ['string','required', 'min:8'],
            'password' => ['min:8', 'string','required','Confirmed']
        ]);

        $oldPasswordStatus = Hash::check($request->old_password, auth()->user()->password);
        if($oldPasswordStatus)
        {
            $user = Users::findOrFail(Auth::user()->id);
            $user->password = Hash::make(strip_tags($request->password));
            $user->update();
            return redirect()->back()->with('success', 'Password Changed successfully');
        }
        else
        {
            return redirect()->back()->with('failed', 'Error: Old password don\'t  match');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Users::destroy($id);
        return redirect()->route('manage-users.index')->with('Success','Deleted Successfully');
    }
}
