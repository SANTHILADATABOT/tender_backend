<?php

namespace App\Http\Controllers;
use App\Models\BidManagementWorkOrderWorkOrder;
use Illuminate\Http\Request;
use App\Models\Token;

class BidManagementWorkOrderWorkOrderController extends Controller
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
        if($request->hasFile('file2') && $request->hasFile('file1') && $request->hasFile('file')){
           //image one upload 

            $file_I = $request->file('file');
            $fileExt_I = $file_I->getClientOriginalName();
            $FileExt_I = $file_I->getClientOriginalExtension();
            $fileName_I=$file_I->hashName();
            $filenameSplited_I=explode(".",$fileName_I);
            if($filenameSplited_I[1]!=$fileExt_I)
            {
            $FileName_I=$filenameSplited_I[0].".".$FileExt_I;
            }
            else{
                $FileName_I=$fileName_I;   
            }
            $file_I->storeAs('BidManagement/WorkOrder/WorkOrder/workorderDocument/', $FileName_I, 'public');
            //image two upload
           
            $file_II = $request->file('file1');
            $fileExt_II = $file_II->getClientOriginalName();
            $FileExt_II = $file_II->getClientOriginalExtension();
            $fileName_II=$file_II->hashName();
            $filenameSplited_II=explode(".",$fileName_II);
            if($filenameSplited_II[1]!=$fileExt_II)
            {
            $FileName_II=$filenameSplited_II[0].".".$FileExt_II;
            }
            else{
                $FileName_II=$fileName_II;   
            }
            $file_II->storeAs('BidManagement/WorkOrder/WorkOrder/agreementDocument/', $FileName_II, 'public');
            //image three upload

            $file_III = $request->file('file2');
            $fileExt_III = $file_III->getClientOriginalName();
            $FieExt_III = $file_III->getClientOriginalExtension();
            $fileName_III=$file_III->hashName();
            $filenameSplited_III=explode(".",$fileName_III);
            if($filenameSplited_III[1]!=$fileExt_III)
            {
            $FileName_III=$filenameSplited_III[0].".".$FileExt_III;
            }
            else{
                $FileName_III=$fileName_III;   
            }
            $file_III->storeAs('BidManagement/WorkOrder/WorkOrder/siteHandOverDocumet/', $FileName_III, 'public');
            $user = Token::where('tokenid', $request->tokenid)->first();   
            $userid =$user['userid'];
            $request->request->remove('tokenid');
            if($userid){
                $WorkOrder = new BidManagementWorkOrderWorkOrder;
                $WorkOrder -> bidid = $request->bidid;
                $WorkOrder -> orderQuantity = $request->orderQuantity;
                $WorkOrder -> PricePerUnit = $request->PricePerUnit;
                $WorkOrder -> LoaDate = $request->LoaDate;
                $WorkOrder -> OrderDate = $request->OrderDate;
                $WorkOrder -> AgreeDate = $request->AgreeDate;
                $WorkOrder -> SiteHandOverDate = $request->SiteHandOverDate;
                $WorkOrder -> filetype_I = $FileName_I;
                $WorkOrder -> filetype_II = $FileName_II;
                $WorkOrder -> filetype_III = $FileName_III;
                $WorkOrder -> createdby_userid = $userid ;
                $WorkOrder -> updatedby_userid = 0 ;
                $WorkOrder -> save();
            }
            return response()-> json([
                    'status' => 200,
                    'message' => 'Uploaded Succcessfully',
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
     * @param  \App\Models\BidManagementWorkOrderWorkOrder  $bidManagementWorkOrderWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $WorkOrder = BidManagementWorkOrderWorkOrder::where('id','=',$id)->get();
        if ($WorkOrder){
            return response()->json([
                'status' => 200,
                'WorkOrder' => $WorkOrder,
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
     * @param  \App\Models\BidManagementWorkOrderWorkOrder  $bidManagementWorkOrderWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(BidManagementWorkOrderWorkOrder $bidManagementWorkOrderWorkOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidManagementWorkOrderWorkOrder  $bidManagementWorkOrderWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BidManagementWorkOrderWorkOrder $bidManagementWorkOrderWorkOrder)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidManagementWorkOrderWorkOrder  $bidManagementWorkOrderWorkOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidManagementWorkOrderWorkOrder $bidManagementWorkOrderWorkOrder)
    {
        //
    }

    public function getWorkList($workid)
    {
        $WorkOrder = BidManagementWorkOrderWorkOrder::where("id",$workid)
        ->select('*')
        ->get();
        
        if ($WorkOrder)
        {
            return response()->json([
                'status' => 200,
                'WorkOrder' => $WorkOrder
            ]);
        }
            else {  
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
    }
}
