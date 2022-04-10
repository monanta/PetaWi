<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Kegiatanisibs;
use App\Models\Matrik;
use DataTables;

class kegiatanController extends Controller
{
    public function index()
    {
        return view('kegiatan');
        $data = Kegiatan::all();
        return $data->toArray();
    }
    public function tabel()
    {
        $data = Kegiatanisibs::all();
        return Datatables::of($data)->make(true);

    }

    public function create(Request $request)
    {
        try {
            Kegiatan::create($request->all());
            $idkeg = Kegiatan::select('idkeg')
                           ->where('nmkeg', '=', $request->get('nmkeg'))
                           ->value('idkeg');
        } catch (\Throwable $th) {
            $idkeg = Kegiatan::select('idkeg')
                           ->where('nmkeg', '=', $request->get('nmkeg'))
                           ->value('idkeg');
            Matrik::where('idkeg', '=', $idkeg)->delete();
        }

        $listbs = preg_split('/\r\n|\r|\n/', $request->get('listbs'));
        foreach ($listbs as $bs) {
            Matrik::insert([
                'idkeg' => $idkeg,
                'idbs' => $bs
            ]);
        }
        return redirect('/kegiatan') -> with('sukses', 'Data berhasil diinput');

    }

    public function delete($idkeg)
    {
        Kegiatan::where('idkeg', '=', $idkeg)->delete();
        Matrik::where('idkeg', '=', $idkeg)->delete();
        return redirect('/kegiatan') -> with('sukses', 'Data berhasil diinput');
    }

    public function getkegiatanbyid($idkeg)
    {
        return Kegiatan::where('idkeg', '=', $idkeg)->get();
    }



}
