<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return News::all();
    }
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'menu_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path = 'storage/' . $request->file('image')->store('image', 'public');
        // Tạo sản phẩm mới
        $news = new News;
        $news->name = $request->input('name');
        $news->image = $path;
        $news->content = $request->input('content');
        $news->menu_id = $request->input('menu_id');
        $news->save();
        // Redirect về trang chủ hoặc trang danh sách sản phẩm
        return redirect()->route('admin.product')->with('success', 'Product added successfully.');
    }
    public function destroy($id)
    {
        // Tìm sản phẩm bằng ID
        $news = News::where('id', $id)->first();
        // Xóa sản phẩm
        $news->delete();

        // Redirect lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.news')->with('success', 'Product deleted successfully.');
    }
    public function show($id)
    {
        $news = News::where('id', $id)->first();

        if (!$news) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return view('home-page.product-detail', ['news' => $news, 'news' => News::take(4)->get()]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',    
            'content' => 'required|string',
            // Thêm các rules khác nếu cần
        ]);

        $news = News::findOrFail($id);
        if ($request->hasFile('image')) {
            // Store the new image
            $path = 'storage/' . $request->file('image')->store('image', 'public');

            // Update the image path in the database
            $news->image = $path;
        }


        $news->title = $request->input('title');
        $news->content = $request->input('content');
        // $product->image = $path;
        // Cập nhật các trường khác nếu cần

        $news->save();

        return redirect()->route('admin.news')->with('success', 'Product updated successfully.');
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
