<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Public\Car;

class CartController extends Controller
{
    /**
     * Display the current cart.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // ✅ Fix session key casing for consistency
        $cart = Session::get('cart', []);

        return view('Public.cart', compact('cart'));
    }

    /**
     * Add a car to the cart.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id)
    {
        $car = Car::findOrFail($id);
        $cart = Session::get('cart', []);

        // ✅ Include 'id' in stored cart item
        $cart[$id] = [
            'id'    => $car->id,
            'make'  => $car->make,
            'model' => $car->model,
            'price' => $car->price,
            'image' => $car->image,
        ];

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', "{$car->make} added to cart.");
    }

    /**
     * Remove a car from the cart.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', "Car removed from cart.");
    }
}
