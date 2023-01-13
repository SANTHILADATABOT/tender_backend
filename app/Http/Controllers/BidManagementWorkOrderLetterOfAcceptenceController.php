<?php

namespace App\Http\Controllers;

use App\Models\BidManagementWorkOrderLetterOfAcceptence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;

class BidManagementWorkOrderLetterOfAcceptenceController extends Controller
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
        $data= $request->leterAcceptance;   
        $validator = Validator::make($data, [
            'Date' => 'required|date',
            'refrenceNo' => 'required|string',
            'from' => 'required|string',
            'medium' => 'required|string',
            'medRefrenceNo' => 'required|string',
            'mediumSelect' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' =>"Not able to Add Strength/Weakness details now..!",
                'error' => $validator->messages(),
            ]);
        }
        $user = Token::where('tokenid', $request->tokenid)->first();   
        $userid = $user['userid'];
        $request->request->remove('tokenid');
    if($userid)
    {
        $MobilizationAdvance = new MobilizationAdvance;
        $MobilizationAdvance -> bidid = $request->bidid;
        $MobilizationAdvance -> mobAdvance = $request->leterAcceptance['mobAdvance'];
        $MobilizationAdvance -> bankName = $request->leterAcceptance['bankName'];
        $MobilizationAdvance -> bankBranch = $request->leterAcceptance['bankBranch'];
        $MobilizationAdvance -> mobAdvMode = $request->leterAcceptance['mobAdvMode'];
        $MobilizationAdvance -> dateMobAdv = $request->leterAcceptance['dateMobAdv'];
        $MobilizationAdvance -> validUpto = $request->leterAcceptance['validUpto'];
        $MobilizationAdvance -> createdby_userid = $userid ;
        $MobilizationAdvance -> updatedby_userid = 0 ;
        $MobilizationAdvance -> save();
    }
        if ($MobilizationAdvance) {
            return response()->json([
                'status' => 200,
                'message' => 'Mobilzation Advance Has created Succssfully!',
                'Mobilization' => $MobilizationAdvance,
                'bidid' => $MobilizationAdvance['bidid'],
                'id' => $MobilizationAdvance['id'],
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
     * @param  \App\Models\BidManagementWorkOrderLetterOfAcceptence  $bidManagementWorkOrderLetterOfAcceptence
     * @return \Illuminate\Http\Response
     */
    public function show(BidManagementWorkOrderLetterOfAcceptence $bidManagementWorkOrderLetterOfAcceptence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidManagementWorkOrderLetterOfAcceptence  $bidManagementWorkOrderLetterOfAcceptence
     * @return \Illuminate\Http\Response
     */
    public function edit(BidManagementWorkOrderLetterOfAcceptence $bidManagementWorkOrderLetterOfAcceptence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidManagementWorkOrderLetterOfAcceptence  $bidManagementWorkOrderLetterOfAcceptence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BidManagementWorkOrderLetterOfAcceptence $bidManagementWorkOrderLetterOfAcceptence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidManagementWorkOrderLetterOfAcceptence  $bidManagementWorkOrderLetterOfAcceptence
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidManagementWorkOrderLetterOfAcceptence $bidManagementWorkOrderLetterOfAcceptence)
    {
        //
    }
}
