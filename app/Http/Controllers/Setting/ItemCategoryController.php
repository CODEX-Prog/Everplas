<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemCategory;

class ItemCategoryController extends Controller
{
    /**
     * Get a Group.
     *
     * @return ItemCategory
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $itemCategory = ItemCategory::find($id);
            return json_encode(['status' => 'success', 'itemCategory' => $itemCategory]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Group.
     *
     * @return ItemCategory
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $itemCategory = new ItemCategory();
        $itemCategory->name = $name;
        try {
            $itemCategory->save();
            return json_encode(['status' => 'success', 'itemCategory' => $itemCategory]);
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
        $itemCategory = ItemCategory::find($id);
        $itemCategory->name = $name;
        try {
            $itemCategory->save();
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
        $itemCategory = ItemCategory::find($id);
        try {
            $itemCategory->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
