<?php

namespace App\Http\Controllers;

use App\Models\TenderCreation;
use App\Models\TenderTypeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenderCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tendercreation = TenderCreation::orderBy('created_at', 'desc')->get();
        //->paginate(4)->appends(['sort'=>'ulb_name']);

        if ($tendercreation)
            return response()->json([
                'status' => 200,
                'tendercreation' => $tendercreation
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
        $ulbRes1 = TenderCreation::where('tendertype', '=', $request->tendertype)->exists();
        if ($ulbRes1) {
            return response()->json([
                'status' => 400,
                'errors' => 'Tender Type Already Exists'
            ]);
        }

        $validator = Validator::make($request->all(), ['customername' => 'required', 'tendertype' => 'required',  'organization' => 'required']);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $tenderObj = TenderCreation::firstOrCreate($request->all());
        if ($tenderObj) {
            return response()->json([
                'status' => 200,
                'message' => 'State Has created Succssfully!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenderCreation  $tenderCreation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tender = TenderCreation::find($id);

        if ($tender)
            return response()->json([
                'status' => 200,
                'tender' => $tender
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
     * @param  \App\Models\TenderCreation  $tenderCreation
     * @return \Illuminate\Http\Response
     */
    public function edit(TenderCreation $tenderCreation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenderCreation  $tenderCreation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ulbRes12 = TenderCreation::where('tendercreation', '=', $request->tendercreation)
        ->where('id', '!=', $id)
        ->where('customer_id', '=', $request->customer_id)
        ->exists();
        if ($ulbRes12) {
            return response()->json([
                'status' => 400,
                'errors' => 'Tender Type Already Exists'
            ]);
        }

        $validator = Validator::make($request->all(),
        ['customername' => 'required|string',
        'customer_id' => 'required' ,
        'oraganization' => 'required',
        'nitdate' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }



        $tender = TenderCreation::findOrFail($id)->update($request->all());
        if ($tender)
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
     * @param  \App\Models\TenderCreation  $tenderCreation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $tender = TenderCreation::destroy($id);
            if($tender)
            {
                return response()->json([
                'status' => 200,
                'message' => "Deleted Successfully!",
            ]);}
            else
            {return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect!?',
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


    public function getTenderList($customerId){

        $tenders = TenderCreation::where("customerId",$customerId)->get();
        //dd($states);
        $tenderList = array();
        foreach($tenders as $tender){
            $tenderList[] = ["value" => $tender['id'], "label" =>  $tender['tendertype']] ;
        }
        return  response()->json([
            'tenderList' =>  $tenderList
        ]);
    }





    public function getTender($savedstate){

        $tender = TenderTypeMaster::where("tendertype", "!=", "")->first();

        $tenderid = $tender['id'];

        $tenders = TenderCreation::where("tenderid",$tenderid)
        ->where("tendertype", "!=", "")
        ->orWhere("id",$savedstate)
        ->orderBy('tendertype', 'ASC')
        ->get();
        //dd($states);
        $tenderList = array();
        foreach($tenders as $tender){
            $tenderList[] = ["value" => $tender['id'], "label" =>  $tender['tendertype']] ;
        }
        return  response()->json([
            'tenderList' =>  $tenderList
        ]);
    }

    public function getTenderListOptions( $customerId, $savedstate){
        // if($category === "state"){$cat = "State";}
        // if($category === "unionterritory"){$cat = "Union Territory";}

        DB::enableQueryLog();
        $tenders = TenderCreation::where("customerId",$customerId)
        // ->where("category",$cat)
        ->whereIn("customerId",function($query){
            $query->select('id')
            ->from('tender_type_masters')
            ->where("tendertype", "!=", "");
        })
        // ->where("state_status", "=", "Active")
        ->orWhere("id", function($query) use ($customerId, $savedstate){
            $query->select('id')
            ->from('tender_creations')
            ->where('id',$savedstate)
            ->where('customerId',$customerId);
        })
        ->get();
        //dd($states);

        $sqlquery = DB::getQueryLog();

        $query = str_replace(array('?'), array('\'%s\''),  $sqlquery[0]['query']);
        $query = vsprintf($query, $sqlquery[0]['bindings']);

        $tenderList = array();
        foreach($tenders as $tender){
            $tenderList[] = ["value" => $tender['id'], "label" =>  $tender['tendertype'], 'oragnization' => $oragnization['oragnization'] ] ;
        }

        return  response()->json([
            'tenderList' =>  $tenderList,
            'sqlquery' => $query,
        ]);
    }

    public function getList(){

        $tendertypes = TenderTypeMaster::where("tendertype", "!=", "")->get();

        $tendertypeList= [];
        foreach($tendertypes as $tendertype){
            $tendertypeList[] = ["value" => $tendertype['id'], "label" =>  $tendertype['tendertype']] ;
        }
        return  response()->json([
            'tendertypeList' =>  $tendertypeList,

        ]);
    }

}
