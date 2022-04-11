<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Matrik;
use App\Models\Kegiatan;


class cetakController extends Controller
{
    public function index($idbs)
    {
        $data = ['idbs' => $idbs];

        $pdf = PDF::loadView('cetak', $data)
                    ->setPaper('A3', 'landscape')
                    ->stream("dompdf_out.pdf", array("Attachment" => false));

        return $pdf;

        exit(0);
    }

    public function cetakkegiatan($idkeg)
    {

        $listbs = Matrik::where('idkeg', '=', $idkeg)->get()->pluck('idbs')->toArray();

        $nmkeg = Kegiatan::select('nmkeg')
                           ->where('idkeg', '=', $idkeg)
                           ->value('nmkeg');

        $data =  ['listbs' => $listbs, 'nmkeg' => $nmkeg];


        $pdf = PDF::loadView('cetakkegiatan', $data)
                    ->setPaper('A3', 'landscape')
                    ->stream($nmkeg .".pdf", array("Attachment" => false));

        return $pdf;


        exit(0);
    }
}
