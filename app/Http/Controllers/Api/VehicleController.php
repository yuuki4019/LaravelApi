<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    //一覧表示
    public function index()
    {

        $vehicles = Vehicle::all();

        //foreach($vehicles as $vehicle){
        //    $vehicle->capacities =  json_decode($vehicle->capacities);
        //}

        return $vehicles;
    }

    //指定した車両を取得
    public function show($id){

        $vehicle = Vehicle::find($id);

        //$vehicle->capacities =  json_decode($vehicle->capacities);

        return $vehicle;

    }

    //新規登録
    public function store(Request $request){
        $vehicle = New Vehicle;
        $vehicle->vehicle_name=$request->vehicle_name;
        $vehicle->capacities = json_encode(['people' =>json_decode($request->capacities)->people]);
        $vehicle->save();
        return 200;
    }

    //更新
    public function update($id,Request $request){
        $vehicle = Vehicle::find($id);
        $vehicle->vehicle_name=$request->vehicle_name;
        $vehicle->capacities = json_encode(['people' =>json_decode($request->capacities)->people]);
        $vehicle->save();
        return 200;
    }
}
