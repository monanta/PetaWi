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
    }
    public function tabel()
    {
        $data = Kegiatanisibs::all();
        return Datatables::of($data)->make(true);

    }

    public function create(Request $request)
    {
        $idkeg = $request->get('idkeg');
        // return $idkeg;
        if ($idkeg == 0) {
            Kegiatan::create($request->all());
            $idkeg = Kegiatan::select('idkeg')
                           ->where('nmkeg', '=', $request->get('nmkeg'))
                           ->value('idkeg');
        }else {
            Matrik::where('idkeg', '=', $idkeg)->delete();
            Kegiatan::where('idkeg', $idkeg)
            ->update(['nmkeg' => $request->get('nmkeg')]);
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
        return Kegiatanisibs::where('idkeg', '=', $idkeg)->get();
    }



}
