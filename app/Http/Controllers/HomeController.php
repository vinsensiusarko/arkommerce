<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::orderby('id', 'DESC')->paginate(8);
        $comment = comment::orderby('id', 'DESC')->get();
        $reply = reply::all();

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '1')
        {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();
            $order = order::all();
            $total_revenue = 0;

            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = order::where('delivery_status', '=', 'Delivered')->get()->count();

            $total_processing = order::where('delivery_status', '=', 'Processing')->get()->count();

            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        }

        else
        {
            $product = Product::paginate(8);
            $comment = comment::orderby('id', 'DESC')->get();

            $orders = Cart::all()->where('user_id',Auth::user()->id);
            $orders_amount = DB::table('orders')->where('user_id',Auth::user()->id)->where('delivery_status','Processing')->count();

            $carts = Cart::all()->where('user_id',Auth::user()->id);
            $carts_amount = DB::table('carts')->where('user_id',Auth::user()->id)->count();

            $reply = reply::all();
            return view('home.userpage', compact('product', 'comment', 'reply'));
        }
    }

    public function product_details($id)
    {
        $product = product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $product = Product::find($id);

            $product_exist_id = cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

            if($product_exist_id)
            {
                $cart = cart::find($product_exist_id)->first();

                $quantity = $cart->quantity;

                $cart->quantity = $quantity + $request->quantity;

                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
    
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();

                Alert::success('Product Added Successfully', 'We have added product to the cart');

                return redirect()->back();
            }

            else
            {
                $cart = new Cart;

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
    
                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $request->quantity;
                }
    
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }
    
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
    
                $cart->save();
    
                Alert::success('Product Added Successfully', 'We have added product to the cart');

                return redirect()->back();
            }
        }

        else
        {
            return redirect('/');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $product = product::find($id);
            $cart = Cart::where('user_id', '=', $id)->orderby('id', 'DESC')->get();
            
            return view('home.cartpage', compact('cart', 'product'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function cash_order()
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;
    
            $data = cart::where('user_id', '=', $userid)->get();
    
            foreach($data as $data)
            {
                $order = new order;
    
                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->user_id = $data->user_id;
    
                $order->product_title = $data->product_title;
                $order->price = $data->price;
                $order->quantity = $data->quantity;
                $order->image = $data->image;
                $order->product_id = $data->product_id;
    
                $order->payment_status = 'Cash on Delivery';
                $order->delivery_status = 'Processing';
    
                $order->save();
    
                $cart_id = $data->id;
                $cart = cart::find($cart_id);
                $cart->delete();
            }

            Alert::success('Product Received', 'We receiced your order. we will connect with you soon.');
    
            return redirect()->back();
        }

        else
        {
            return redirect('/');
        }
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([

                "amount" => (int)( ($totalprice + ($totalprice  * 0.029)  + 0.3) * 100),
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment From User - ". auth()->user()->name
        ]);

        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();

        foreach($data as $data)
        {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        Alert::success('Payment Successful', 'Thanks for buying our products');

        return back();
    }

    public function show_order()
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $order = order::where('user_id', '=', $userid)->orderby('id', 'DESC')->get();

            return view('home.order', compact('order'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function cancel_order($id)
    {
        if(Auth::id())
        {
            $order = order::find($id);

            $order->delivery_status = 'You canceled the order';
    
            $order->save();
    
            return redirect()->back();
        }

        else
        {
            return redirect('/');
        }
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment = new comment;

            $comment->name = Auth::user()->name;

            $comment->user_id = Auth::user()->id;

            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();
        }

        else
        {
            return redirect('/');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply = new reply;

            $reply->name = Auth::user()->name;

            $reply->user_id = Auth::user()->id;

            $reply->comment_id = $request->commentId;

            $reply->reply = $request->reply;

            $reply->save();
            
            return redirect()->back();
        }

        else
        {
            return redirect('/');
        }
    }

    public function search_product(Request $request)
    {
        $search_text = $request->search;

        $product = product::where('title', 'LIKE', "%$search_text%")
        ->orWhere('category', 'LIKE', "$search_text")->paginate(10);

        $comment = comment::orderby('id', 'DESC')->get();
        $reply = reply::all();

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function search_product_view(Request $request)
    {
        $search_text = $request->search;

        $product = product::where('title', 'LIKE', "%$search_text%")
        ->orWhere('category', 'LIKE', "$search_text")->paginate(10);

        $comment = comment::orderby('id', 'DESC')->get();
        $reply = reply::all();

        return view('home.productpage', compact('product', 'comment', 'reply'));
    }

    public function products()
    {
        $product = Product::paginate(10);
        $comment = comment::orderby('id', 'DESC')->get();
        $reply = reply::all();

        return view('home.productpage', compact('product', 'comment', 'reply'));
    }

    public function about_us()
    {
        return view('home.about_us');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
