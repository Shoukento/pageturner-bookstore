<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::with('category')->take(8)->get();
        $categories = Category::withCount('books')->take(6)->get();

        return view('home', compact('featuredBooks', 'categories'));
    }

    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        return view('admin.dashboard', compact('totalBooks', 'totalCategories', 'totalOrders'));
    }
}