<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Session;
use App\cart;
use DB;
class PublicController extends Controller
{
    //

    public function index(Request $request)
    {   

        $session_id = Session::getId();
        $ip_address = $request->ip();
    

        Session::put('session_id', $session_id);
        Session::put('ip_address', $ip_address);


        if (request()->category){

            $items = Item::where('category_id','=', request()->id); 
        }else{
        $categories = Category::orderBy('name','ASC')->paginate(10);
        $items = Item::all();
        }

        return view('public.index')->with('categories',$categories)->with('items', $items)->with('session_id', $session_id)->with('ip_address', $ip_address);
    }

    public function details ($id)
    {   
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');


        $item = Item::find($id);

        return view('public.details')->with('item', $item)->with('session_id',$session_id)->with('ip_address', $ip_address);
    }

   
    public function addToCart($id)
    {   
        
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        $cartitem = new cart;
        $cartitem->item_id = $id;
        $cartitem->session_id = $session_id;
        $cartitem->ip_address = $ip_address;
        $cartitem->quantity = 1;        

        $cartitems = cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);

        $flag=true;
        foreach($cartitems as $single_item){
            if($single_item->item_id == $id) {
                   $flag=false;
            }
        }

        if($flag){
            $cartitem->save();
        }    	 	

        $cartitems = cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);

        return view('public.shoppingcart')->with('cartitems',$cartitems)->with('items', $items);
    }

    

    public function update_cart(Request $request, $id)
    {   
        $session_id = Session::get('session_id');
        Session::forget('error');

        $cartitem = cart::find($id);
        $cartitem->quantity = $request->quantity;

        $cartitems = cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        
        foreach($items as $item){
            if($cartitem->item_id == $item->id){
                if($cartitem->quantity>$item->quantity){
                    Session::flash('error','Not enough items in stock!');
                    return view('public.shoppingcart')->with('cartitems',$cartitems)->with('items', $items);
                }else{
                    Session::flash('success','Cart updated successfully');
                }
            }
        }
        
        //if item quantity is 0 then delete
        if ($cartitem->quantity <= 0){
            $cartitem->delete();
        }else{    
            $cartitem->save();
        }

        $cartitems = cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        return view('public.shoppingcart')->with('cartitems',$cartitems)->with('items', $items);
    }

    public function remove_item($id)
    {   
        $session_id = Session::get('session_id');
        
        $cartitem = cart::find($id);
        $cartitem->delete();
        
        $cartitems = cart::orderBy('id','ASC')->where('session_id','=',$session_id)->paginate(100);
        $items = Item::orderBy('title','ASC')->paginate(100);
        
        return view('public.shoppingcart')->with('cartitems',$cartitems)->with('items', $items);
    }


    public function edit($id)
    {   
        return view('public.details');
    }


    public function show($id)
    {
        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        $categories = Category::orderBy('name','ASC')->paginate(10);

        $items = Item::where('category_id',$id)->get();
        
        return view('public.index')->with('categories',$categories)->with('items', $items)->with('session_id',$session_id)->with('ip_address', $ip_address);
    }

    public function create(Request $request){

        $session_id = Session::get('session_id');
        $ip_address = Session::get('ip_address');

        dd ($request);

        return view('public.shoppingcart')->with('session_id',$session_id)->with('ip_address', $ip_address);
    }    

}
