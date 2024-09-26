<?php

namespace App\Http\Controllers;

use PDF;
use Stripe;
use Session;
use Notification;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Mail\orderMail;
use App\Models\Product;
use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\sendEmailNotification;

class productController extends Controller
{
    public function createProduct(Request $req) {
       $validate = $req->validate([
        "name"=>"Required",
        "price"=>"Required",
        "discount"=>"Required",
        "discountDetails"=>"Required",
        "product"=>"Required",
        
       ]);


       $name = $req->input('name');
       $filename = $name.".".$req->product->getClientOriginalExtension();
       $req->product->move("products",$filename);
      
       $product = new Product;
       $product->name = $req->name;
       $product->price = $req->price;
       $product->discount = $req->discount;
       $product->discount_detail = $req->discountDetails;
       $product->file = $filename;
       $product->user_id = auth()->id();
      
       $product->save();
       return redirect()->back();
      }


    public function viewProduct(){
        $data = Product::all();
        $count = Cart::where("user_id",auth()->user()->id)->count();
        return view("home.main",compact("data","count"));
    }

    public function add2cart(Request $req, $id){
      $user = auth()->user();
      $cart = new Cart;
      $product = Product::find($id);

      $cart->name = $user->name;
      $cart->email = $user->email;
      $cart->address = $user->address;
      $cart->product_name = $product->name;
      if($product->discount == ""){
      $cart->price = $product->price * $req->quantity;
      }
      else {
      $cart->price = $product->discount * $req->quantity;
      }

      $cart->quantity = $req->quantity;
      $cart->file = $product->file;
      $cart->product_id = $product->id;
      $cart->user_id = $user->id;

      $cart->save();


      Session::flash('added_to_cart', 'Your Product Has Been Added To Cart!');

      
      return redirect()->back();
    }
    public function cartDetails(){
        $cartData = Cart::where("user_id", auth()->user()->id)->get();
       
        return view("home.cart",compact("cartData"));
    }

    public function remove($id) {
      $remove  = Cart::find($id);
      $remove->delete();
      return redirect()->back();
    }

    public function pod() {
      $user = auth()->user()->id;
      $cart = Cart::where("user_id",$user)->get();
       foreach($cart AS $cart) {
         $order = new Order;
         $order->name = $cart->name;
         $order->email = $cart->email;
         $order->address = $cart->address;
         $order->product_name = $cart->product_name;
         
         $order->quantity = $cart->quantity;

         $order->price = $cart->price;
         $order->name = $cart->name;
         $order->product_id = $cart->product_id;
         $order->user_id = $cart->user_id;
         $order->payment_status = "Pay On Delivery";
         $order->delivery_status = "Pending";
         

        $order->save();

         $personal = $cart->id;
         $detail = Cart::find($personal);
         $detail->delete();
       }

       return redirect()->back();
    }

  public function stripe($total) {
    return view("home.stripe", compact("total"));
  }

 public function stripePost(Request $request,$total)

  {

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
     
      Stripe\Charge::create ([
              "amount" => $total * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "Thanks For Payment." 
]);


   
$user = auth()->user()->id;
$cart = Cart::where("user_id",$user)->get();
 foreach($cart AS $cart) {
   $order = new Order;
   $order->name = $cart->name;
   $order->email = $cart->email;
   $order->address = $cart->address;
   $order->product_name = $cart->product_name;
   
   $order->quantity = $cart->quantity;

   $order->price = $cart->price;
   $order->name = $cart->name;
   $order->product_id = $cart->product_id;
   $order->user_id = $cart->user_id;
   $order->payment_status = "Paid";
   $order->delivery_status = "Pending";
   

  $order->save();

   $personal = $cart->id;
   $detail = Cart::find($personal);
   $detail->delete();
 }

  Session::flash('success', 'Payment successful!');
  return redirect("/index");

  }

  public function adminPanel(){
    $order = Order::all();
    return view("home.order",compact("order"));
  }


  public function update($id) {
    $update = Order::find($id);
    $update->delivery_status = "Delivered";
    $update->payment_status = "Paid";
    $update->save();

   event(new OrderPlaced($update));
   Mail::to($update->email)->send(new orderMail());

   return redirect()->back();

  }

  public function print_pdf($id) {
    $print = Order::find($id);
    $pdf = PDF::loadView("home.print_pdf",compact("print"));
    return $pdf->download("order_detail.pdf");
  }

  public function send_email($id) {
    $user = Order::find($id);
    return view("home.send_email",compact("user"));
  }



  public function sendMail(Request $req, $id) {
     $order = Order::find($id);
     $details = [
      "greeting"=>$req->greeting,
      "firstLine"=>$req->fLine,
      "body"=>$req->body,
      "button"=>$req->button,
      "url"=>$req->url,
      "lastLine"=>$req->lLine,
     ];

   Notification::send($order, new sendEmailNotification($details));

   return redirect()->back();

  }

  // public function orderEmail() {

  // }

}
