<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $menu = Menu::all(); //
        $products = Products::all();
        return view('admin.product',  ['products' => $products, 'menu' => $menu]);
    }
    public function add()
    {
        $menu = Menu::with('submenu') // Lấy menu cha
            ->whereNull('parent_id') // Lấy luôn menu con
            ->orderBy('position') // Sắp xếp theo vị trí
            ->get();

        return view('admin.add-product', ['menu' => $menu]);
    }
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'url' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'menu_id' => 'required|integer|exists:menus,id',
            'keyword_focus' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'display' => 'boolean',
            'discount' => 'boolean',
            'is_new' => 'boolean',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Tạo sản phẩm mới
        $product = new Products();
        // Xử lý nhiều ảnh (images[]) nếu có
        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('images'), $name);
                $imagesArray[] = $name;
            }

            $product->filenames = $imagesArray;
        }

        // Lưu các dữ liệu cơ bản
        if ($request->hasFile('image')) {
            // Store the new image
            $image = $request->file('image');
            $avatarName = $image->getClientOriginalName();
            $image->move(public_path('images'), $avatarName);

            $product->image = $avatarName;
        }

        $product->url = $request->input('url');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->menu_id = $request->input('menu_id');
        $product->keyword_focus = $request->input('keyword_focus');
        $product->seo_title = $request->input('seo_title');
        $product->seo_keywords = $request->input('seo_keywords');
        $product->seo_description = $request->input('seo_description');
        $product->display = $request->input('display');
        $product->discount = $request->input('discount');
        $product->new = $request->input('is_new');



        // Lưu sản phẩm vào database
        $product->save();

        return response()->json(['message' => 'Sản phẩm đã được thêm thành công']);
    }
    public function deleteAll(Request $request)
    { // Lấy danh sách các ID từ yêu cầu
        $ids = $request->input('ids');

        // Kiểm tra nếu có ID nào được chọn
        if (is_array($ids) && count($ids) > 0) {
            // Xóa các mục theo ID
            Products::whereIn('id', $ids)->delete();

            return response()->json(['success' => 'Đã xóa thành công các mục đã chọn!']);
        }

        return response()->json(['error' => 'Không có mục nào được chọn.'], 400);
    }


    public function destroy($id)
    {
        // Tìm sản phẩm bằng ID
        $news = Products::where('id', $id)->first();
        // Xóa sản phẩm
        $news->delete();

        // Redirect lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function show($id)
    {
        $product = Products::where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return view('home-page.product-detail', ['news' => $product, 'product' => Products::take(4)->get()]);
    }
    public function show_update($id)
    {
        $product = Products::where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $parentMenu = Menu::where('name', 'Sản phẩm')->first(); // Lấy menu cha có tên 'Sản phẩm'

        $menu = Menu::where('parent_id', $parentMenu->id)  // Lọc menu con của menu cha 'Sản phẩm'
            ->get();

        return view('admin.show-update', ['product' => $product, 'menu' => $menu]);
    }
    public function update(Request $request, $id)
    { // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'url' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'menu_id' => 'required|integer|exists:menus,id',
            'keyword_focus' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'display' => 'boolean',
            'discount' => 'boolean',
            'is_new' => 'boolean',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Tạo sản phẩm mới
        $product = Products::findOrFail($id);
        // Xóa dữ liệu cũ trong cột `images`
        // $product->images = null; // Hoặc đặt về giá trị mặc định khác nếu cần
        // $product->save();
        // Xử lý nhiều ảnh (images[]) nếu có
        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('images'), $name);
                $imagesArray[] = $name;
            }

            // $existingImages = json_decode($product->images);
            // $updatedImages = array_merge($existingImages, $imagesArray);
            $product->images = json_encode($imagesArray);
        }

        // Lưu các dữ liệu cơ bản
        if ($request->hasFile('image')) {
            // Store the new image
            $image = $request->file('image');
            $avatarName = $image->getClientOriginalName();
            $image->move(public_path('images'), $avatarName);

            $product->image = $avatarName;
        }

        $product->url = $request->input('url');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->menu_id = $request->input('menu_id');
        $product->keyword_focus = $request->input('keyword_focus');
        $product->seo_title = $request->input('seo_title');
        $product->seo_keywords = $request->input('seo_keywords');
        $product->seo_description = $request->input('seo_description');
        $product->display = $request->input('display');
        $product->discount = $request->input('discount');
        $product->new = $request->input('is_new');



        // Lưu sản phẩm vào database
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }
    public function update_status(Request $request, $id)
    {
        $request->validate([
            'display' => 'nullable|boolean',
            'discount' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
        ]);

        $product = Products::findOrFail($id);

        // Cập nhật các trạng thái
        $product->display = $request->input('display');
        $product->discount = $request->input('discount');
        $product->new = $request->input('is_new');

        $product->save();

        return response()->json(['success' => 'Product status updated successfully!']);
    }
    //     public function search(Request $request)
    //     {
    //         $query = $request->input('kw');
    //         $menu = Menu::all();
    //         $news = News::where('title', 'LIKE', "%{$query}%")->get();
    //         if (!$news) {
    //             return redirect()->back()->with('error', 'Product not found.');
    //         }

    //         return view('home-page.news', [
    //             'categories' => $categories,
    //             'products' => $product
    //         ]);
    //     }
}
