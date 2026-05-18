<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $recommended = Product::inRandomOrder()->take(4)->get();
        return view('cart.index', compact('cart', 'recommended'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = $request->session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio,
                "image" => $product->imagen
            ];
        }
        
        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente')->with('open_cart', true);
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = $request->session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                $request->session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Producto eliminado')->with('open_cart', true);
        }
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        
        if(count($cart) == 0) {
            return redirect()->route('shop.index')->with('error', 'Tu carrito está vacío.');
        }

        return view('cart.checkout', compact('cart'));
    }
}
