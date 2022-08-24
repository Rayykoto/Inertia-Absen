<?php

namespace App\Http\Controllers\Apps\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Cutidetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $cutis = Cuti::where('user_id', auth()->user()->id)
        ->when(request()->q, function($cutis) {
        $cutis = $cutis->where('created_at', 'like', '%'. request()->q . '%')
        ->orWhere('alasan', 'like', '%' . request()->q . '%');
        })->with('user')->latest()->paginate(5);

    //    $ceks = DB::table('cutidetails')
    //         ->selectRaw('min(tanggal) as mulai, max(tanggal) as akhir')
    //         ->groupBy('cuti_id')
    //         ->get();

        //  dd($ceks);

        return Inertia::render('Apps/Pegawai/Cuti/Index',[
            'cutispegawai' => $cutis,
            // 'ceks'   => $ceks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Apps/Pegawai/Cuti/Create');
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
            'jenis_cuti'    => 'required',
            'alasan'        => 'required'
        ]);

        $cuti = Cuti::create([
            'user_id'       => auth()->user()->id,
            'jenis_cuti'    => $request->jenis_cuti,
            'alasan'        => $request->alasan,
            'status'        => 'diajukan'
        ]);

        $dt1 = new DateTime($request->mulai);
        $dt2 = new DateTime($request->akhir);
        $jml = $dt2->diff($dt1)->days + 1;
        $tgl1 = $request->mulai;
        $i = 1;
        for ($i = 0; $i < $jml; $i++) { 
            Cutidetail::create([
                'cuti_id' => $cuti->id,
                'tanggal' => date('Y-m-d', strtotime('+' . $i . 'days', strtotime($tgl1))),
            ]);
        }

        //$cek = $this->db->query("select * from cuti order by id_cuti desc limit 1 ")->row();
        


        return redirect()->route('apps/pegawai.cutis.index');


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
        //
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
