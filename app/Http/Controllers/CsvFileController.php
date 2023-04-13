<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\ProcessCSVData;
use Illuminate\Support\Facades\Bus;

class CsvFileController extends Controller
{
    public function index()
    {
        return view('csv.index');
    }

    public function upload_csv_records(Request $request)
    {
        if( $request->has('csv') ) {
            $csv    = file($request->csv);
            $chunks = array_chunk($csv,1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new ProcessCSVData($data, $header));
            }
            return $batch;
        }
        return "please upload csv file";
    }
}