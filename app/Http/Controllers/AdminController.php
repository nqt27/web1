<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }


    public function news()
    {
        return view('admin.news');
    }
    public function addNews()
    {
        return view('admin.addNews');
    }



    public function logo()
    {
        return view('admin.logo');
    }

    public function seo()
    {
        return view('admin.seo');
    }
   
}