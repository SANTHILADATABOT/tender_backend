<?php

namespace App\Http\Controllers;

use App\Models\TenderTypeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenderTypeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tenderType = TenderTypeMaster::orderBy('created_at', 'desc')->get();
        //->paginate(4)->appends(['sort'=>'ulb_name']);

        if ($tenderType)
            return response()->json([
                'status' => 200,
                'tenderType' => $tenderType
            ]);
        else {
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
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
        $tendertype = TenderTypeMaster::where('tendertype', '=', $request->tendertype)->exists();
        if ($tendertype) {
            return response()->json([
                'status' => 400,
                'errors' => 'tendertype Name Already Exists'
            ]);
        }

        $validator = Validator::make($request->all(), ['tendertype' => 'required|string', 'tendertypeStatus' => 'required']);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $tendertype = TenderTypeMaster::firstOrCreate($request->all());
        if ($tendertype) {
            return response()->json([
                'status' => 200,
                'message' => 'tendertype Has created Succssfully!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenderTypeMaster  $tenderTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function show(TenderTypeMaster $tenderTypeMaster)
    {
        $tendertype = TenderTypeMaster::find($id);
        if ($tendertype)
            return response()->json([
                'status' => 200,
                'tendertype' => $tendertype
            ]);
        else {
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenderTypeMaster  $tenderTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(TenderTypeMaster $tenderTypeMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenderTypeMaster  $tenderTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TenderTypeMaster $tenderTypeMaster)
    {
        $tendertype = TenderTypeMaster::where('tendertype', '=', $request->tendertype)
        ->where('id', '!=', $id)->exists();
        if ($tendertype) {
            return response()->json([
                'status' => 400,
                'errors' => 'TenderType Name Already Exists'
            ]);
        }

        $validator = Validator::make($request->all(), ['tendertype' => 'required|string', 'tendertypeStatus' => 'required']);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $tendertype = TenderTypeMaster::findOrFail($id)->update($request->all());
        if ($tendertype)
            return response()->json([
                'status' => 200,
                'message' => "Updated Successfully!"
            ]);
        else {
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenderTypeMaster  $tenderTypeMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenderTypeMaster $tenderTypeMaster)
    {
        try{
            $tendertype = TenderTypeMaster::destroy($id);
            if($tendertype)
            {return response()->json([
                'status' => 200,
                'message' => "Deleted Successfully!"
            ]);}
            else
            {return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.',
                "errormessage" => "",
            ]);}
        }catch(\Illuminate\Database\QueryException $ex){
            $error = $ex->getMessage();

            return response()->json([
                'status' => 404,
                'message' => 'Unable to delete! This data is used in another file/form/table.',
                "errormessage" => $error,
            ]);
        }
    }


    public function getList(){

        $tendertypes = TenderTypeMaster::where("tendertypeStatus", "=", "Active")->get();

        $tendertypeList= [];
        foreach($tendertypes as $tendertype){
            $tendertypeList[] = ["value" => $tendertype['id'], "label" =>  $tendertype['tendertype']] ;
        }
        return  response()->json([
            'tendertypeList' =>  $tendertypeList,

        ]);
    }


    public function getListofcountry($savedcountry){
        $tendertypes = TenderTypeMaster::where("tendertypeStatus", "=", "Active")
        ->orWhere("id",$savedcountry)->get();

        $tendertypeList= [];
        foreach($tendertypes as $tendertype){
            $tendertypeList[] = ["value" => $tendertype['id'], "label" =>  $tendertype['tendertype']] ;
        }
        return  response()->json([
            'tendertypeList' =>  $tendertypeList,

        ]);
    }






}
