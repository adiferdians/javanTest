<?php

namespace App\Http\Controllers;

use App\Models\Silsilah;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function getData(){
        $data = Silsilah::all();

            if($data){
                $silsilahData = [
                    'OUT_STAT' => 'T',
                    'OUT_MESS' => 'Success',
                    'OUT_DATA' => $data
                ];
                return $silsilahData;
            } else {
                return response()->json(array(
                    'OUT_STAT' => 'F',
                    'OUT_MESS' => 'Failed',
                    'OUT_DATA' => $data
                ), 300);
            }
    }

    public function index(Request $request){
        $silsilahData = $this->getData($request);
        $data = $silsilahData['OUT_DATA']->toArray();
        return view('crud', ['data'=> $data ]);
    }

    public function send(Request $request){
        $id = $request->id;
        if($id){
            $data = Silsilah::find($id);
            $data->nama = $request->nama;
            $data->jk = $request->jk;
            $data->parrentId = $request->parrentId;
            $data->save();
         } else {
            $data = new Silsilah();
            $data->nama = $request->nama;
            $data->jk = $request->jk;
            $data->parrentId = $request->parrentId;
            $data->save();
        }



        return back();
    }

    public function del(Request $request){
        $id = $request->id;

        $data =Silsilah::find($id);
        $data->delete();

        return back();
    }
}
