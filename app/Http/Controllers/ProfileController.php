<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $topics = $user->topics()->orderBy('created_at', 'DESC')->paginate(10);
        return view('profile.show', compact('user', 'topics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $this->validate($request, [
          'name' => 'required',
          'photo' => 'mimes:jpg,png,jpeg|max:10240'
        ]);

        $data = $request->only('name');

        if ($request->hasFile('photo')) {
          $photo = $request->file('photo');
          $fileName = str_random(30).'.'.$photo->guessClientExtension();
          $photo->move('upload/', $fileName);

          $data['photo'] = $fileName;
        }

        $user->update($data);
        flash("Update profile success");
        return redirect()->route('profile.show', $user->id);

    }

    public function editPassword()
    {

        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|confirmed|min:6'
        ]);

        $guard = Auth::guard();

        if (!$guard->validate($request->only('password'))) {
            flash('Your credentials not correct', 'danger');
            return back();
        }

        $user = $guard->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        flash('Password has been updated');
        return redirect()->route('profile.show', $user->id);
    }
}
