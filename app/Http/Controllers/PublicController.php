<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Models\Items_sold;
use App\Models\Orders;
use Session;
use Cookie;
use App\shopping_cart;

class PublicController extends Controller
{
    //Products

    public function index(Request $request)
    {   
        if (request()->category){

            $items = Item::where('category_id','=', request()->id); 
        }else{
        $categories = Category::orderBy('name','ASC')->paginate(10);
        $items = Item::all();
        }

        return view('public.index')->with('categories',$categories)->with('items', $items);
    }

    public function details ($id)
    {   
        
        $item = Item::find($id);

        return view('public.details')->with('item', $item);
    }

   

    public function edit($id)
    {   
        return view('public.details');
    }


    public function show($id)
    {
      
        $categories = Category::orderBy('name','ASC')->paginate(10);

        $items = Item::where('category_id',$id)->get();
        
        return view('public.index')->with('categories',$categories);
    }

}


