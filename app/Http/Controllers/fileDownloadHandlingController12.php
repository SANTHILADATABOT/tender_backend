<?php

namespace App\Http\Controllers;

use App\Models\BidmanagementPreBidQueries;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\File;

class FileDownloadHandlingController extends Controller
{

public function download(Request $fileName){
    $user = Token::where('tokenid', $request->tokenid)->first();   
    $userid = $user['userid'];
    if($user){
        $doc = BidmanagementPreBidQueries::find($fileName);

        if($doc){
            $filename = $doc['file_new_name'];
            $file = public_path()."/uploads/BidManagement/prebidqueries/".$filename;
            return response()->download($file);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'File Not Found!'
            ]); 
        }
    }
    else{
        return response()->json([
            'status' => 400,
            'message' => 'Invalid Credentials!'
        ]);
    }
}
}