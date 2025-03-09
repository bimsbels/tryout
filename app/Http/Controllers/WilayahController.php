<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wilayah;

class WilayahController extends Controller
{
    public function getProvince($id)
    {
        $province = Wilayah::where('kode', $id)->first();
        return response()->json($province);
    }

    public function getRegency($id)
    {
        $regency = Wilayah::where('kode', $id)->first();
        return response()->json($regency);
    }

    public function getDistrict($id)
    {
        $district = Wilayah::where('kode', $id)->first();
        return response()->json($district);
    }

    public function search(Request $request)
    {
        $term = $request->input('term');
        $provinsi = $request->input('provinsi');
        $kabupaten = $request->input('kabupaten');

        $query = Wilayah::where('nama', 'like', '%' . $term . '%');

        if (!$provinsi && !$kabupaten) {
            // Provinsi - tidak memiliki titik dalam kode
            $query->whereRaw("kode NOT LIKE '%.%'");
        }

        if ($provinsi) {
            // Kabupaten - kode diawali dengan kode provinsi diikuti titik
            $query->where('kode', 'like', $provinsi . '.%')
                  ->whereRaw("kode NOT LIKE '%.%.%'"); // Memastikan hanya memiliki satu titik
        }

        if ($kabupaten) {
            // Kecamatan - kode diawali dengan kode kabupaten diikuti titik
            $query->where('kode', 'like', $kabupaten . '.%')
                  ->whereRaw("kode LIKE '%.%.%'"); // Memastikan memiliki dua titik
        }

        $results = $query->get();
        
        return response()->json($results);
    }

    public function getProvinces()
    {
        // Provinsi - tidak memiliki titik dalam kode
        $provinces = Wilayah::whereRaw("kode NOT LIKE '%.%'")->get();
        return response()->json($provinces);
    }
}