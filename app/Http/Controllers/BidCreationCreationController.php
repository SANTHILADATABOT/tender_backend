<?php

namespace App\Http\Controllers;

use App\Models\BidCreation_Creation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Token;
use App\Models\StateMaster;
use App\Models\CustomerCreationProfile;

class BidCreationCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
         //get the user id 
         $user = Token::where('tokenid', $request->tokenid)->first();   
         $userid = $user['userid'];

         if($userid){
            $bidCreation = new BidCreation_Creation;
            $bidCreation -> bidno = $request->bidcreationData['bidno'];
            $bidCreation -> customername = $request->bidcreationData['customername'];
            $bidCreation -> bidcall = $request->bidcreationData['bidcall'];
            $bidCreation -> tenderid = $request->bidcreationData['tenderid'];
            $bidCreation -> tenderinvtauth = $request->bidcreationData['tenderinvtauth'];
            $bidCreation -> tenderref = $request->bidcreationData['tenderref'];
            $bidCreation -> state = $request->bidcreationData['state']['value'];
            $bidCreation -> ulb = $request->bidcreationData['ulb']['value'];
            $bidCreation -> TenderDescription = $request->bidcreationData['TenderDescription'];
            $bidCreation -> NITdate = $request->bidcreationData['NITdate'];
            $bidCreation -> submissiondate = $request->bidcreationData['submissiondate'];
            $bidCreation -> quality = $request->bidcreationData['quality'];
            $bidCreation -> unit = $request->bidcreationData['unit'];
            $bidCreation -> tenderevalutionsysytem = $request->bidcreationData['tenderevalutionsysytem'];
            $bidCreation -> projectperioddate1 = $request->bidcreationData['projectperioddate1'];
            $bidCreation -> projectperioddate2 = $request->bidcreationData['projectperioddate2'];
            $bidCreation -> estprojectvalue = $request->bidcreationData['estprojectvalue'];
            $bidCreation -> tenderfeevalue = $request->bidcreationData['tenderfeevalue'];
            $bidCreation -> priceperunit = $request->bidcreationData['priceperunit'];
            $bidCreation -> emdmode = $request->bidcreationData['emdmode'];
            $bidCreation -> emdamt = $request->bidcreationData['emdamt'];
            $bidCreation -> dumpsiter = $request->bidcreationData['dumpsiter'];
            $bidCreation -> prebiddate = $request->bidcreationData['prebiddate'];
            $bidCreation -> EMD = $request->bidcreationData['EMD'];
            $bidCreation->location = $request->bidcreationData['location'];
            $bidCreation -> createdby_userid = $userid ;
            $bidCreation -> updatedby_userid = 0 ;
            $bidCreation -> save();
        }

        if ($bidCreation) {
            return response()->json([
                'status' => 200,
                'message' => 'Bid Has created Succssfully!',
                'id' => $bidCreation['id'],
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Unable to save!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BidCreation_Creation  $bidCreation_Creation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bidCreation_Creation = BidCreation_Creation::find($id);
        if ($bidCreation_Creation){

            $state = StateMaster::find($bidCreation_Creation['state']);
            $stateValue = ["value" => $state['id'], "label" =>  $state['state_name']];


            $ulb = CustomerCreationProfile::find($bidCreation_Creation['ulb']);
            $ulbValue = ["value" => $ulb['id'], "label" =>  $ulb['customer_name']];

            $bidCreation_Creation['state'] = $stateValue;
            $bidCreation_Creation['ulb'] = $ulbValue;

            return response()->json([
                'status' => 200,
                'bidcreationdata' => $bidCreation_Creation
            ]);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are Invalid'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidCreation_Creation  $bidCreation_Creation
     * @return \Illuminate\Http\Response
     */
    public function edit(BidCreation_Creation $bidCreation_Creation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidCreation_Creation  $bidCreation_Creation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $user = Token::where('tokenid', $request->tokenid)->first();
        $userid = $user['userid'];

        if($userid){
            $updatedata = $request->bidcreationData;
            $updatedata['updatedby_userid']= $userid;
            $updatedata['state']= $request->bidcreationData['state']['value'];
            $updatedata['ulb']= $request->bidcreationData['ulb']['value'];

            $bidcreationData = BidCreation_Creation::findOrFail($id)->update($updatedata);
        }

        if ($bidcreationData)
            return response()->json([
                'status' => 200,
                'message' => "Updated Successfully!"
            ]);
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Unable to save!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidCreation_Creation  $bidCreation_Creation
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidCreation_Creation $bidCreation_Creation)
    {
        //
    }
}
