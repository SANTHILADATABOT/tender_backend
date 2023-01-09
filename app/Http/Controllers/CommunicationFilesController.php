<?php

namespace App\Http\Controllers;

use App\Models\CommunicationFiles;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use App\Models\Token;
// use Illuminate\Database\Eloquent\Factories\HasFactory;


class CommunicationFilesController extends Controller
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
            $fileName1=$file->hashName();
            $filenameSplited=explode(".",$fileName1);
            if($filenameSplited[1]!=$fileExt)
            {
            $fileName=$filenameSplited[0].".".$fileExt;
            }
            else{
                $fileName=$fileName1;   
            }
            $file->storeAs('BidManagement/WorkOrder/CommunicationFiles/', $fileName, 'public');
            $user = Token::where('tokenid', $request->tokenid)->first();   
            $request->request->add(['cr_userid' => $user['userid']]);
            $request->request->add(['filepath' => $fileName]);
            $request->request->remove('tokenId');
            $request->request->add(['filetype' => $fileExt]);
            $dataToInsert = $request->except(['file']);
            return $dataToInsert;
            if($userid){
                $CommunicationFiles = CommunicationFiles::firstOrCreate($dataToInsert);
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
     * @param  \App\Models\CommunicationFiles  $communicationFiles
     * @return \Illuminate\Http\Response
     */
    public function show(CommunicationFiles $communicationFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunicationFiles  $communicationFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunicationFiles $communicationFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunicationFiles  $communicationFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunicationFiles $communicationFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunicationFiles  $communicationFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunicationFiles $communicationFiles)
    {
        //
    }
}
