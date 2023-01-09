<?php

namespace App\Http\Controllers;

use App\Models\BidManagementWorkOrderWorkOrder;
use Illuminate\Http\Request;

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

            $file_I = $request->file('file');
            $file_II = $request->file('file1');
            $file_III = $request->file('file2');

            $fileExt_I = $file_I->getClientOriginalExtension();
            $fileExt_II = $file_II->getClientOriginalExtension();
            $fileExt_III = $file_III->getClientOriginalExtension();

            $file_I->storeAs('uploads/BidManagement/WorkOrder/WorkOrder/workorderDocument/', $fileExt_I, 'public');
            $file_II->storeAs('uploads/BidManagement/WorkOrder/WorkOrder/agreementDocument/', $fileExt_II, 'public');
            $file_III->storeAs('uploads/BidManagement/WorkOrder/WorkOrder/siteHandOverDocumet/', $fileExt_III, 'public');
            return response()-> json([
                    'status' => 200,
                    'message' => 'Uploaded Succcessfully',
            ]);
        } else{
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
    public function show(BidManagementWorkOrderWorkOrder $bidManagementWorkOrderWorkOrder)
    {
        //
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
        //
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
}
