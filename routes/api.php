<?php

use App\Http\Controllers\UlbMasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControllerTemp;
use App\Http\Controllers\StateMasterController;
use App\Http\Controllers\CountryMasterController;
use App\Http\Controllers\UnitMasterController;
use App\Http\Controllers\CityMasterController;
use App\Http\Controllers\DistrictMasterController;
use App\Http\Controllers\CustomerCreationMainController;
use App\Http\Controllers\CustomerCreationProfileController;
use App\Http\Controllers\CustomerCreationContactPersonController;
use App\Http\Controllers\CustomerCreationSWMProjectStatusController;
use App\Http\Controllers\CompetitorProfileCreationController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\CustomerSubCategoryController;
use App\Http\Controllers\ProjectStatusController;
use App\Http\Controllers\ULBDetailsController;
use App\Http\Controllers\CompetitorDetailsBranchesController;
use App\Http\Controllers\CustomerCreationBankDetailsController;
use App\Http\Controllers\BidCreationCreationController;
use App\Http\Controllers\CompetitorDetailsTurnOverController;
use App\Http\Controllers\CompetitorDetailsCompanyNetWorthController;
use App\Http\Controllers\CompetitorDetailsLineOfBusinessController;
use App\Http\Controllers\BidCreationCreationDocsController;
use App\Http\Controllers\CompetitorDetailsProsConsController;
use App\Http\Controllers\TenderTypeMasterController;
use App\Http\Controllers\CompetitorDetailsQualityCertificatesController;
use App\Http\Controllers\TenderCreationController;
use App\Http\Controllers\CompetitorDetailsWorkOrderController;

use App\Http\Controllers\BidManagementWorkOrderMobilizationAdvanceController;
use App\Http\Controllers\BidManagementWorkOrderProjectDetailsController;
use App\Http\Controllers\BidManagementWorkOrderWorkOrderController;
use App\Http\Controllers\BidManagementWorkOrderCommunicationFilesController;
use App\Http\Controllers\BidManagementWorkOrderLetterOfAcceptenceController;
use App\Http\Controllers\BidManagementTenderStatusBiddersController;

use App\Http\Controllers\BidmanagementPreBidQueriesController;
use App\Http\Controllers\BidmanagementCorrigendumPublishController;
use App\Http\Controllers\BidCreationTenderParticipationController;

use App\Http\Controllers\BidCreationTenderFeeController;
use App\Http\Controllers\BidCreationBidSubmittedStatusController;

use App\Http\Controllers\FileDownloadHandlingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login1', [UserControllerTemp::class, 'login1']);
Route::post('validtetoken', [UserControllerTemp::class, 'validateToken']);

Route::post('logout', [UserControllerTemp::class, 'logout']);
Route::post('createState', [UserControllerTemp::class, 'login1']);
Route::get('country/list', [CountryMasterController::class, 'getList']);
Route::get('country/list/{savedcountry}', [CountryMasterController::class, 'getListofcountry']);
Route::get('customersubcategory/list/{profileid}', [CustomerSubCategoryController::class, 'getList']);

Route::get('state/list/{id}', [StateMasterController::class, 'getStateList']);
Route::get('state-list/{id}', [StateMasterController::class, 'getStates']);
Route::get('state/list/{id}/{category}/{savedstate}', [StateMasterController::class, 'getStateListOptions']);
Route::get('unit/list', [UnitMasterController::class, 'getunitList']);


Route::get('tendercreation/list/{id}', [TenderCreationController::class, 'getTenderList']);
Route::get('tendercreation-list/{id}', [TenderCreationController::class, 'getTender']);


// Route::get('customer/list', [CustomerCreationMainController::class, 'getList']);



// Route::get('state/list/{id}', [StateMasterController::class, 'getStateList']);

// Route::get('tendertype/{id}', [TenderTypeMasterController::class, 'show']);
Route::get('tendertype/list', [TenderTypeMasterController::class, 'getList']);
// Route::get('state/list/{id}/{category}/{savedstate}', [StateMasterController::class, 'getStateListOptions']);


Route::get('district/list/{countryid}/{stateid}', [DistrictMasterController::class, 'getDistrictList']);
Route::get('district/list/{countryid}/{stateid}/{saveddistrict}', [DistrictMasterController::class, 'getDistrictListofstate']);
Route::get('city/list/{countryid}/{stateid}/{districtid}/{savedcity}', [CityMasterController::class, 'getCityList']);
Route::get('ulb-list/{savedulb}', [CustomerCreationProfileController::class, 'getUlbs']);
Route::post('customercreationmain/getmainid', [CustomerCreationMainController :: class, 'getMainid']);
Route::post('customercreation/profile', [CustomerCreationProfileController::class, 'getProfileFromData']);
Route::get('customercreation/getcustno/{stateid}', [CustomerCreationProfileController::class, 'getCustNo']);
Route::get('customercreation/profile/getFormNo', [CustomerCreationProfileController::class, 'getFormNo']);
Route::get('customer/list', [CustomerCreationProfileController::class, 'getList']);
Route::get('tendercreation/list', [TenderTypeMasterController::class, 'getList']);


