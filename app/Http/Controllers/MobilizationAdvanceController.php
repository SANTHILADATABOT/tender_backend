<?php

namespace App\Http\Controllers;

use App\Models\MobilizationAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;

class MobilizationAdvanceController extends Controller
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
        $user = Token::where('tokenid', $request->tokenid)->first();   
        $userid = $user['userid'];

        $request->request->remove('tokenId');

        if($userid){
        $MobilizationAdvance = new MobilizationAdvance;
        $MobilizationAdvance -> mobAdvance = $request->mobilizationData['mobAdvance'];
        $MobilizationAdvance -> bankName = $request->mobilizationData['bankName'];
        $MobilizationAdvance -> bankBranch = $request->mobilizationData['bankBranch'];
        $MobilizationAdvance -> mobAdvMode = $request->mobilizationData['mobAdvMode'];
        $MobilizationAdvance -> dateMobAdv = $request->mobilizationData['dateMobAdv'];
        $MobilizationAdvance -> validUpto = $request->mobilizationData['validUpto'];
        $MobilizationAdvance -> createdby_userid = $userid ;
        $MobilizationAdvance -> updatedby_userid = 0 ;
        $MobilizationAdvance -> save();
        }
        
        if ($MobilizationAdvance) {
            return response()->json([
                'status' => 200,
                'message' => 'Bid Has created Succssfully!',
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
     * @param  \App\Models\MobilizationAdvance  $mobilizationAdvance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MobilizationAdvance = MobilizationAdvance::find($id);
        if ($MobilizationAdvance){
            return response()->json([
                'status' => 200,
                'MobilizationAdvance' => $MobilizationAdvance
            ]);
        }
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
     * @param  \App\Models\MobilizationAdvance  $mobilizationAdvance
     * @return \Illuminate\Http\Response
     */
    public function edit(MobilizationAdvance $mobilizationAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MobilizationAdvance  $mobilizationAdvance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Token::where('tokenid', $request->tokenid)->first();   
        $userid = $user['userid'];
        if($userid){
            $request->mobilizationData;
            $request->request->add(['updatedby_userid' => $user['userid']]);
            $request->request->remove('tokenid');
        }
            $updatedata = $request->except(['createdby_userid']);
            $MobilizationAdvance = MobilizationAdvance::findOrFail($id)->update($updatedata);
           
            if ($MobilizationAdvance){
                return response()->json([
                    'status' => 200,
                    'MobilizationAdvance' => $MobilizationAdvance
                ]);
            }
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
     * @param  \App\Models\MobilizationAdvance  $mobilizationAdvance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobilizationAdvance $mobilizationAdvance)
    {
        //
    }
}
