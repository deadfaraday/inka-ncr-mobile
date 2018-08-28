<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //dd($user->photo);
        // {!! Html::image(Storage::url(Auth::user()->photo), null, ['class'=>'img-circle', 
        //     'alt'=>'User Image']) !!}
      
        return view('profile.index')->with(compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = Auth::user();
        if($request->new_password)
        {
            $this->validate($request,[
                'new_password' => 'required|confirmed|min:6'
            ]);
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
        }

        if($request->hasFile('profpict'))
        {
            $this->validate($request, [
                'profpict'=> 'image|mimes:jpeg,bmp,png|max:2000'
            ]);

            // $profpict_file = $request->profpict;
            
            //ambil extension
            /*
                $extension = $profpict_file->getClientOriginalExtension();
                $filename = 'PP-'. $user->id. '-'. md5($user->nip)  . '.' . $extension;
            */
            // $filename = $request->profpict->store('profpict');
            
            /*
                $destPath = public_path() . DIRECTORY_SEPARATOR . 'img/pp';
                $profpict_file->move($destPath, $filename);
            */
            $user->update([
                'photo' => $request->profpict->store('profpict')
            ]);
        }
            return response()->json([
                'message' => 'update profile succeed',
            ], 201);
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
    }
}
