<?php

namespace App\Http\Controllers\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Psy\Util\Json;
use App\Models\Contact;
use App\Traits\UploadTrait;

class ContactController extends Controller
{

    use UploadTrait;

    /**
     * Get a Contact.
     *
     * @return Contact
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $contact = Contact::find($id);
            return json_encode(['status' => 'success', 'contact' => $contact]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Get Contacts by name.
     *
     * @return array of  Contact
     */
    public function getContactsByName($name=null, Request $request) {
        if(isset($name)) {
            $contacts = Contact::where('full_name', 'LIKE', '%'.$name.'%')->get();
            return json_encode(['status' => 'success', 'contacts' => $contacts, 'name' => $name]);
        } else {
            $contacts = Contact::all();
            return json_encode(['status' => 'success', 'contacts' => $contacts]);
        }
    }

    /**
     * Create a new Contact.
     *
     * @return Contact
     */
    public function create(Request $request) {
        $contactName = $request->get('contact-name');
        $contactEmail = $request->get('email');
        $contactTelephone = $request->get('telephone');
        $contactMobile2 = $request->get('mobile2');
        $contactMobile = $request->get('mobile');
        $companyId = $request->get('company-id');
        $contactJob = $request->get('job-title');
        $contactCountry = $request->get('country');
        $contactCity = $request->get('city');
        $contactAddress = $request->get('address');
        $groupId = $request->get('group-id');

        if($request->has('create-contact-card')) {
            $logo = $request->file('create-contact-card');
            $filename = Str::slug($request->input('contact-name')).'_'.time();
            $folder = '/uploads/crm/contact-card/';
            $filePath = $folder.$filename.'.'.$logo->getClientOriginalExtension();
            $this->uploadOne($logo, $folder, 'public', $filename);
        }

        $contact = new Contact();
        $contact->contact_name = $contactName;
        $contact->contact_email = $contactEmail;
        $contact->contact_telephone = $contactTelephone;
        $contact->contact_mobile = $contactMobile;
        $contact->contact_mobile2 = $contactMobile2;
        $contact->group_id = $groupId;
        $contact->company_id = $companyId;
        $contact->contact_job = $contactJob;
        $contact->contact_country = $contactCountry;
        $contact->contact_city= $contactCity;
        $contact->contact_address = $contactAddress;
        $contact->contact_business_card = $filePath;
        $contact->created_by = Auth::user()->full_name;
        $contact->updated_by = Auth::user()->full_name;

        try {
            $contact->save();
            return json_encode(['status' => 'success', 'contact' => $contact]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Contact.
     *
     * @return Json
     */
    public function update(Request $request) {
        
        $id = $request->get('id');
        $contactName = $request->get('edit-contact-name');
        $contactEmail = $request->get('edit-email');
        $contactTelephone = $request->get('edit-telephone');
        $contactMobile2 = $request->get('edit-mobile2');
        $contactMobile = $request->get('edit-mobile');
        $companyId = $request->get('edit-company-id');
        $contactJob = $request->get('edit-job-title');
        $contactCountry = $request->get('edit-country');
        $contactCity = $request->get('edit-city');
        $contactAddress = $request->get('edit-address');
        $groupId = $request->get('edit-group-id');

        if($request->has('edit-contact-card')) {
            $logo = $request->file('edit-contact-card');
            $filename = Str::slug($request->input('edit-contact-name')).'_'.time();
            $folder = '/uploads/crm/contact-card/';
            $filePath = $folder.$filename.'.'.$logo->getClientOriginalExtension();
            $this->uploadOne($logo, $folder, 'public', $filename);
        }

       $contact = Contact::find($id);
       $contact->contact_name = $contactName;
       $contact->contact_email = $contactEmail;
       $contact->contact_telephone = $contactTelephone;
       $contact->contact_mobile = $contactMobile;
       $contact->contact_mobile2 = $contactMobile2;
       $contact->group_id = $groupId;
       $contact->company_id = $companyId;
       $contact->contact_job = $contactJob;
       $contact->contact_country = $contactCountry;
       $contact->contact_city= $contactCity;
       $contact->contact_address = $contactAddress;
       $contact->contact_business_card = $filePath;
       $contact->updated_by = Auth::user()->full_name;

       try {
           $contact->save();
           session()->flash('flash_message', 'Successfully updated!');
           return redirect()->route('crm.contact');
        //    return json_encode(['status' => 'success', 'contact' => $contact]);
       } catch (\Exception $e) {
           return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
       }
    }

    /**
     * Delete a Contact.
     *
     * @return Json
     */
    public function delete(Request $request) {
        
        $id = $request->get('id');

        $contact = Contact::find($id);
        try {
            $contact->delete();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
