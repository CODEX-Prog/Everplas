<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Traits\UploadTrait;
use App\Models\Product;
use App\Models\Prefix;



class ProductController extends Controller
{

    use UploadTrait;

    /**
     * Create a Group.
     *
     * @param Request $request
     *
     * @return Product
     */
    public function create(Request $request) {
        $product = new Product();

        $name = $request->input('name');
        $color = $request->input('color');
        $weight = $request->input('weight');
        $thickness = $request->input('thickness');
        $ending = $request->input('ending');
        $wtSize = $request->input('wt-size');
        $categoryId = $request->input('category-id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $code = $request->input('code');
        $vendorId = $request->input('vendor-id');
        $length = $request->input('length');
        $issue = $request->input('code').'-'.date('Ymd');
        $status = $request->input('status');
        $size = $request->input('size');

        $product->name = $name;
        $product->prefix_id = Prefix::find(1)->po;
        $product->code = $code;
        $product->weight = $weight || 'Unknown KG';
        $product->color = $color;
        $product->thickness = $thickness;
        $product->length = $length;
        $product->wt_size = $wtSize;
        $product->ending = $ending;
        $product->category_id = $categoryId;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->created_by = Auth::user()->full_name;
        $product->updated_by = Auth::user()->full_name;
        $product->issue = $issue;
        $product->status = $status;
        $product->size = $size;

        if($request->has('photos')) {
            $i = 0;
            $photoPath = '';
            $photos = $request->file('photos');
            foreach ($photos as $photo) {
                $filename = Str::slug($request->input('name')).'_'.'photos'.'_'.$i.'_'.time();
                $folder = '/uploads/products/photos/';
                $filePath = $folder . $filename. '.' . $photo->getClientOriginalExtension();
                $photoPath = $photoPath.','.$filePath;
                $this->uploadOne($photo, $folder, 'public', $filename);
                $i++;
            }
            $product->photos = $photoPath;
        }

        try {
            $product->save();
            $product->materials()->attach($vendorId);
            return redirect('/products/products');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Update a Group.
     *
     * @return Product
     */
    public function update(Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $color = $request->input('color');
        $weight = $request->input('weight');
        $thickness = $request->input('thickness');
        $ending = $request->input('ending');
        $wtSize = $request->input('wt-size');
        $categoryId = $request->input('category-id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $code = $request->input('code');
        $vendorId = $request->input('vendor-id');
        $length = $request->input('length');
        $issue = $request->input('code').'-'.date('Ymd');
        $status = $request->input('status');
        $size = $request->input('size');

        $product = Product::find($id);
        $product->name = $name;
        $product->code = $code;
        $product->weight = $weight || 'Unknown KG';
        $product->color = $color;
        $product->thickness = $thickness;
        $product->length = $length;
        $product->wt_size = $wtSize;
        $product->ending = $ending;
        $product->category_id = $categoryId;
        $product->price = $price;
        $product->quantity = $quantity;
        $product->updated_by = Auth::user()->full_name;
        $product->issue = $issue;
        $product->status = $status;
        $product->size = $size;

        if($request->has('photos')) {
            $i = 0;
            $photoPath = '';
            $photos = $request->file('photos');
            foreach ($photos as $photo) {
                $filename = Str::slug($request->input('name')).'_'.'photos'.'_'.$i.'_'.time();
                $folder = '/uploads/products/photos/';
                $filePath = $folder . $filename. '.' . $photo->getClientOriginalExtension();
                $photoPath = $photoPath.','.$filePath;
                $this->uploadOne($photo, $folder, 'public', $filename);
                $i++;
            }
            $product->photos = $photoPath;
        }
        $product->materials()->detach();
        try {
            $product->save();
            $product->materials()->attach($vendorId);
            return redirect('/products/products');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Delete a Group.
     *
     * @return string
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        $product = Product::find($id);
        $product->materials()->detach();
        try {
            $product->delete();
            return json_encode(['status' => 'success']);
        } catch(\Exception $e) {
            return json_encode((['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
}
