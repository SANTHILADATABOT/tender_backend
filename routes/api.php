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











use App\Http\Controllers\BidCreationCreationDocsController;
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

Route::get('district/list/{countryid}/{stateid}', [DistrictMasterController::class, 'getDistrictList']);
Route::get('district/list/{countryid}/{stateid}/{saveddistrict}', [DistrictMasterController::class, 'getDistrictListofstate']);

Route::get('city/list/{countryid}/{stateid}/{districtid}/{savedcity}', [CityMasterController::class, 'getCityList']);
Route::get('ulb-list/{savedulb}', [CustomerCreationProfileController::class, 'getUlbs']);
Route::post('customercreationmain/getmainid', [CustomerCreationMainController :: class, 'getMainid']);
Route::post('customercreation/profile', [CustomerCreationProfileController::class, 'getProfileFromData']);
Route::get('customercreation/getcustno/{stateid}', [CustomerCreationProfileController::class, 'getCustNo']);
Route::get('customercreation/profile/getFormNo', [CustomerCreationProfileController::class, 'getFormNo']);
// Route::get('customercreation/contact/getFormNo', [CustomerCreationContactPersonController::class, 'getFormNo']);
Route::post('customercreationcontact/getlist', [CustomerCreationContactPersonController::class, 'getlist']);
Route::post('customercreationbankdetails/getlist', [CustomerCreationBankDetailsController::class, 'getlist']);
Route::post('customercreationsmwprojectstatus/getlist', [CustomerCreationSWMProjectStatusController::class, 'getlist']);
Route::get('projecttype/list/{profileid}', [ProjectTypeController::class, 'getList']);
Route::get('projectstatus/list/{profileid}', [ProjectStatusController::class, 'getList']);
Route::get('competitorprofile/getcompno/{compid}', [CompetitorProfileCreationController::class, 'getCompNo']);
Route::get('competitorbranch/branchlist/{compid}', [CompetitorDetailsBranchesController::class, 'getbranchList']);
Route::get('competitordetails/turnoverlist/{compid}', [CompetitorDetailsTurnOverController::class, 'getTurnOverList']);
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
    'unit' => UnitMasterController::class,
    'city' => CityMasterController::class,
    'district' => DistrictMasterController::class,
    'customercreationmain' => CustomerCreationMainController::class,
    'customercreationprofile' => CustomerCreationProfileController::class,
    'customercreationcontact' => CustomerCreationContactPersonController::class,
    'customercreationsmwprojectstatus' => CustomerCreationSWMProjectStatusController::class,
    'competitorprofile' => CompetitorProfileCreationController::class,
    'competitorbranch' => CompetitorDetailsBranchesController::class,
    'competitorturnover' => CompetitorDetailsTurnOverController::class,
    'projecttype'=>ProjectTypeController::class,
    'customersubcategory'=>CustomerSubCategoryController::class,
    'projectstatus'=> ProjectStatusController::class,
    'customercreationulbdetails'=> ULBDetailsController::class,
    'customercreationbankdetails'=> CustomerCreationBankDetailsController::class,
    'bidcreation/creation'=> BidCreationCreationController::class,
    'bidcreation/creation/docupload'=> BidCreationCreationDocsController::class,
]);
