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
    public function list()
    {
        // $featuredProducts = $this->getFeaturedProducts(8);
        $listProducts = Product::orderBy('id', 'desc')->paginate(12);
        return view('client.shop',compact('listProducts'));
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