// Route::get('customercreation/contact/getFormNo', [CustomerCreationContactPersonController::class, 'getFormNo']);
Route::post('customercreationcontact/getlist', [CustomerCreationContactPersonController::class, 'getlist']);
Route::post('customercreationbankdetails/getlist', [CustomerCreationBankDetailsController::class, 'getlist']);
Route::post('customercreationsmwprojectstatus/getlist', [CustomerCreationSWMProjectStatusController::class, 'getlist']);
Route::get('projecttype/list/{profileid}', [ProjectTypeController::class, 'getList']);
Route::get('projecttype/list', [ProjectTypeController::class, 'getListofProjectType']);
Route::get('projectstatus/list/{profileid}', [ProjectStatusController::class, 'getList']);
Route::get('competitorprofile/getcompno/{compid}', [CompetitorProfileCreationController::class, 'getCompNo']);
Route::get('competitorbranch/branchlist/{compid}', [CompetitorDetailsBranchesController::class, 'getbranchList']);
Route::get('competitordetails/turnoverlist/{compid}', [CompetitorDetailsTurnOverController::class, 'getTurnOverList']);
Route::get('competitordetails/networthlist/{compid}', [CompetitorDetailsCompanyNetWorthController::class, 'getNetWorthList']);
Route::get('competitordetails/lineofbusinesslist/{compid}', [CompetitorDetailsLineOfBusinessController::class, 'getLineOfBusinessList']);
Route::get('competitordetails/prosconslist/{compid}', [CompetitorDetailsProsConsController::class, 'getProsConsList']);
Route::get('competitordetails/qclist/{compid}', [CompetitorDetailsQualityCertificatesController::class, 'getQCList']);
Route::post('bidcreation/creation/docupload/list', [BidCreationCreationDocsController::class, 'getUplodedDocList']);
Route::post('bidcreation/creation/docupload/{id}', [BidCreationCreationDocsController::class, 'update']);
Route::get('download/BidDocs/{fileName}', [BidCreationCreationDocsController::class, 'download']);


// Route::post('competitordetails/competitorqcertificate/updatewithimage', [CompetitorDetailsQualityCertificatesController::class, 'updateWithImage']);
Route::get('competitordetails/wolist/{compid}', [CompetitorDetailsWorkOrderController::class, 'getWOList']);
Route::post('bidcreation/creation/bidlist',[BidCreationCreationController::class,'getBidList']);

Route::get('moilization/getMobList/{mobId}',[BidManagementWorkOrderMobilizationAdvanceController::class,'getMobList']);
Route::get('ProjectDetails/getProList/{proid}',[BidManagementWorkOrderProjectDetailsController::class,'getProList']);

Route::post('bidcreation/creation/bidlist',[BidCreationCreationController::class,'getBidList']);

Route::post('bidcreation/prebidqueries/docupload/list', [BidmanagementPreBidQueriesController::class, 'getUplodedDocList']);
Route::get('download/prebidqueriesdocs/{fileName}', [BidmanagementPreBidQueriesController::class, 'download']);
Route::post('bidcreation/prebidqueries/docupload/{id}', [BidmanagementPreBidQueriesController::class, 'update']);

Route::get('workorder/getComList/{comId}',[BidManagementWorkOrderCommunicationFilesController::class,'getComList']);  
Route::get('tenderstatus/getbidder/{id}',[BidManagementTenderStatusBiddersController::class,'getBidders']);   
Route::post('tenderstatus/updatestatus/{id}',[BidManagementTenderStatusBiddersController::class,'updateStatus']);   

Route::post('bidcreation/corrigendumpublish/docupload/list', [BidmanagementCorrigendumPublishController::class, 'getUplodedDocList']);
Route::get('download/corrigendumpublishdocs/{fileName}', [BidmanagementCorrigendumPublishController::class, 'download']);
Route::post('bidcreation/corrigendumpublish/docupload/{id}', [BidmanagementCorrigendumPublishController::class, 'update']);
//brindha updated on 21-01-2023
Route::get('bidcreation/creation/live_tenders',[BidCreationCreationController::class,'live_tender']);
Route::get('bidcreation/creation/fresh_tenders',[BidCreationCreationController::class,'fresh_tender']);

Route::get('download/tenderfeedocs/{id}', [BidCreationTenderFeeController::class, 'getdocs']);
Route::get('download/bidsubmittedstatusdocs/{id}', [BidCreationBidSubmittedStatusController::class, 'getdocs']);


// Route::post('bidcreation/getWorkList/list', [BidmanagementCorrigendumPublishController::class, 'getWorkList']);
Route::get('download/workorderimage/{woid}', [BidManagementWorkOrderWorkOrderController::class, 'wodownload']);
Route::get('download/agreementimage/{agid}', [BidManagementWorkOrderWorkOrderController::class, 'agdownload']);
Route::get('download/sitehandoverimage/{shoid}', [BidManagementWorkOrderWorkOrderController::class, 'shodownload']);
Route::post('workorder/creation/Workorder/update/{workid}', [BidManagementWorkOrderWorkOrderController::class, 'update']);
Route::get('workorder/creation/Workorder/getimagename/{workid}', [BidManagementWorkOrderWorkOrderController::class, 'getimagename']);
Route::post('download/files', [FileDownloadHandlingController::class, 'download']);

