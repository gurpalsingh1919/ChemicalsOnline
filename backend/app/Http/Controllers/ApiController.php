<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Helpers\Helpers;
use Purifier;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class ApiController extends Controller
{
   public function getAllProducts(Request $request)
    {
        $query = Product::with('image');

       
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query->paginate(52);
    }
    public function byCategory(Request $request, $slug=null, $subcategorySlug = null)
    { 

      /*if($slug == 'small-molecule-pharma')
      {
        $categoryIds=['181','191','212'];
      }
      else if($slug == 'large-molecule-pharmabioprocessing')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'labs')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'beverage')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'industrial')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'personal-carecosmetics')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'herbal-extraction')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'medical-device')
      {
        $categoryIds=['181','191','212','276','264'];
      }
      else if($slug == 'nutraceutical')
      {
        $categoryIds=['181','191','206','162','264'];
      }
      else if($slug == 'foodflavorfragrance')
      {
        $categoryIds=['151','162','84','197','206'];
      }*/

      if (!$slug) 
      {
        $query = Product::with('image');
        $category = Category::where('parent_id','0')->orderBy('name', 'asc')->get();
        $sub_categories=$category;
      }
      else if ($subcategorySlug) 
      {
          // Subcategory route → only subcategory products
          $subcategory = Category::where('slug', $subcategorySlug)
              ->whereHas('parent', function ($q) use ($slug) {
                  $q->where('slug', $slug);
              })->firstOrFail();

          $categoryIds = [$subcategory->id];
          $query = Product::with('image')
          ->whereHas('categories', function ($q) use ($categoryIds) {
              $q->whereIn('categories.id', $categoryIds);
          });

          $category = Category::with('subcategories')
              ->where(['slug'=>$slug,'parent_id'=>'0'])->firstOrFail();
          $sub_categories=$category->subcategories;
      } 
      else 
      {
         $category = Category::with('subcategories')
              ->where(['slug'=>$slug,'parent_id'=>'0'])->firstOrFail();
          // if($categoryIds !='')
          // {
            $categoryIds = getAllCategoryIds($category);
          //}
          
          $query = Product::with('image')
          ->whereHas('categories', function ($q) use ($categoryIds) {
              $q->whereIn('categories.id', $categoryIds);
          });

          $sub_categories=$category->subcategories;
      }
       

      // Build product query
     
      $query=$query->where('name', '!=', '');
          // ✅ Sorting
          switch ($request->get('sortBy')) {
              case 'title-ascending':
                  $query->orderBy('name', 'asc');
                  break;
              case 'title-descending':
                  $query->orderBy('name', 'desc');
                  break;
              case 'price-ascending':
                  $query->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC');
                  break;
              case 'price-descending':
                  $query->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC');
                  break;
              case 'created-ascending':
                  $query->orderBy('created_at', 'asc');
                  break;
              case 'created-descending':
                  $query->orderBy('created_at', 'desc');
                  break;
              default:
                  $query->latest();
                  break;
          }

          // ✅ Pagination (keeps page query param)
          $products = $query->paginate(52)->appends($request->all());

          
          return response()->json([
              'category'      => $category,
              'subcategories' => $sub_categories,
              'products'      => $products
          ]);


       
    }

    public function byIndustry(Request $request, $industry=null)
    {
      //$industry = 'Chemical';
      $category = Category::where('parent_id','0')->orderBy('name', 'asc')->get();
      $sub_categories=$category;
      

      $query = Product::with('image')
           ->whereHas('categories', fn($q) => $q->where('industry', 'like', '%' . $industry . '%'));
       $query=$query->where('name', '!=', '');
          // ✅ Sorting
          switch ($request->get('sortBy')) {
              case 'title-ascending':
                  $query->orderBy('name', 'asc');
                  break;
              case 'title-descending':
                  $query->orderBy('name', 'desc');
                  break;
              case 'price-ascending':
                  $query->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC');
                  break;
              case 'price-descending':
                  $query->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC');
                  break;
              case 'created-ascending':
                  $query->orderBy('created_at', 'asc');
                  break;
              case 'created-descending':
                  $query->orderBy('created_at', 'desc');
                  break;
              default:
                  $query->latest();
                  break;
          }

          // ✅ Pagination (keeps page query param)
          $products = $query->paginate(52)->appends($request->all());  
        return response()->json([
              'category'      => $category,
              'subcategories' => $sub_categories,
              'products'      => $products
          ]);
    }
    public function show($slug)
    {
        $product = Product::with(['image', 'categories'])
            ->where('slug', $slug)
            ->firstOrFail();
        $product->description = Purifier::clean($product->description);

        return response()->json([
            'product' => $product
        ]);
    }
    public function placeOrder(Request $request)
    {
      $validated = $request->validate([
        'user_id' => 'required|integer',
        'cart' => 'required|array',
        'total' => 'required',
        'paypal_order_id' => 'required',
      ]);

      $order = Order::create([
          'user_id' => $request->user_id,
          'items' => json_encode($request->cart),
          'amount' => $request->total,
          'payment_id' => $request->paypal_order_id,
          'status' => '1',
      ]);
      $cartdata=$request->cart;
      Foreach($cartdata as $cart)
      { //echo "<pre>";print_r($cart);
        //$cart_Data=json_decode($cart);
          OrderDetail::create([
          'order_id' => $order->id,
          'product_id' => $cart['id'],
          'price' => $cart['price'],
          'qty' => $cart['quantity'],
          'subtotal' => $cart['quantity']*$cart['price']
          ]);
      }

     
      return response()->json(['success' => true, 'order_id' => $order->id]);
    }

     public function index(Request $request)
    {
        // Fetch all orders belonging to the logged-in user
        $orders = Order::where('user_id', $request->user()->id)
            ->with('items.product') // eager-load items & product
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
          'current_password' => ['required'],
          'new_password' => ['required', 'min:8', 'confirmed'],
      ]);

      $user = $request->user();

      if (!Hash::check($request->current_password, $user->password)) {
          throw ValidationException::withMessages([
              'current_password' => ['The current password is incorrect.'],
          ]);
      }

      $user->forceFill([
          'password' => Hash::make($request->new_password),
      ])->save();

      return response()->json(['message' => 'Password changed successfully']);
    }
    // app/Http/Controllers/Api/ProductController.php
    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (!$query) {
            return response()->json(['message' => 'Query parameter missing'], 400);
        }

        $products = Product::with('image')
            ->where('name', 'like', "%{$query}%")
            //->orWhere('description', 'like', "%{$query}%")
            ->where('name', '!=', '')
            ->orderBy('name')
            ->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    }



  


    public function contactUs(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:20',
            'comments'     => 'required|string|max:2000',
        ]);

        // You can send an email or store it in DB
        // Example: Send email
        // Mail::raw(
        //     "New Contact Form Submission:\n\n" . print_r($validated, true),
        //     function ($message) use ($validated) {
        //         $message->to('customer.service@greenfield.com')
        //                 ->subject('New Contact Form Submission');
        //     }
        // );
          $contact = ContactUs::create($validated);
        return response()->json(['message' => 'Your request has been submitted successfully!']);
    }






}
