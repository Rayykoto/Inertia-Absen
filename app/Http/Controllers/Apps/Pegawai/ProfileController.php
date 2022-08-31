<?php

namespace App\Http\Controllers\Apps\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{

    public function updatepassword(Request $request)
    {

        $this->validate($request,[
            'old_password'  => 'required',
            'password'      => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth()->guard()->user()->password)) {
            return response()->json(['old_password' => ['password not matched']], 400);
        }

        $profile = User::whereId(auth()->user()->id)->first();
        $profile->update([
            'password'  => Hash::make($request->password)
        ]);

        return redirect()->route('apps/pegawai.profiles.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        // dd($pegawai);

        return Inertia::render('Apps/Pegawai/Profile/Index', [
            'profile' => $pegawai
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname'  => 'required',
            'nik'       => 'required',
            'gender'    => 'required'
        ]);

        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        // dd($pegawai);

        $pegawai->update([
            'fullname'  => $request->fullname,
            'nik'       => $request->nik,
            'gender'    => $request->gender
        ]);

        // $pegawai->syncRoles($request->roles);

        return redirect()->route('apps/pegawai.profiles.index');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pegawai, $id)
    {
        
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
