<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialProduct;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Get a Group.
     *
     * @return Material
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $material = Material::find($id);
            return json_encode(['status' => 'success', 'material' => $material]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Group.
     *
     * @return Material
     */
    public function create(Request $request) {
        $material = new Material();
        $material_product = new MaterialProduct;
        $name = $request->get('matName');
        $code = $request->get('matCode');
        $material->name = $name;
        $material->code = $code;
        $material->created_by = Auth::user()->full_name;
        $material->updated_by = Auth::user()->full_name;
        $vendorId = $request->get('vendorId');
        if (substr($vendorId, 0, 3) === "com") {
            $companyId = (int)(substr($vendorId, 3, 1));
            $material->company_id = $companyId;
        } else {
            $contactId = (int)(substr($vendorId, 3, 1));
            $material->contact_id = $contactId;
        }
        try {
            $material->save();
            if (substr($vendorId, 0, 3) === "com") {
                return json_encode(['status' => 'success', 'material' => $material, 'supplier' => $material->company->company_name]);
            } else {
                return json_encode(['status' => 'success', 'material' => $material, 'supplier' => $material->contact->contact_name]);
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update a Group.
     *
     * @return string
     */
    public function update(Request $request) {
        $id = $request->get('id');
        $material = Material::find($id);
        $material->name = $request->get('matName');
        $material->code = $request->get('matCode');
        $material->updated_by = Auth::user()->full_name;
        $vendorId = $request->get('vendorId');
        if (substr($vendorId, 0, 3) === "com") {
            $companyId = (int)(substr($vendorId, 3, 1));
            $material->company_id = $companyId;
        } else {
            $contactId = (int)(substr($vendorId, 3, 1));
            $material->contact_id = $contactId;
        }
        try {
            $material->save();
            if (substr($vendorId, 0, 3) === "com") {
                return json_encode(['status' => 'success', 'material' => $material, 'supplier' => $material->company->company_name]);
            } else {
                return json_encode(['status' => 'success', 'material' => $material, 'supplier' => $material->contact->contact_name]);
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Material.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $material = Material::find($id);
        try {
            $material->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
