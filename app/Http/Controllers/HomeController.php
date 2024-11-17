<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featuredProducts = $this->getFeaturedProducts(10);
        return view('client.index', compact('featuredProducts'));
    }
    public function detail()
    {
        $featuredProducts = $this->getFeaturedProducts(8);
        return view('client.shop-single',compact('featuredProducts'));
    }
    public function list(Request $request)
    {
        $query = Product::query();
        
        // Định nghĩa các trường có thể sort
        $sortableFields = [
            'name' => 'name',
            'price' => 'price',
            'created_at' => 'created_at'
            // Có thể thêm các trường mới vào đây
        ];

        // Xử lý sort
        if ($request->has('sort') && array_key_exists($request->sort, $sortableFields)) {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sortableFields[$request->sort], $direction);
        } else {
            $query->orderBy('id', 'desc'); // Mặc định sắp xếp theo id giảm dần
        }

        $listProducts = $query->paginate(12);
        return view('client.shop', compact('listProducts'));
    }

    private function getFeaturedProducts($count)
    {
        
        $products = Product::orderBy('id', 'desc')->take($count)->get();
        return $products;
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $listProducts = Product::where('name', 'like', '%' . $search . '%')->paginate(12);
        return view('client.shop', compact('listProducts'));
    }
}
