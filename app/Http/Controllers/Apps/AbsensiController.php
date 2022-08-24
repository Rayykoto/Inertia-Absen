<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\MAbsen;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    use MAbsen;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = Absensi::where('user_id', auth()->user()->id)
        ->whereDate('created_at', Carbon::today())
        ->get();

        // dd($absen);

        if ($absen->count() == 0) {
            $data['waktu'] = 'masuk';
        }  elseif ($absen->count() == 1) {
            $data['waktu'] = 'pulang';
        } else {
            $data['waktu'] = 'dilarang';
        }

        // dd($data);
        
        return Inertia::render('Apps/Absensi/Index',[
            'dataabsen' => $data,
            'user'  => auth()->user()
        ]);
    }

    public function master()
    {
        // $absens = Absensi::when(request()->r, function($absens) {
        //     $absens = $absens->where('name', 'like', '%'. request()->r . '%');
        //     })->whereDate('created_at', Carbon::today())->with('user')->latest()->paginate(5);

        // dd($absens);

        return Inertia('Apps/Absensi/Master', 
        // [
        //     'absens' => $absens,
        // ]
    );
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date'  => 'required'
        ]);
        
        $data = Absensi::with('user')
            ->where('keterangan', '=', 'masuk')
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->get();


        // $total = Absensi::whereDate('created_at', '>=', $request->start_date)
        //     ->whereDate('created_at', '<=', $request->end_date);

        // dd($data);

            return Inertia('Apps/Absensi/Master', [
                'filters' => $data,
                // 'total' => $total
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
            'keterangan' => 'required',
            'lat'        => 'required',
            'long'       => 'required'
        ]);

        $lt = $request->lat;
        $lg = $request->long;
        $lt_kantor  =   "-6.1563239";
        $lg_kantor  =   "106.8990273";
        $jarak = $this->distance($lt, $lg, $lt_kantor, $lg_kantor, "K");

        Absensi::create([
            'user_id'       => auth()->user()->id,
            'lat'           => $lt,
            'long'          => $lg,
            'keterangan'    => $request->keterangan,
            'jarak'         => $jarak
        ]);

        return redirect()->route('apps.absensi.index');

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
