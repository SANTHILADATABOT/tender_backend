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
use App\Http\Controllers\CommunicationFilesController;
use App\Http\Controllers\TenderCreationController;
use App\Http\Controllers\MobilizationAdvanceController;
use App\Http\Controllers\CompetitorDetailsWorkOrderController;
use App\Http\Controllers\BidManagementWorkOrderProjectDetailsController;

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

Route::get('tendertype/{id}', [TenderTypeMasterController::class, 'show']);





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
Route::get('projectstatus/list/{profileid}', [ProjectStatusController::class, 'getList']);


Route::get('competitorprofile/getcompno/{compid}', [CompetitorProfileCreationController::class, 'getCompNo']);
Route::get('competitorbranch/branchlist/{compid}', [CompetitorDetailsBranchesController::class, 'getbranchList']);
Route::get('competitordetails/turnoverlist/{compid}', [CompetitorDetailsTurnOverController::class, 'getTurnOverList']);
Route::get('competitordetails/networthlist/{compid}', [CompetitorDetailsCompanyNetWorthController::class, 'getNetWorthList']);
Route::get('competitordetails/lineofbusinesslist/{compid}', [CompetitorDetailsLineOfBusinessController::class, 'getLineOfBusinessList']);
Route::get('competitordetails/prosconslist/{compid}', [CompetitorDetailsProsConsController::class, 'getProsConsList']);
Route::get('competitordetails/qclist/{compid}', [CompetitorDetailsQualityCertificatesController::class, 'getQCList']);
Route::get('competitordetails/wolist/{compid}', [CompetitorDetailsWorkOrderController::class, 'getWOList']);


Route::get('moilization/getMobList/{mobId}',[MobilizationAdvanceController::class,'getMobList']);

Route::get('ProjectDetails/getProList/{proid}',[BidManagementWorkOrderProjectDetailsController::class,'getProList']);

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
    'workorder/creation/communicationfiles' => CommunicationFilesController::class,
    'mobilization/creation' => MobilizationAdvanceController::class,
    'ProjectDetails/Creation'=>BidManagementWorkOrderProjectDetailsController::class,

]);




//File uplaod Default location has been set by below line in config/filesystems.php file
//'root' => public_path()."/uploads",

//Can create a new folder inside public/uploads path
//$file->storeAs('competitor/qc', $fileName, 'public');  
