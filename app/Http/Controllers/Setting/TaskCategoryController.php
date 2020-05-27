<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaskCategory;

class TaskCategoryController extends Controller
{
    /**
     * Get a Group.
     *
     * @return TaskCategory
     */
    public function index(Request $request) {
        $id = $request->get('id');
        try {
            $taskCategory = TaskCategory::find($id);
            return json_encode(['status' => 'success', 'taskCategory' => $taskCategory]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Group.
     *
     * @return TaskCategory
     */
    public function create(Request $request) {
        $name = $request->get('name');
        $taskCategory = new TaskCategory();
        $taskCategory->name = $name;
        try {
            $taskCategory->save();
            return json_encode(['status' => 'success', 'taskCategory' => $taskCategory]);
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
        $taskCategory = TaskCategory::find($id);
        $taskCategory->name = $name;
        try {
            $taskCategory->save();
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

        $taskCategory = TaskCategory::find($id);
        try {
            $taskCategory->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
