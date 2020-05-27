<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use App\Models\UserGroup;
use App\Models\Company;
use App\Models\Contact;
use App\Models\ClientGroup;
use App\Models\Employee;
use App\Models\Material;
use App\Models\PaymentMethod;
use App\Models\ProductCategory;
use App\Models\TaskCategory;
use App\Models\ItemCategory;
use App\Models\Department;
use App\Models\Bank;
use App\Models\Asset;
use App\Models\Maintenance;
use App\Models\Product;
use App\Models\JobOrder;
use App\Models\Prefix;
use App\Models\Lead;
use App\Models\Sale;
use App\Models\MaterialProduct; 
use App\Models\LeadProduct; 
use App\Models\CompnayInfo; 
use App\Models\AllOrder; 
use App\Models\PurchasingOrder;

// Example Routes
Route::get('/', function() {
    return redirect('/login');
});
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
})->name('dash');


// Authentication Route
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/forgotpassword', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot.password');
Route::post('/forgotpassword', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('forgot.send.email');

Route::get('/passwordreset', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/passwordreset', 'Auth\ResetPasswordController@reset')->name('password.reset');


// Users & Group module routes
$users = User::all();
$groups = UserGroup::all();
Route::view('/users/user', 'users.user', ['users' => $users])->name('users.user');
Route::view('/users/group', 'users.group', ['groups' => $groups])->name('users.group');

// Create, Read, Update, Delete User
Route::get('/users/getuser', 'Users\UserController@index');
Route::post('/users/createuser', 'Users\UserController@create');
Route::post('/users/updateuser', 'Users\UserController@update');
Route::post('/users/deleteuser', 'Users\UserController@delete');

// Create, Read, Update, Delete Group
Route::get('/users/getgroup', 'Users\GroupController@index');
Route::get('/users/getgroups/{name?}', 'Users\GroupController@getGroupsByName');
Route::post('/users/creategroup', 'Users\GroupController@create');
Route::post('/users/updategroup', 'Users\GroupController@update');
Route::post('/users/deletegroup', 'Users\GroupController@delete');


// CRM module routes
$companies = Company::all();
$contacts = Contact::all();
$clientGroups = ClientGroup::all();
Route::get('/crm/companies-contacts/{name?}', function ($name=null) {
    if (isset($name)) {
        $companies = Company::where('company_name', 'LIKE', '%'.$name.'%')->get();
        $contacts = Contact::where('contact_name', 'LIKE', '%'.$name.'%')->get();
        return json_encode(['companies' => $companies, 'contacts' => $contacts]);
    } else {
        $companies = Company::all();
        $contacts = Contact::all();
        return json_encode(['companies' => $companies, 'contacts' => $contacts]);
    }
});
Route::view('/crm/company', 'crm.company', ['companies' => $companies])->name('crm.company');
Route::view('/crm/contact', 'crm.contact', ['contacts' => $contacts])->name('crm.contact');
Route::view('/crm/group', 'crm.group', ['groups' => $clientGroups])->name('crm.group');

// Create, Read, Update, Delete Company
$company = Company::all();
Route::view('/crm/company', 'crm.company', ['companies' => $company])->name('crm.company');
Route::get('/crm/getcompany', 'Crm\CompanyController@index');
Route::get('/crm/getcompanies/{name?}', 'Crm\CompanyController@getCompaniesByName');
Route::post('/crm/createcompany', 'Crm\CompanyCotnroller@create');
Route::post('/crm/updatecompany', 'Crm\CompanyController@update');
Route::post('/crm/deletecompany', 'Crm\CompanyController@delete');
Route::get('/crm/viewcompany/{id}', function ($id) {
    $company = Company::find($id);
    // $company = $contact->company;
    $group = $company->group;
    $attaches =  $company->company_card;
    return view('crm.company-view', ['company' => $company, 'Group' => $group, 'attaches' => $attaches]);
});
Route::get('/crm/editCompany/{id}', function ($id) {
    $company = Company::find($id);
    return view('crm.company-edit', ['company' => $company]);
});


// Create, Read, Update, Delete Contact
$contacts = Contact::all();
Route::view('/crm/contact', 'crm.contact', ['contacts' => $contacts])->name('crm.contact');
Route::get('/crm/getcontact', 'Crm\ContactController@index');
Route::get('/crm/getcontacts/{name?}', 'Crm\ContactController@getContactsByName');
Route::post('/crm/createcontact', 'Crm\ContactController@create');
Route::post('/crm/updatecontact', 'Crm\ContactController@update');
Route::POST('/crm/deletecontact', 'Crm\ContactController@delete');
Route::view('/crm/ViewCreateContact', 'crm.contact-create')->name('crm.contact.create');
Route::get('/crm/viewcontact/{id}', function ($id) {
    $contact = Contact::find($id);
    $company = $contact->company;
    $group = $company->group;
    $attaches =  $contact->contact_business_card;
    return view('crm.contact-view', ['contact' => $contact, 'company' => $company, 'Group' => $group, 'attaches' => $attaches]);
});
Route::get('/crm/editContact/{id}', function ($id) {
    $contact = Contact::find($id);
    $company = $contact->company;
    return view('crm.contact-edit', ['contact' => $contact, 'company' => $company]);
});

// Download card image of comapnies for contacts  
// Route::get('/download/{path}',function($path){
//     //     dd($filepath);
//     //     $filepath = $path;
//     //     $headers = array(
//     //         'Content-Type', 'image/png/jfif'
//     //     );
//     //     dd($filepath);
//     // return Response::download($filepath, 'Input Group.jpg');
//     return response(Storage::get($path), 200)->header('Content-Type', 'image/png/jfif');
    
// });


// Create, Read, Update, Delete Group
Route::get('/crm/getgroup', 'Crm\ClientGroupController@index');
Route::get('/crm/getgroups/{name?}', 'Crm\ClientGroupController@getGroupsByName');
Route::post('/crm/creategroup', 'Crm\ClientGroupController@create');
Route::post('/crm/updategroup', 'Crm\ClientGroupController@update');
Route::post('/crm/deletegroup', 'Crm\ClientGroupController@delete');



// Inventory module
$assets = Asset::all();
Route::view('/inventory/asset', 'inventory.invent-list', ['assets' => $assets])->name('inventory.assets');
Route::view('/inventory/viewcreateasset', 'inventory.invent-create')->name('inventory.asset.create');
Route::get('/inventory/editasset/{id}', function ($id) {
    $asset = Asset::find($id);
    return view('inventory.invent-edit', ['asset' => $asset]);
});
Route::get('/inventory/viewasset/{id}', function ($id) {
    $asset = Asset::find($id);
    $employee = $asset->employee;
    $attaches = explode(",", $asset->attachments);
    return view('inventory.invent-view', ['asset' => $asset, 'employee' => $employee, 'attaches' => $attaches]);
});

// Create Read Update Delete Asset
Route::get('/inventory/getasset', 'Inventory\AssetController@index');
Route::get('/inventory/getassets/{name?}', 'Inventory\AssetController@getAssetsByName');
Route::post('/inventory/createasset', 'Inventory\AssetController@create');
Route::post('/inventory/updateasset', 'Inventory\AssetController@update');
Route::post('/inventory/deleteasset', 'Inventory\AssetController@delete');

// Maintenance module
$maintenances = Maintenance::all();
Route::view('/inventory/maintenance', 'inventory.mainten-list', ['maintenances' => $maintenances])->name('inventory.maintens');
Route::view('/inventory/createmaintenance', 'inventory.mainten-create')->name('inventory.mainten-create');
Route::get('/inventory/editmainten/{id}', function ($id) {
    $maintenance = Maintenance::find($id);
    return view('inventory.mainten-edit', ['maintenance' => $maintenance]);
});
Route::get('/inventory/viewmainten/{id}', function ($id) {
    $maintenance = Maintenance::find($id);
    $reports = explode(",", $maintenance->reports);
    return view('inventory.mainten-view', ['maintenance' => $maintenance, 'reports' => $reports]);
});

// Create Read Update Delete Maintenance
Route::get('/inventory/getmainten', 'Inventory\MaintenanceController@index');
Route::post('/inventory/createmainten', 'Inventory\MaintenanceController@create')->name('mainten-create');
Route::post('/inventory/updatemainten', 'Inventory\MaintenanceController@update')->name('mainten-update');
Route::post('/inventory/deletemainten', 'Inventory\MaintenanceController@delete')->name('mainten-delete');


// HRM module routes
$employees = Employee::all();
Route::view('/human/employee', 'human.emp-list', ['employees' => $employees])->name('human.list');
Route::view('/human/create', 'human.emp-create')->name('human.create');

Route::get('/human/employees/{name?}', function($name=null) {
    if ($name) {
        $employees = Employee::where('full_name', 'LIKE', '%'.$name.'%')->get();
        return json_encode(['employees' => $employees]);
    } else {
        $employees = Employee::all();
        return json_encode(['employees' => $employees]);
    }
});


Route::get('/human/viewemployee/{id}', function($id) {
    $employee = Employee::find($id);
    $bank = $employee->bank;
    $attaches_photo =  $employee->personal_photo;
    $attaches_doc = explode(",", $employee->doc_copies);
    return view('human.emp-view')->with(['employee' => $employee, 'bank' => $bank, 'attaches_doc'=>$attaches_doc, 'attaches_photo' => $attaches_photo]);
});

Route::get('/human/editemployee/{id}', function ($id) {
    $employee = Employee::find($id);
    return view('human.emp-edit')->with(['employee' => $employee]);
});

Route::get('human/save/{id}',[
    'as' => 'human.download', 'uses' => 'Hrm\EmployeeController@downloadImage']);


// Route::get('human/down/{id}',[
//         'as' => 'human.downloadDocs', 'uses' => 'Hrm\EmployeeController@download']);

Route::post('human/down', 'ZipController@downloadZip')->name('human.zip');
    


Route::get('/human/getemployee', 'Hrm\EmployeeController@index');
Route::get('/human/getemployees/{name?}', 'Hrm\EmployeeController@getEmployeesByName');
Route::post('/human/createemployee', 'Hrm\EmployeeController@create')->name('human.employee-create');
Route::post('/human/updateemployee', 'Hrm\EmployeeController@update')->name('human.employee.update');
Route::post('/human/deleteemployee', 'Hrm\EmployeeController@delete')->name('human.employee.delete');



// Calendar module routes
Route::view('/calendar', 'calendar.calendar')->name('calendar');
Route::get('/calendar/events', 'Calendar\EventController@index');
Route::post('/calendar/events/create', 'Calendar\EventController@create');
Route::post('/calendar/events/update', 'Calendar\EventController@update');


// Reports module routes
Route::view('/reports/employee', 'reports.employee')->name('reports.employee');
Route::view('/reports/store', 'reports.store')->name('reports.store');
Route::view('/reports/purchasing', 'reports.purchasing')->name('reports.purchasing');
Route::view('/reports/joborder', 'reports.joborder')->name('reports.joborder');
Route::view('/reports/inventory', 'reports.inventory')->name('reports.inventory');
Route::view('/reports/lead', 'reports.lead')->name('reports.lead');
Route::view('/reports/receiving', 'reports.receiving')->name('reports.receiving');
Route::view('/reports/materials', 'reports.materials')->name('reports.materials');
Route::view('/reports/products', 'reports.products')->name('reports.products');
Route::view('/reports/client', 'reports.client')->name('reports.client');
Route::view('/reports/summary', 'reports.summary')->name('reports.summary');


// Sales module
// $leads = Lead::all();
// $sales = Sale::all();
$leads = Lead::where('status', '!=', 'Accepted')->Where('status', '!=', 'Declined')->Where('status', '!=', 'PAID')->get();
// json_decode($leads);
$sales = Sale::where('status', 'Accepted')->get();

$leadOpen = Lead::where('status','Open')->get();
$leadinProcess = Lead::where('status','Draft')->orWhere('status','Sent')->orWhere('status','Revised')->orWhere('status','Accepted')->orWhere('status','Open')->get();
$leadDeclined = Lead::where('status','Declined')->get();
$leadAccepted = Lead::where('status','Accepted')->get();

$SalesPaid = Lead::where('status','PAID')->get();
$Archives = Lead::where('status','Declined')->orWhere('status','PAID')->get();

Route::view('/sales', 'sales.lead-list',compact('leads', 'sales', 'leadOpen' ,'leadDeclined', 'leadinProcess', 'leadAccepted', 'SalesPaid' ,'Archives'))->name('sales.list');
// Route::view('/sales', 'sales.lead-list', ['leads' => $leads, 'leadOpen' => $leadOpen, 'leadinProcess'=>$leadinProcess,'leadDeclined'=>$leadDeclined, 'leadAccepted' => $leadAccepted])->name('sales.list');
Route::view('/sales/create', 'sales.lead-create')->name('sales.create');
Route::view('/sales/view', 'sales.lead-view')->name('sales.view');

// Create Update Delete lead of Sales
Route::post('/sales/leads', 'Sales\SalesController@create');
Route::get('/leads/{id}/edit','Sales\SalesController@edit' )->name('sales.lead-edit');
Route::PATCH('/leads/{id}','Sales\SalesController@update' )->name('sales.lead-update');
Route::post('/leads/approve', 'Sales\SalesController@approveLead');
Route::post('/sales/approve', 'Sales\SalesController@approveSale');
Route::delete('/leads/delete', 'Sales\SalesController@deleteLeads');
Route::delete('/sales/delete', 'Sales\SalesController@deleteSales');



// View lead details
Route::get('/viewing/leads/detail/{id}', function($id) {
    $LD= Lead::find($id);
    $cominfo = CompnayInfo::all()->first();
    $prefix = Prefix::find(1);
    $InvidFormats = $LD->id;
    switch (strlen(strval($InvidFormats))) {
        case 1:
            $InvidFormats = '000'.$LD->id;
            break;
        case 2:
            $InvidFormats = '00'.$LD->id;
            break;
        case 3:
            $InvidFormats = '0'.$LD->id;
            break;
        default:
            $InvidFormats = $LD->id;
            break;
    }
    return view('sales.lead-details', compact('LD', 'cominfo', 'prefix', 'InvidFormats'));
})->name('sales.lead-details');




// EDIT Info related to lead products in EditSales.js
Route::get('/leads/edit/{id}', function($id) {
    $EditLeadDetails = Lead::find($id);
    return json_encode(['Editproducts' => $EditLeadDetails->products]);
});

// EDIT Info related to leads in EditSales.js
Route::get('/leads/edits/{id}', function($id) {
    $EditLeadInfo = Lead::find($id);
    return json_encode(['EditLeadInfo' => $EditLeadInfo]);
});


// Products module
$products = Product::all();
$materials = Material::all();
$leads = Lead::all();
// Testing
Route::get('/lead/{id}/products', function(){
    $leads = Lead::find(1);
    foreach ($leads->products as $product)
    {
        echo $product->pivot->prod_name ."\n";
    }
});
Route::view('/products/products', 'products.prod-list', ['products' => $products])->name('products.prod-list');
Route::view('/products/product/create', 'products.prod-create')->name('products.prod-create');
Route::view('/products/viewcreateProduct', 'products.material-create')->name('products.material.create');
Route::get('/product/products/{name?}', function ($name=null) {
    if ($name) {
        $subProds = Product::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode(['products' => $subProds]);
    } else {
        $prods = Product::all();
        return json_encode(['products' => $prods]);
    }
});
// Route::get('/product/Editproducts', function() {
//         $eprods = Product::all();

//         return json_encode(['Editproducts' => $eprods]);
    
// });
Route::get('/products/product/edit/{id}', function ($id) {
    $product = Product::find($id);
    return view('products.prod-edit')->with(['product' => $product]);
});
Route::get('/products/viewProducts/{id}', function ($id) {
    $product = Product::find($id);
    $materials = $product->materials;
    $attaches = explode(",", $product->photos);
    return view('products.product-view', ['product' => $product, 'attaches' => $attaches, 'materials' => $materials ]);
});

// Create, Read, Update, Delete Product
Route::get('/products/product', 'Products\ProductController@index');
Route::post('/products/product/create', 'Products\ProductController@create');
Route::post('/products/product/update', 'Products\ProductController@update');
Route::post('/products/product/delete', 'Products\ProductController@delete');

Route::view('/products/materials', 'products.mat-list', ['materials' => $materials])->name('products.mat-list');

// Create, Read, Update, Delete Material
Route::get('/products/material', 'Products\MaterialController@index');
Route::get('/products/get-material/{name?}', function ($name=null) {
    if ($name) {
        $materials = Material::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode(['materials' => $materials]);
    } else {
        $materials = Material::all();
        return json_encode(['materials' => $materials]);
    }
});
Route::post('/products/material/create', 'Products\MaterialController@create');
Route::post('/products/material/update', 'Products\MaterialController@update');
Route::post('/products/material/delete', 'Products\MaterialController@delete');

// Purchasing management module
$prePur = PurchasingOrder::where('status', '=', 'Not yet')->get();
$processPur = PurchasingOrder::where('status', '=', 'In Process')->get();
$donePur = PurchasingOrder::where('status', '=', 'Completed')->get();

Route::view('/purchasing', 'purchasing.purchasing', [
    'prePur' => $prePur,
    'processPur' => $processPur,
    'donePur' => $donePur,
])->name('purchasing');

Route::view('/purchasing-jo/create', 'purchasing.purchasing-jo')->name('purchasing-jo');
Route::get('/purchasing/detail/{id}', function($id) {
    $purdetail = PurchasingOrder::find($id);
    $prefix = Prefix::find(1);
    $cominfo = CompnayInfo::all()->first();
    $idFormat = $purdetail->id;
    switch (strlen(strval($idFormat))) {
        case 1:
            $idFormat = '000'.$purdetail->id;
            break;
        case 2:
            $idFormat = '00'.$purdetail->id;
            break;
        case 3:
            $idFormat = '0'.$purdetail->id;
            break;
        default:
            $idFormat = $purdetail->id;
            break;
    }
    $attaches = explode(",", $purdetail->documents);
    // dd($attaches);
    return view('purchasing.purchasing-detail', compact('purdetail', 'attaches', 'prefix', 'idFormat', 'cominfo'));
})->name('purchasing.detail');

Route::get('/purchasing/edit/{id}', function ($id) {
    $puredit = PurchasingOrder::find($id);
    $prefix = Prefix::find(1);
    $idFormat = $puredit->id;
    switch (strlen(strval($idFormat))) {
        case 1:
            $idFormat = '000'.$puredit->id;
            break;
        case 2:
            $idFormat = '00'.$puredit->id;
            break;
        case 3:
            $idFormat = '0'.$puredit->id;
            break;
        default:
            $idFormat = $puredit->id;
            break;
    }
    return view('purchasing.purchasing-edit')->with(['puredit' => $puredit, 'prefix' => $prefix, 'formatId' => $idFormat]);
})->name('purchasing.edit');

Route::post('/purchasing/job-order', 'Purchasing\PurchasingController@create');
Route::put('/purchasing/job-order', 'Purchasing\PurchasingController@update');
Route::delete('/purchasing/job-order', 'Purchasing\PurchasingController@delete');

Route::post('/purchasing/job-order/approve', 'Purchasing\PurchasingController@approve');
Route::post('/purchasing/job-order/complete', 'Purchasing\PurchasingController@complete');

// Receiving management module
$jobOrders = JobOrder::all();
$preJobs = JobOrder::where('status', '=', 'Not yet')->get();
$processJobs = JobOrder::where('status', '=', 'In Process')->get();
$doneJobs = JobOrder::where('status', '=', 'Completed')->get();

Route::view('/receiving', 'receiving.receiving', [
    'preJobs' => $preJobs,
    'processJobs' => $processJobs,
    'doneJobs' => $doneJobs
])->name('receiving');

Route::view('/receiving/job-order/create', 'receiving.jo-create')
    ->name('receiving.jo-create');

Route::get('/receiving/job-order/detail/{id}', function($id) {
    $jobOrder = JobOrder::find($id);
    $cominfo = CompnayInfo::all()->first();
    $prefix = Prefix::find(1);
    $idFormat = $jobOrder->id;
    switch (strlen(strval($idFormat))) {
        case 1:
            $idFormat = '000'.$jobOrder->id;
            break;
        case 2:
            $idFormat = '00'.$jobOrder->id;
            break;
        case 3:
            $idFormat = '0'.$jobOrder->id;
            break;
        default:
            $idFormat = $jobOrder->id;
            break;
    }
    $attaches = explode(",", $jobOrder->documents);
    // dd($attaches);
    return view('receiving.jo-detail', compact('jobOrder', 'attaches', 'prefix', 'idFormat', 'cominfo'));
})->name('receiving.jo-detail');

Route::get('/receiving/job-order/edit/{id}', function ($id) {
    $jobOrder = JobOrder::find($id);
    $prefix = Prefix::find(1);
    $idFormat = $jobOrder->id;
    switch (strlen(strval($idFormat))) {
        case 1:
            $idFormat = '000'.$jobOrder->id;
            break;
        case 2:
            $idFormat = '00'.$jobOrder->id;
            break;
        case 3:
            $idFormat = '0'.$jobOrder->id;
            break;
        default:
            $idFormat = $jobOrder->id;
            break;
    }
    return view('receiving.jo-edit')->with(['jo' => $jobOrder, 'prefix' => $prefix, 'formatId' => $idFormat]);
})->name('receiving.jo-edit');

Route::post('/receiving/job-order', 'Receiving\JobOrderController@create');
Route::put('/receiving/job-order', 'Receiving\JobOrderController@update');
Route::delete('/receiving/job-order/delete', 'Receiving\JobOrderController@delete');

Route::post('/receiving/job-order/approve', 'Receiving\JobOrderController@approve');
Route::post('/receiving/job-order/complete', 'Receiving\JobOrderController@complete');


// Job Order management module
$AllOrders = AllOrder::all();
$AllPurchasingOrders = AllOrder::where('related', '=', 'Purchasing')->get();
$AllSalesOrders = AllOrder::where('related', '=', 'Sales')->get();
$AllReceivingOrders = AllOrder::where('related', '=', 'Receiving')->get();
// dd($AllOrders);
// // dd($AllPurchaseOrders[0]['P_id']);
// // dd($AllPurchaseOrders);
// $arr = [];
// for ($x = 0; $x < count($AllPurchaseOrders); $x++) {
//     array_push($arr, $AllPurchaseOrders[$x]['P_id']);
//   }
//   foreach ($arr as $key=>$val) {
//     if ($val === null)
//        unset($arr[$key]);
// }
// $new_arr = array_values($arr);
// //   dd($new_arr);
// $PurchaseOrders = PurchasingOrder::whereIn('id',  $arr )->get();
// dd($PurchaseOrders);
Route::view('/joborder/dash', 'joborder.dash')->name('joborder.dash');
Route::view('/joborder/Alljoborders', 'joborder.joborder', ['AllOrders' => $AllOrders, 'AllPurchasingOrders' => $AllPurchasingOrders, 'AllSalesOrders' => $AllSalesOrders, 'AllReceivingOrders' => $AllReceivingOrders ])->name('joborder.joborder');
Route::get('/joborder/detail/{id}', function($id) {
    $FindAllOrder = AllOrder::find($id);
    // dd($FindAllOrder['related']);

    if ( $FindAllOrder['related'] == "Purchasing" ) {
        $Findpurdetail = PurchasingOrder::find($FindAllOrder['P_id']);
        // work is a helper function in app/http/Helpers.php
        $get = work($Findpurdetail);
        $idFormat = $get['idFormat'];
        $attaches = $get['attaches'];
    } 
    if ( $FindAllOrder['related'] == "Receiving" ) {
        $Findrecdetail = JobOrder::find($FindAllOrder['R_id']);
        $get = work($Findrecdetail);
        $idFormat = $get['idFormat'];
        $attaches = $get['attaches'];
    }
    if ( $FindAllOrder['related'] == "Sales" ) {
        $Findleaddetail = Lead::find($FindAllOrder['L_id']);
        $get = work($Findleaddetail);
        $idFormat = $get['idFormat'];
        $attaches = $get['attaches'];
    }
   
    $prefix = Prefix::find(1);
    $cominfo = CompnayInfo::all()->first();

    return view('joborder.joborder-detail', compact('Findpurdetail', 'Findrecdetail', 'Findleaddetail', 'FindAllOrder', 'attaches', 'prefix', 'idFormat', 'cominfo'));
})->name('joborder.detail');

Route::get('/joborder/purchasing/detail/{id}', function($id) {
    // dd($id);
    $FindAllOrderPur = AllOrder::where('P_id', '=', $id)->get()->pluck('Job_id');
    // dd($FindAllOrderPur[0] );
    $purOrder = PurchasingOrder::find($id);
    $cominfo = CompnayInfo::all()->first();
    $prefix = Prefix::find(1);
    $get = work($purOrder);
    $idFormat = $get['idFormat'];
    $attaches = $get['attaches'];

    return view('joborder.purchasing-joborder-detail', compact('purOrder', 'FindAllOrderPur', 'attaches', 'prefix', 'idFormat', 'cominfo'));
})->name('joborder.purchasing-joborder-detail');


Route::get('joborder/sales/detail/{id}', function($id) {
    // dd($id);
    $FindAllOrderSal = AllOrder::where('L_id', '=', $id)->get()->pluck('Job_id');
    $salesOrder = Lead::find($id);
    $cominfo = CompnayInfo::all()->first();
    $prefix = Prefix::find(1);
    $get = work($salesOrder);
    $idFormat = $get['idFormat'];
    $attaches = $get['attaches'];

    return view('joborder.sales-joborder-detail', compact('salesOrder', 'FindAllOrderSal', 'attaches', 'prefix', 'idFormat', 'cominfo'));
})->name('joborder.sales-joborder-detail');


Route::get('joborder/receiving/detail/{id}', function($id) {
    $FindAllOrderRec = AllOrder::where('R_id', '=', $id)->get()->pluck('Job_id');
    $receiveOrder = JobOrder::find($id);
    $cominfo = CompnayInfo::all()->first();
    $prefix = Prefix::find(1);
    $get = work($receiveOrder);
    $idFormat = $get['idFormat'];
    $attaches = $get['attaches'];

    return view('joborder.receive-joborder-detail', compact('receiveOrder', 'attaches', 'FindAllOrderRec', 'prefix', 'idFormat', 'cominfo'));
})->name('joborder.receive-joborder-detail');



// Accounting module
Route::view('/account/dash', 'account.dash')->name('account.dash');
Route::view('/account/account', 'account.account')->name('account.account');
Route::view('/account/banks', 'account.banks')->name('account.banks');
Route::view('/account/transactions', 'account.transactions')->name('account.transactions');


// Settings module routes
// $companyinfo = CompnayInfo::where('user_id', '=',auth()->user()->id)->pluck('name');
// $payments = PaymentMethod::all();
// $prodCategories = ProductCategory::all();
// $taskCategories = TaskCategory::all();
// $itemCategories = ItemCategory::all();
// $departments = Department::all();
// $banks = Bank::all();

// Route::view('/setting', 'setting.setting', ['payments' => $payments, 'prodCategories' => $prodCategories,
//     'taskCategories' => $taskCategories, 'itemCategories' => $itemCategories, 'departments' => $departments, 'banks' => $banks])->name('setting');

// Create Read Company Information
Route::get('/setting', 'Setting\CompanyInformationController@index')->name('setting');
Route::post('/setting/companyinforamtion', 'Setting\CompanyInformationController@create')->name('setting.companyinformation-create');
Route::PATCH('/setting/companyinformation-update/{id}', 'Setting\CompanyInformationController@update')->name('setting.companyinformation-update');

// Create Read Prefixes
Route::get('/setting/prefix', 'Setting\PrefixController@index')->name('setting.prefix-get');
Route::post('/setting/prefix', 'Setting\PrefixController@create')->name('setting.prefix-create');
Route::PATCH('/setting/prefix-update/{id}', 'Setting\PrefixController@update')->name('setting.prefix-update');

// Create Read Sms
Route::get('/setting/sms', 'Setting\SMSController@index')->name('setting.sms-get');
Route::post('/setting/sms', 'Setting\SMSController@create')->name('setting.sms-create');

// Create Read Update Delete Payment Method
Route::get('/setting/getpayment', 'Setting\PaymentMethodController@index');
Route::post('/setting/createpayment', 'Setting\PaymentMethodController@create');
Route::post('/setting/updatepayment', 'Setting\PaymentMethodController@update');
Route::post('/setting/deletepayment', 'Setting\PaymentMethodController@delete');

// Create Read Update Delete Product Category
Route::get('/setting/getprodcategory', 'Setting\ProductCategoryController@index');
Route::get('/setting/products/{name?}', function ($name=null) {
    if (isset($name)) {
        $categories = ProductCategory::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode(['status' => 'success', 'categories' => $categories]);
    } else {
        $categories = ProductCategory::all();
        return json_encode(['status' => 'success', 'categories' => $categories]);
    }
});
Route::post('/setting/createprodcategory', 'Setting\ProductCategoryController@create');
Route::post('/setting/updateprodcategory', 'Setting\ProductCategoryController@update');
Route::post('/setting/deleteprodcategory', 'Setting\ProductCategoryController@delete');

// Create Read Update Delete Task Category
Route::get('/setting/gettaskcategory', 'Setting\TaskCategoryController@index');
Route::post('/setting/createtaskcategory', 'Setting\TaskCategoryController@create');
Route::post('/setting/updatetaskcategory', 'Setting\TaskCategoryController@update');
Route::post('/setting/deletetaskcategory', 'Setting\TaskCategoryController@delete');

// Create Read Update Delete Item Category
Route::get('/setting/getitemcategory', 'Setting\ItemCategoryController@index');
Route::post('/setting/createitemcategory', 'Setting\ItemCategoryController@create');
Route::post('/setting/updateitemcategory', 'Setting\ItemCategoryController@update');
Route::post('/setting/deleteitemcategory', 'Setting\ItemCategoryController@delete');

// Create Read Update Delete Department
Route::get('/setting/getdepartment', 'Setting\DepartmentController@index');
Route::get('/setting/getdepartments/{name?}', 'Setting\DepartmentController@getDepartmentsByName');
Route::post('/setting/createdepartment', 'Setting\DepartmentController@create');
Route::post('/setting/updatedepartment', 'Setting\DepartmentController@update');
Route::post('/setting/deletedepartment', 'Setting\DepartmentController@delete');

// Create Read Update Delete Bank
Route::get('/setting/getbank', 'Setting\BankController@index');
Route::get('/setting/getbanks/{name?}', 'Setting\BankController@getBanksByName');
Route::post('/setting/createbank', 'Setting\BankController@create');
Route::post('/setting/updatebank', 'Setting\BankController@update');
Route::post('/setting/deletebank', 'Setting\BankController@delete');
