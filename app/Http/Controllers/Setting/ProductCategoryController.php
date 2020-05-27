<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Get a Group.
     *
     * @return ProductCategory
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $productCategory = ProductCategory::find($id);
            return json_encode(['status' => 'success', 'productCategory' => $productCategory]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Group.
     *
     * @return ProductCategory
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $productCategory = new ProductCategory();
        $productCategory->name = $name;
        try {
            $productCategory->save();
            return json_encode(['status' => 'success', 'productCategory' => $productCategory]);
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
        $name = $request->get('name');
        $id = $request->get('id');
        $productCategory = ProductCategory::find($id);
        $productCategory->name = $name;
        try {
            $productCategory->save();
            return json_encode(['status' => 'success']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a Group.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');

        $productCategory = ProductCategory::find($id);
        try {
            $productCategory->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
