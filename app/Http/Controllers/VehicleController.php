<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

use GuzzleHttp\Client;

class VehicleController extends Controller
{
    //
    public function index(){
        //$vehicles = Vehicle::all();
        
        $url = "http://127.0.0.1:8081/api/vehicles";
        $method = "GET";
        
        $client = new Client();
        //アクセス
        $response = $client->request($method,$url);
        //bodyを取得
        $posts = $response->getBody();
        //jsonをデコード
        $vehicles = json_decode($posts);

        return view('vehicles.index', compact('vehicles'));
    }

    public function create(){
        return view('vehicles.create');
    }

    public function store(Request $request){
       
        $url = "http://127.0.0.1:8081/api/vehicles";
        $method = "post";
        $data = array(
            "vehicle_name"=>$request->vehicle_name,
            "capacities" => json_encode(['people' =>intval($request->capacities)]),
        );
       
        $client = new Client();
        $options = [
            'json'=>$data,
        ];

        $response = $client -> request($method,$url,$options);

        //$vehicle = New Vehicle;
        //$vehicle->vehicle_name=$request->vehicle_name;
        //$vehicle->capacities = json_encode(['people' => intval($request->capacities)]);
        //$vehicle->save();
        return redirect('/vehicles');
        
    }


    public function edit($id){
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit',compact('vehicle'));
    }

    public function update($id,Request $request){
        $vehicle = Vehicle::find($id);
        $vehicle->vehicle_name = $request->vehicle_name;
        $vehicle->capacities = json_encode(['people' => intval($request->capacities)]);
        $vehicle->save();
        return redirect('/vehicles');
    }

}
