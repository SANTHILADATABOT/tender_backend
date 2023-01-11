<?php

namespace App\Http\Controllers;

use App\Models\BidManagementWorkOrderCommunicationFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;

class BidManagementWorkOrderCommunicationFilesController extends Controller
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
        if($request ->hasFile('file')){
            $file = $request->file('file');
            $fileExt = $file->getClientOriginalName();
            $FileExt_I = $file->getClientOriginalExtension();
            $fileName1=$file->hashName();
            $filenameSplited=explode(".",$fileName1);
            if($filenameSplited[1]!=$fileExt)
            {
            $fileName=$filenameSplited[0].".".$FileExt_I;
            }
            else{
                $fileName=$fileName1;   
            }
           
           
            $user = Token::where('tokenid', $request->tokenid)->first(); 
            $userid = $user['userid'];
            $request->request->remove('tokenid');
            if($userid){
              $CommunicationFiles = new BidManagementWorkOrderCommunicationFiles;
              $CommunicationFiles -> bidid = $request->bidid;
              $CommunicationFiles -> Date = $request->date;
              $CommunicationFiles -> RefrenceNo = $request->refrence_no;
              $CommunicationFiles -> From = $request->from;
              $CommunicationFiles -> To = $request->to;
              $CommunicationFiles -> Subject = $request->bidid;
              $CommunicationFiles -> Medium = $request->medium;
              $CommunicationFiles -> Filepath = $fileName;
              $CommunicationFiles -> created_userid = $userid;
              $CommunicationFiles -> updated_userid = 0 ;
              $CommunicationFiles -> save();

              $file->storeAs('BidManagement/WorkOrder/CommunicationFiles/', $fileName, 'public');
            }
                        
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
     * @param  \App\Models\BidManagementWorkOrderCommunicationFiles  $bidManagementWorkOrderCommunicationFiles
     * @return \Illuminate\Http\Response
     */
    public function show(BidManagementWorkOrderCommunicationFiles $bidManagementWorkOrderCommunicationFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BidManagementWorkOrderCommunicationFiles  $bidManagementWorkOrderCommunicationFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(BidManagementWorkOrderCommunicationFiles $bidManagementWorkOrderCommunicationFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BidManagementWorkOrderCommunicationFiles  $bidManagementWorkOrderCommunicationFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileExt = $file->getClientOriginalExtension();
            $fileName1=$file->hashName();
            //received File extentions sometimes converted by browsers
            //Have to set orignal file extention before save
            $filenameSplited=explode(".",$fileName1);
            if($filenameSplited[1]!=$fileExt)
            {
            $fileName=$filenameSplited[0].".".$fileExt;
            }
            else{
                $fileName=$fileName1;   
            }
            $file->storeAs('uploads/BidManagement/WorkOrder/CommunicationFiles/', $fileName, 'public');
            
            
            //to delete Existing Image from storage
            $data = BidManagementWorkOrderCommunicationFiles::find($id);
            $image_path = public_path('BidManagement/WorkOrder/CommunicationFiles').'/'.$data->filepath;
            unlink($image_path);
           
            $user = Token::where("tokenid", $request->tokenId)->first();   
            $request->request->add(['edited_userid' => $user['userid']]);
            $request->request->remove('tokenId');
            $request->request->add(['filepath' => $fileName]);
            $request->request->add(['filetype' => $fileExt]);
           
            $dataToUpdate = $request->except(['file']);
            $qcedit = BidManagementWorkOrderCommunicationFiles::findOrFail($id)->update($dataToUpdate);
        if ($qcedit)
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
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BidManagementWorkOrderCommunicationFiles  $bidManagementWorkOrderCommunicationFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(BidManagementWorkOrderCommunicationFiles $bidManagementWorkOrderCommunicationFiles)
    {
        //
    }
}
