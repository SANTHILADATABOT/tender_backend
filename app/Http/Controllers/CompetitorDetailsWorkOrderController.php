<?php

namespace App\Http\Controllers;

use App\Models\CompetitorDetailsWorkOrder;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;

class CompetitorDetailsWorkOrderController extends Controller
{
    
    public function store(Request $request)
    {
        
        if($request->hasFile('woFile')){
           
            $woFile = $request->woFile;
            $woFileExt = $woFile->getClientOriginalExtension();
            //received File extentions sometimes converted by browsers
            //Have to set orignal file extention before save
            $woFileName1=$woFile->hashName();
            $woFilenameSplited=explode(".",$woFileName1);
            if($woFilenameSplited[1]!=$woFileExt)
            {
            $woFileName=$woFilenameSplited[0].".".$woFileExt;
            }
            else{
                $woFileName=$woFileName1;   
            }
            $woFile->storeAs('uploads/image/competitor/wo/woFile', $woFileName, 'public');
            $user = Token::where("tokenid", $request->tokenId)->first();   
            $request->request->add(['cr_userid' => $user['userid']]);
            // $request->request->remove('woFile');
            // $request->request->add(['woFile' => $woFileName]);
            $request->request->remove('tokenId');
            $request->request->add(['woFileType' => $woFileExt]);
            $request->woFile=$woFileName;
            


        if($request->completionFile!=''){
            
            $completionFile = $request->completionFile;
            $completionFileExt = $completionFile->getClientOriginalExtension();
            //received File extentions sometimes converted by browsers
            //Have to set orignal file extention before save
            $completionFileName1=$completionFile->hashName();
            $completionFilenameSplited=explode(".",$completionFileName1);
            if($completionFilenameSplited[1]!=$completionFileExt)
            {
            $completionFileName=$completionFilenameSplited[0].".".$completionFileExt;
            }
            else{
                $completionFileName=$completionFileName1;   
            }
            $completionFile->storeAs('uploads/image/competitor/wo/completedFile', $completionFileName, 'public');         
            $request->completionFile= $completionFileName;
            $request->request->add(['completionFileType' => $completionFileExt]);
        }
        else{
            $completionFileExt='';
            $completionFile='';
        }
            

            $existence = CompetitorDetailsWorkOrder::where("compNo", $request->compNo)
                ->where("compId", $request->compId)
                ->where("custName", $request->custName)->exists();
                
            if ($existence) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Certificate Name Already Exists!'
                ]);
            }
       
            $validator = Validator::make($request->all(), ['compId' => 'required|integer','compNo' => 'required|string','custName'=>'required|string','projectName'=>'required|string','tnederId'=>'required|string','state'=>'required|string','woDate'=>'required|date','quantity'=>'required|string','unit'=>'required|string','projectValue'=>'required|string','perTonRate'=>'required|string','qualityCompleted'=>'required|string','date'=>'required|date','cr_userid'=>'required|integer']);
           
            if ($validator->fails()) {
                return response()->json([
                    'status' => 404,
                    'message' =>"Not able to Add details now..!",
                    'error'=> $validator->messages(),
                ]);
                }
            // $datatostore=$request->except(['woFile','completionFile']);
                // echo $request->compId;
                $datatostore = new CompetitorDetailsWorkOrder;
            $datatostore->compId=$request->compId;
            $datatostore->compNo=$request->compNo;
            $datatostore->projectName=$request->projectName;
            $datatostore->custName=$request->custName;
            $datatostore->tnederId=$request->tnederId;
            $datatostore->state=$request->state;
            $datatostore->woDate=$request->woDate;
            $datatostore->quantity=$request->quantity;
            $datatostore->unit=$request->unit;
            $datatostore->projectValue=$request->projectValue;
            $datatostore->perTonRate=$request->perTonRate;
            $datatostore->qualityCompleted=$request->qualityCompleted;
            $datatostore->date=$request->date;
            $datatostore->cr_userid=$user['userid'];
            $datatostore->woFile=$woFileName;
            $datatostore->woFileType=$woFileExt;
            $datatostore->completionFile=$completionFileName;
            $datatostore->completionFileType=$completionFileExt;
            $woRes=$datatostore->save();
            if ($woRes) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Added Succssfully!',
                ]);
            }

        }else{
            
            return response()->json([
                'status' => 404,
                'message' => 'Unable to save!'
            ]);
        }
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
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
        $file->storeAs('uploads/image/competitor/wo', $fileName, 'public');
        
        
        //to delete Existing Image from storage
        $data = CompetitorDetailsWorkOrder::find($id);
        $image_path = public_path('competitorQC').'/'.$data->filepath;
        unlink($image_path);
       
        $user = Token::where("tokenid", $request->tokenId)->first();   
        $request->request->add(['edited_userid' => $user['userid']]);
        $request->request->remove('tokenId');
        $request->request->add(['filepath' => $fileName]);
        $request->request->add(['filetype' => $fileExt]);

        $validator = Validator::make($request->all(), ['compId' => 'required|integer','compNo' => 'required|string','cerName'=>'required|string', 'filepath'=>'required|string','remark'=>'nullable|string','edited_userid'=>'required|integer']);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'message' =>"Not able to update details now..!",
                'error'=> $validator->messages(),
            ]);
            }
    $dataToUpdate = $request->except(['file']);
    $qcedit = CompetitorDetailsWorkOrder::findOrFail($id)->update($dataToUpdate);
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
    else{
        
            $user = Token::where("tokenid", $request->tokenId)->first();  
            
            $request->request->add(['edited_userid' => $user['userid']]);
            // $request->request->add(['filepath' => $fileName]);
            $request->request->remove('tokenId');
        
            $validator = Validator::make($request->all(), ['compId' => 'required|integer','compNo' => 'required|string','cerName'=>'required|string', 'remark'=>'nullable|string','edited_userid'=>'required|integer']);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => 404,
                    'message' =>"Not able to update details now..!",
                    'error'=> $validator->messages(),
                ]);
                }
        
        $qcedit = CompetitorDetailsWorkOrder::findOrFail($id)->update($request->all());
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
       


   
    public function destroy($id)
    {
        try{
        
        //to delete Existing Image from storage
        $data = CompetitorDetailsWorkOrder::find($id);
        $image_path = public_path('competitorQC').'/'.$data->filepath;
        unlink($image_path);
        $data->delete();    

            $qc = CompetitorDetailsWorkOrder::destroy($id);
            if($qc)    
            {
                return response()->json([
                'status' => 200,
                'message' => "Deleted Successfully!",
            ]);}
            else
            {return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect!?',
                "errormessage" => "",
            ]);}
        }catch(\Illuminate\Database\QueryException $ex){
            $error = $ex->getMessage(); 
            return response()->json([
                'status' => 404,
                'message' => 'Unable to delete! This data is used in another file/form/table.',
                "errormessage" => $error,
            ]);
        }
    }


    
    public function getWOList($compid)
    {
        $qc = CompetitorDetailsWorkOrder::where("compId",$compid)
        ->select('*')
        ->get();
        if ($qc)
        {
            return response()->json([
                'status' => 200,
                'qc' => $qc
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
