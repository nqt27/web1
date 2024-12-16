<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuNews;
use App\Models\News;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $menu = MenuNews::all();
        $selectmenu = MenuNews::with('submenu') // Lấy menu cha
            ->whereNull('parent_id') // Lấy luôn menu con
            ->orderBy('position') // Sắp xếp theo vị trí
            ->get();
        $news = News::all();
        return view('admin.news',  ['news' => $news, 'menu' => $menu, 'selectmenu' => $selectmenu]);
    }
    public function add()
    {
        $menu = MenuNews::with('submenu') // Lấy menu cha
            ->whereNull('parent_id') // Lấy luôn menu con
            ->orderBy('position') // Sắp xếp theo vị trí
            ->get();

        return view('admin.add-news', ['menu' => $menu]);
    }
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'url' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'menu_id' => 'required|integer|exists:menu_news,id',
            'keyword_focus' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'display' => 'boolean',
            'is_new' => 'boolean',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Tạo sản phẩm mới
        $news = new News();


        // Lưu các dữ liệu cơ bản
        if ($request->hasFile('image')) {
            // Store the new image
            $image = $request->file('image');
            $avatarName = $image->getClientOriginalName();
            $image->move(public_path('images'), $avatarName);

            $news->image = $avatarName;
        }

        $news->url = $request->input('url');
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->menu_id = $request->input('menu_id');
        $news->keyword_focus = $request->input('keyword_focus');
        $news->seo_title = $request->input('seo_title');
        $news->seo_keywords = $request->input('seo_keywords');
        $news->seo_description = $request->input('seo_description');
        $news->display = $request->input('display');
        $news->new = $request->input('is_new');



        // Lưu sản phẩm vào database
        $news->save();

        return response()->json(['message' => 'Sản phẩm đã được thêm thành công']);
    }
    public function deleteAll(Request $request)
    { // Lấy danh sách các ID từ yêu cầu
        $ids = $request->input('ids');

        // Kiểm tra nếu có ID nào được chọn
        if (is_array($ids) && count($ids) > 0) {
            // Xóa các mục theo ID
            News::whereIn('id', $ids)->delete();

            return response()->json(['success' => 'Đã xóa thành công các mục đã chọn!']);
        }

        return response()->json(['error' => 'Không có mục nào được chọn.'], 400);
    }


    public function destroy($id)
    {
        // Tìm sản phẩm bằng ID
        $news = News::where('id', $id)->first();
        // Xóa sản phẩm
        $news->delete();

        // Redirect lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function show($id)
    {
        $news = News::where('id', $id)->first();

        if (!$news) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return view('home-page.product-detail', ['news' => $news, 'product' => News::take(4)->get()]);
    }
    public function show_update($id)
    {
        $news = News::where('id', $id)->first();

        // Lấy menu con đã chọn
        $selectedMenu = MenuNews::find($news->menu_id);

        // Lấy menu cha và các menu con liên quan
        $menu = MenuNews::with('submenu') // Lấy menu cha
        ->whereNull('parent_id') // Lấy luôn menu con
        ->orderBy('position') // Sắp xếp theo vị trí
        ->get();


        return view('admin.show-update-news', ['news' => $news, 'menu' => $menu, 'selectedMenu' => $selectedMenu]);
    }
    public function update(Request $request, $id)
    { // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'url' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'menu_id' => 'required|integer|exists:menu_news,id',
            'keyword_focus' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'display' => 'boolean',
            'is_new' => 'boolean',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Tạo sản phẩm mới
        $news = News::findOrFail($id);


        // Lưu các dữ liệu cơ bản
        if ($request->hasFile('image')) {
            // Store the new image
            $image = $request->file('image');
            $avatarName = $image->getClientOriginalName();
            $image->move(public_path('images'), $avatarName);

            $news->image = $avatarName;
        }

        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->menu_id = $request->input('menu_id');
        $news->keyword_focus = $request->input('keyword_focus');
        $news->seo_title = $request->input('seo_title');
        $news->seo_keywords = $request->input('seo_keywords');
        $news->seo_description = $request->input('seo_description');
        $news->display = $request->input('display');
        $news->new = $request->input('is_new');



        // Lưu sản phẩm vào database
        $news->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }
    public function update_status(Request $request, $id)
    {
        $request->validate([
            'display' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
        ]);

        $news = News::findOrFail($id);

        // Cập nhật các trạng thái
        $news->display = $request->input('display');
        $news->new = $request->input('is_new');

        $news->save();

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
