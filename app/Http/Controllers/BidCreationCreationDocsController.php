<?php

namespace App\Http\Controllers;

use App\Models\BidCreation_Creation_Docs;
use Illuminate\Http\Request;

class BidCreationCreationDocsController extends Controller
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
        if($request ->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $fileName = date('His') . $filename;
            $file->storeAs('BidDocs/', $fileName, 'public');

            
            return response() -> json([
                'status' => 200,
                'message' => 'Uploaded Succcessfully'
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
     * @param  \App\Models\BidCreation_Creation_Docs  $bidCreation_Creation_Docs
     * @return \Illuminate\Http\Response
     */
    public function show(BidCreation_Creation_Docs $bidCreation_Creation_Docs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidCreation_Creation_Docs  $bidCreation_Creation_Docs
     * @return \Illuminate\Http\Response
     */
    public function edit(BidCreation_Creation_Docs $bidCreation_Creation_Docs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidCreation_Creation_Docs  $bidCreation_Creation_Docs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BidCreation_Creation_Docs $bidCreation_Creation_Docs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidCreation_Creation_Docs  $bidCreation_Creation_Docs
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidCreation_Creation_Docs $bidCreation_Creation_Docs)
    {
        //
    }
}
