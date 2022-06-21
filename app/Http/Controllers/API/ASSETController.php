<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ASSET;
use Illuminate\Http\Request;
use App\Http\Resources\ASSETResource;
use Illuminate\Support\Facades\Validator;

class ASSETController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = \Request::query();
        
        $assets = ASSET::all();
        return response([ 'assets' => ASSETResource::collection($assets), 'message' => 'Assets retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'department' => 'required|max:255',
            'registration_date' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $aSSET = ASSET::create($data);

        return response([ 'asset' => new ASSETResource($aSSET), 'message' => 'Asset created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ASSET  $aSSET
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_int($id) === true){
            $aSSET = ASSET::where('id',$id)->get();
            return response([ "asset" => ($aSSET), 'message' => 'Asset retrieved successfully'], 200);
        }
        else 
            return response([ "error" => 'Invalid id'], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ASSET  $aSSET
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ASSET $aSSET)
    {
        $aSSET->update($request->all());

        return response([ 'asset' => new ASSETResource($aSSET), 'message' => 'Asset updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ASSET  $aSSET
     * @return \Illuminate\Http\Response
     */
    public function destroy(ASSET $aSSET)
    {
        $aSSET->delete();

        return response(['message' => 'Asset deleted']);
    }
}
