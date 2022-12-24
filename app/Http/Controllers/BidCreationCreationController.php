<?php

namespace App\Http\Controllers;

use App\Models\BidCreation_Creation;
use Illuminate\Http\Request;

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
            
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BidCreation_Creation  $bidCreation_Creation
     * @return \Illuminate\Http\Response
     */
    public function show(BidCreation_Creation $bidCreation_Creation)
    {
        //
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
    public function update(Request $request, BidCreation_Creation $bidCreation_Creation)
    {
        //
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