Route::get('download/letterofacceptance/workorderimage/{woid}', [BidManagementWorkOrderLetterOfAcceptenceController::class, 'wodownload']);
Route::post('letteracceptance/creation/update/{id}', [BidManagementWorkOrderLetterOfAcceptenceController::class, 'update']);

Route::post('/workorder/creation/communicationfiles/{id}', [BidManagementWorkOrderCommunicationFilesController::class,'store']);
Route::get('/competitordetails/commFilesList/{id}', [BidManagementWorkOrderCommunicationFilesController::class,'getComList']);


Route::get('/file-import',[ImportCustomerController::class,'importView'])->name('import-view');

Route::post('/legacystatement',[BidCreationCreationController::class,'getlegacylist']);

Route::get('/bidcreation/creation/getlastbidno/{id}', [ BidCreationCreationController::class,'getLastBidno']);
Route::get('/customercreation/getstatecode/{id}', [ StateMasterController::class,'getStateCode']);
Route::get('/tendertrack/list', [ TenderCreationController::class,'gettendertrack']);
Route::post('/tendertrack/creation/tracklist',[TenderCreationController::class,'gettrackList']);
/*
## Resource Laravel Routes Example

Route::post(['ulb',[UlbMasterController::class,'store']]);//
Route::get(['ulb/{id}',[UlbMasterController::class,'show']]);
Route::get(['ulb/edit/{id}',[UlbMasterController::class,'edit']]);//
Route::put/patch(['ulb/{id}',[UlbMasterController::class,'update']]);
    ## put=>If the record exists then update else create a new record
    ## Patch =>update/modify
Route::delete(['ulb/{id}',[UlbMasterController::class,'destroy']]);
*/
Route::resources([
    'ulb' => UlbMasterController::class,
    'state' => StateMasterController::class,
    'country' => CountryMasterController::class,
    'tendertype'=> TenderTypeMasterController::class,
    'unit' => UnitMasterController::class,
    'tendercreation'=>TenderCreationController::class,
    'city' => CityMasterController::class,
    'district' => DistrictMasterController::class,
    'customercreationmain' => CustomerCreationMainController::class,
    'customercreationprofile' => CustomerCreationProfileController::class,
    'customercreationcontact' => CustomerCreationContactPersonController::class,
    'customercreationsmwprojectstatus' => CustomerCreationSWMProjectStatusController::class,
    'competitorprofile' => CompetitorProfileCreationController::class,
    'competitorbranch' => CompetitorDetailsBranchesController::class,
    'competitorturnover' => CompetitorDetailsTurnOverController::class,
    'competitornetworth' => CompetitorDetailsCompanyNetWorthController::class,
    'competitorlineofbusiness' => CompetitorDetailsLineOfBusinessController::class,
    'competitorproscons' => CompetitorDetailsProsConsController::class,
    'competitorqcertificate' => CompetitorDetailsQualityCertificatesController::class,
    'competitorworkorder' => CompetitorDetailsWorkOrderController::class,
    'projecttype'=>ProjectTypeController::class,
    'customersubcategory'=>CustomerSubCategoryController::class,
    'projectstatus'=> ProjectStatusController::class,
    'customercreationulbdetails'=> ULBDetailsController::class,
    'customercreationbankdetails'=> CustomerCreationBankDetailsController::class,
    'bidcreation/creation'=> BidCreationCreationController::class,
    'bidcreation/creation/docupload'=> BidCreationCreationDocsController::class,
    'tenderstatus'=>BidManagementTenderStatusBiddersController::class,
    'workorder/creation/communicationfiles' => BidManagementWorkOrderCommunicationFilesController::class,
    'mobilization/creation' => BidManagementWorkOrderMobilizationAdvanceController::class,
    'ProjectDetails/Creation'=>BidManagementWorkOrderProjectDetailsController::class,
    'workorder/creation/Workorder'=>BidManagementWorkOrderWorkOrderController::class,
    'bidcreation/prebidqueries/docupload'=> BidmanagementPreBidQueriesController::class,
    'bidcreation/corrigendumpublish/docupload'=> BidmanagementCorrigendumPublishController::class,
    'bidcreation/tenderparticipation'=> BidCreationTenderParticipationController::class,
    'bidcreation/bidsubmission/tenderfee'=> BidCreationTenderFeeController::class,
    'bidcreation/bidsubmission/bidsubmittedstatus' =>BidCreationBidSubmittedStatusController::class,
    'letteracceptance/creation' =>BidManagementWorkOrderLetterOfAcceptenceController::class,
]);




//File uplaod Default location has been set by below line in config/filesystems.php file
//'root' => public_path()."/uploads",

//Can create a new folder inside public/uploads path
//$file->storeAs('competitor/qc', $fileName, 'public');  

