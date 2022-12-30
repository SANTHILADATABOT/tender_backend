<?php

namespace App\Http\Controllers;

use App\Models\CompetitorDetailsQualityCertificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Token;

class CompetitorDetailsQualityCertificatesController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        if($request ->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $current_date_time = \Carbon\Carbon::now()->timestamp;
            $fileName = "Qc_".$current_date_time."_".$filename;
            $file->storeAs('uploads/image/competitor/qc', $fileName, 'public');
            
            
            $user = Token::where("tokenid", $request->tokenId)->first();   
            
            $request->request->add(['cr_userid' => $user['userid']]);

            $request->request->add(['filepath' => $fileName]);
            $request->request->remove('tokenId');
            $request->request->remove('file');
            
    
            $existence = CompetitorDetailsQualityCertificates::where("compNo", $request->compNo)
                ->where("compId", $request->compId)
                ->where("cerName", $request->cerName)->exists();
                
            if ($existence) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Already Exists!'
                ]);
            }
            $validator=$request->validate([
                'compId' => 'required|integer','compNo' => 'required|string','cerName'=>'required|string', 'remark'=>'nullable|string','cr_userid'=>'required|integer'
            ]);
            // $validator = Validator::make($request, ['compId' => 'required|integer','compNo' => 'required|string','cerName'=>'required|string', 'remark'=>'nullable|string','cr_userid'=>'required|integer']);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 404,
                    'message' =>"Not able to Add Turn Over details now..!",
                    'error'=> $validator->messages(),
                ]);
            }
            $qcRes = CompetitorDetailsQualityCertificates::firstOrCreate($request->all());
            if ($qcRes) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Created Succssfully!',
                ]);
            }

        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Unable to save!'
            ]);
        }
        
    }

   
    public function show(CompetitorDetailsQualityCertificates $competitorDetailsQualityCertificates)
    {
        //
    }

    public function edit(CompetitorDetailsQualityCertificates $competitorDetailsQualityCertificates)
    {
        //
    }

    public function update(Request $request, CompetitorDetailsQualityCertificates $competitorDetailsQualityCertificates)
    {
        //
    }

   
    public function destroy(CompetitorDetailsQualityCertificates $competitorDetailsQualityCertificates)
    {
        //
    }
}
