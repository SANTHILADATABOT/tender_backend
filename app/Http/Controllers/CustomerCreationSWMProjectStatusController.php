<?php

namespace App\Http\Controllers;

use App\Models\CustomerCreationSWMProjectStatus;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\DB;

class CustomerCreationSWMProjectStatusController extends Controller
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
        $user = Token::where('tokenid', $request->tokenid)->first();   
        $userid = $user['userid'];

        if($userid){
            $CustomerCreation = new CustomerCreationSWMProjectStatus;
            $CustomerCreation->projecttype = $request->swmProjectStatus['projecttype']['value'];
            $CustomerCreation->status = $request->swmProjectStatus['status']['value'];
            $CustomerCreation->vendortype = $request->swmProjectStatus['vendortype']['value'];
            $CustomerCreation->vendor = $request->swmProjectStatus['vendor'];
            $CustomerCreation->projectstatus = $request->swmProjectStatus['projectstatus']['value'];
            $CustomerCreation->projectvalue = $request->swmProjectStatus['projectvalue'];
            $CustomerCreation->duration1 = $request->swmProjectStatus['duarationdate1'];
            $CustomerCreation->duration2 = $request->swmProjectStatus['duarationdate2'];
            $CustomerCreation->createdby = $userid;
            $CustomerCreation->updatedby = 0;
            $CustomerCreation->mainid = $request->cust_creation_mainid;
            $CustomerCreation->delete_status= 0;
            $CustomerCreation->save();

            if($CustomerCreation){
                return response()->json([
                    'status' => 200,
                    'message' => 'Added Successfully',
                ]);
            }

        }
        
        return response()->json([
            'status' => 400,
            'message' => "Unable to Save!",
        ]);
        
 

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerCreationSWMProjectStatus  $customerCreationSWMProjectStatus
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerCreationSWMProjectStatus $customerCreationSWMProjectStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerCreationSWMProjectStatus  $customerCreationSWMProjectStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerCreationSWMProjectStatus $customerCreationSWMProjectStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerCreationSWMProjectStatus  $customerCreationSWMProjectStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = Token::where('tokenid', $request->tokenid)->first();   
        $userid = $user['userid'];

        if(!$userid){
            return response()->json([
                'status' => 400,
                'message' => "Unable to update!"
            ]);
        }
        
        $project = CustomerCreationSWMProjectStatus::findOrFail($id)->update([
            'projecttype' => $request->swmProjectStatus['projecttype']['value'],
            'status' => $request->swmProjectStatus['status']['value'],
            'vendortype' => $request->swmProjectStatus['vendortype']['value'],
            'vendor' => $request->swmProjectStatus['vendor'],
            'projectstatus' => $request->swmProjectStatus['projectstatus']['value'],
            'projectvalue' => $request->swmProjectStatus['projectvalue'],
            'duration1'=> $request->swmProjectStatus['duarationdate1'],
            'duration2'=> $request->swmProjectStatus['duarationdate2'],
            'updatedby'=>$userid,
        ]);

        if ($project)
            return response()->json([
                'status' => 200,
                'message' => "Updated Successfully!"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerCreationSWMProjectStatus  $customerCreationSWMProjectStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $project = CustomerCreationSWMProjectStatus::where('id',$id)->update([
        //     'delete_status' => 1,
        // ]);
        // if ($project)
        //     return response()->json([
        //         'status' => 200,
        //         'message' => "Deleted Successfully!"
        //     ]);

            try{
                $project = CustomerCreationSWMProjectStatus::destroy($id);
                if($project)    
                {return response()->json([
                    'status' => 200,
                    'message' => "Deleted Successfully!"
                ]);}
                else
                {return response()->json([
                    'status' => 404,
                    'message' => 'The provided credentials are incorrect.',
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

    public function getlist(Request $request){
        $project = DB::table('customer_creation_s_w_m_project_statuses as a')
        ->join('project_types as b', 'b.id', 'a.projecttype' )
        ->join('project_statuses as c', 'c.id', 'a.projectstatus' )
        ->where('a.delete_status', 0)
        ->where('a.mainid', $request->mainid)
        ->select('a.delete_status',
        'a.duration1',  'a.duration2',
        'a.id',
        'a.mainid',     
        'a.projectstatus',
        'c.projectstatus as projectstatus_label',   
        'a.projecttype', 
        'b.projecttype as projecttype_label',         
        'a.projectvalue',       
        'a.status',      
        'a.updated_at',      
        'a.updatedby',      
        'a.vendor',   
        'a.vendortype',       
        ) 
        ->orderBy('a.id', 'desc')       
        ->get();
    
        if ($project)
            return response()->json([
                'status' => 200,
                'project' => $project
            ]);
        else {
            return response()->json([
                'status' => 404,
                'message' => 'The provided credentials are incorrect.'
            ]);
        }
    }
}
