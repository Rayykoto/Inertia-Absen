<?php

namespace App\Http\Controllers\Apps\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $cutis = Cuti::with('user')->when(request()->q, function($cutis) {
            $cutis = $cutis->where('created_at', 'like', '%'. request()->q . '%')
            ->orWhere('alasan', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        // dd($cutis);

        return Inertia::render('Apps/Admin/Cuti/Index',[
        'cutis' => $cutis
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
    public function update(Request $request, $id)
    {
        $cuti = Cuti::where('id', $id)->first();
        
        $cuti->update([
            'status' => 'diterima'
        ]);

        // dd($cuti);

        return redirect()->route('apps/admin.cutis.index');

    }

    public function __invoke($id)
    {
        $cuti = Cuti::where('id', $id)->first();
        
        $cuti->update([
            'status' => 'ditolak'
        ]);

        return redirect()->route('apps/admin.cutis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
