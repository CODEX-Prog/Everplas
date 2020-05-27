<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompnayInfo;
use App\Models\PaymentMethod;
use App\Models\TaskCategory;
use App\Models\ProductCategory;
use App\Models\ItemCategory;
use App\Models\Department;
use App\Models\Bank;
use App\Models\Prefix;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class CompanyInformationController extends Controller
{
    use UploadTrait;

    /**
     * Get a CompanyInformation.
     *
     * @return CompnayInfo
     */
    public function index() {

        // $id = $request->get('id');
        $payments = PaymentMethod::all();
        $prodCategories = ProductCategory::all();
        $taskCategories = TaskCategory::all();
        $itemCategories = ItemCategory::all();
        $departments = Department::all();
        $banks = Bank::all();
      
            // $companyinfo = CompnayInfo::where('user_id', '=', auth()->user()->id)->select('id', 'name', 'address', 'telephone', 'fax', 'logo', 'email', 'website', 'vat_number', 'created_at', 'updated_at', 'user_id')->get();
            // dd( $companyinfo );
            $companyinfo = CompnayInfo::all()->first();
            $prefix = Prefix::all()->first();
         
     return view('setting.setting', compact('companyinfo', 'payments', 'prodCategories', 'taskCategories', 'itemCategories', 'departments', 'banks', 'prefix'));

    }

    /**
     * Create a CompanyInformation.
     *
     * @return CompnayInfo
     */
    public function create(Request $request) {
        request()->validate([
            'company-logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company = new CompnayInfo();
        $name = $request->input('company-name');
        $telephone = $request->input('company-telephone');
        $email = $request->input('company-email');
        $vatNumber = $request->input('vat-number');
        $address = $request->input('company-addr');
        $fax = $request->input('company-fax');
        $website = $request->input('company-website');

        $company->name = $name;
        $company->telephone = $telephone;
        $company->address = $address;
        $company->fax = $fax;
        $company->email = $email;
        $company->website = $website;
        $company->vat_number = $vatNumber;

        if($request->has('company-logo')) {
            $logo = $request->file('company-logo');
            $name = Str::slug($request->input('company-name')).'_'.time();
            $folder = '/uploads/setting/comp-logo/';
            $filePath = $folder . $name. '.' . $logo->getClientOriginalExtension();
            $company->logo = $filePath;
            $this->uploadOne($logo, $folder, 'public', $name);
        }

        // $company->user_id = auth()->user()->id;
        $company->save();

        return redirect('/dashboard');
    }




    /**
     * Update a CompanyInformation.
     *
     * @return CompnayInfo
     */
    public function update(Request $request, $id) {
    
       request()->validate([
        'company-name' => 'required',
        'company-telephone' => 'required',
        'company-email' => 'required|email',
        'vat-number' => 'required',
        'company-addr' => 'required',
        'company-website' => 'required|url',
        'company-logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

    //   dd($data);


        $company =  CompnayInfo::find($id);
        $name = $request->get('company-name');
        $telephone = $request->get('company-telephone');
        $email = $request->get('company-email');
        $vatNumber = $request->get('vat-number');
        $address = $request->get('company-addr');
        $fax = $request->get('company-fax');
        $website = $request->get('company-website');

        $company->name = $name;
        $company->telephone = $telephone;
        $company->address = $address;
        $company->fax = $fax;
        $company->email = $email;
        $company->website = $website;
        $company->vat_number = $vatNumber;

        if($request->has('company-logo')) {
            $logo = $request->file('company-logo');
            $name = Str::slug($request->get('company-name')).'_'.time();
            $folder = '/uploads/setting/comp-logo/';
            $filePath = $folder . $name. '.' . $logo->getClientOriginalExtension();
            $company->logo = $filePath;
            $this->uploadOne($logo, $folder, 'public', $name);
        }

        // $company->user_id = auth()->user()->id;
        $company->save();

        return redirect('/dashboard');
    }
}
