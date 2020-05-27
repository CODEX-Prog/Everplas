<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Psy\Util\Json;
use App\Models\Company;
use App\Traits\UploadTrait;

class CompanyController extends Controller
{

    use UploadTrait;

    /**
     * Get a Company.
     *
     * @return Company
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $company = Company::find($id);
            return json_encode(['status' => 'success', 'company' => $company]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get Companies by name.
     *
     * @return array of Company
     */
    public function getCompaniesByName($name=null, Request $request) {
        if(isset($name)) {
            $companies = Company::where('company_name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'companies' =>$companies, 'name' => $name]);
        } else {
            $companies = Company::all();
            return json_encode(['status' => 'success', 'companies' =>$companies]);
        }
    }

    /**
     * Create a new Company.
     *
     * @return Company
     */
    public function create(Request $request) {
     
        $name = $request->get('company_name');
        $telephone = $request->get('telephone');
        $website = $request->get('website');
        $address = $request->get('address');
        $country = $request->get('country');
        $vatNumber = $request->get('vat');
        $fax = $request->get('fax');
        $groupId = $request->get('group-id');
        $city = $request->get('city');
        $email = $request->get('email');
  

        if($request->has('company-logo')) {
            request()->validate([  
                'company-logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $logo = $request->file('company-logo');
            $filename = Str::slug($request->input('company-name')) . '_' . time();
            $folder = '/uploads/crm/company-logo/';
            $filePath = $folder . $filename . '.' . $logo->getClientOriginalExtension();
            $this->uploadOne($logo, $folder, 'public', $filename);
        } 

        $company = new Company();
        $company->company_name = $name;
        $company->telephone = $telephone;
        $company->created_by = Auth::user()->full_name;
        $company->updated_by = Auth::user()->full_name;
        $company->vat_number = $vatNumber;
        $company->fax = $fax;
        $company->website = $website;
        $company->group_id = $groupId;
        $company->address = $address;
        $company->city = $city;
        $company->country = $country;
        $company->Email = $email;
        $company->company_card = $filePath;

        try {
            $company->save();
            return json_encode(['status' => 'success', 'company' => $company, 'contacts' => count($company->contacts)]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

    /**
     * Update a Company.
     *
     * @return Json
     */
    public function update(Request $request) {
        // dd($request);
        $id = $request->get('id');
        $name = $request->get('company_name');
        $telephone = $request->get('telephone');
        $website = $request->get('website');
        $address = $request->get('address');
        $country = $request->get('country');
        $vatNumber = $request->get('vat_number');
        $fax = $request->get('fax');
        $groupId = $request->get('group_id');
        $city = $request->get('city');
        $email = $request->get('email');

        if($request->has('company-logo')) {
            request()->validate([  
                'company-logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $logo = $request->file('company-logo');
            $filename = Str::slug($request->input('company_name')) . '_' . time();
            $folder = '/uploads/crm/company-logo/';
            $filePath = $folder . $filename . '.' . $logo->getClientOriginalExtension();
            $this->uploadOne($logo, $folder, 'public', $filename);
            $company->company_card = $filePath ;
        }

        $company = Company::find($id);
        $company->company_name = $name;
        $company->telephone = $telephone;
        $company->updated_by = Auth::user()->full_name;
        $company->vat_number = $vatNumber;
        $company->fax = $fax;
        $company->website = $website;
        $company->group_id = $groupId;
        $company->address = $address;
        $company->city = $city;
        $company->country = $country;
        $company->Email = $email;
      

        try {
            $company->save();
            session()->flash('flash_message', 'Successfully updated!');
            return redirect()->route('crm.company');
            // return json_encode(['status' => 'success', 'company' => $company]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Company.
     *
     * @return Json
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $company = Company::find($id);
        try {
            $company->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
