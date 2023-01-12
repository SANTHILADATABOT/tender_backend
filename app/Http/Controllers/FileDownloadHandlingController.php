<?php

namespace App\Http\Controllers;

use App\Models\BidmanagementPreBidQueries;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\File;

class FileDownloadHandlingController extends Controller
{
    //Send data like this
    // fileName: filename, tokenid: localStorage.getItem("token")

public function download(Request $request){
    $user = Token::where('tokenid', $request->tokenid)->first();   
    if($user){
        //For Development
        $path= str_replace("http://192.168.1.29:8000","",$request->fileName);
        $file=public_path().$path;

        //For Live
        // $path= str_replace("http://192.168.1.29:8000","",$request->fileName);
        // $file=public_path().$path;
        
        return response()->download($file);
    }
    else{
        return response()->json([
            'status' => 400,
            'message' => 'Invalid Credentials!'
        ]);
    }
}
}
