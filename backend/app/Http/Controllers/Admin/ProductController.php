<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage; // ✅ add this
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Category;

use App\Models\ProductImage;
use App\Models\ProductCategory;
use League\Csv\Reader;


class ProductController extends Controller
{
   public function all_products(Request $request)
    {

        $products = Product::orderBy('id', 'desc')->get();


        //$products = Product::orderBy('id', 'desc')->paginate(20);

        return view('admin.product.all-products', compact('products'));
    }

    public function add_product()
    {
        return view('admin.product.add-product');
    }
    public function save_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'brand_name' => 'required',
            'cas_number' => 'required',
           
        ]);

        $slug = Str::limit(Str::slug($request->chemical_name), 50, '');


        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count) {
            $slug .= '-' . ($count + 1);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->product_code = $request->product_code;
        $product->brand_name = $request->brand_name;
        $product->cas_number = $request->cas_number;
        $product->appearance = $request->appearance;
        $product->description = $request->description;
        $product->function = $request->function;
        $product->synonyms = $request->synonyms;
        $product->formula = $request->formula;
        $product->storage = $request->storage;


        $product->packages = json_encode($request->packages);
        $product->industries = json_encode($request->industries);
        $product->product_classes = json_encode($request->product_classes);
        $product->other = json_encode($request->other);

        $product->status = 1;
        $product->slug = $slug;

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }

   

    public function edit_product($encrypted_id)
    {
        $id = Crypt::decrypt($encrypted_id);
        $product = Product::with('categories')->where('id',$id)->first();

        //$categories=$this->getCategories();
         $categories = Category::with('children')->where('parent_id','0')->get();
        $product->option1 = $product->option_1 ? json_decode($product->option_1, true) : [];
        $product->option2 = $product->option_2 ? json_decode($product->option_2, true) : [];
        //$product->option3 = $product->option_3 ? json_decode($product->option_3, true) : [];
        //echo "<pre>";print_r($product->toArray());die;
        return view('admin.product.edit-product', compact('product','categories'));
    }
    public function getCategories()
    {
      $allcategories=Category::get();
      $rootcategories=Category::where('parent_id','0')->get();
      self::formatTree($rootcategories,$allcategories);

      return $rootcategories;
      
    }
  

    public function update_product(Request $request, $id)
    {

      // echo "<pre>";print_r($request->all());die;
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'categories' => 'array|nullable',
            ]);

       
        $product = Product::findOrFail($id);


        $data = $request->only([
            'name',
            'price',
            'sku',
            'variant',
            'description',
            ]);

      
        foreach (['option_1', 'option_2', 'option_3'] as $field) {
            $data[$field] = json_encode($request->input($field));
        }

        //$data['slug'] = Str::slug($request->chemical_name) . '-' . $product->id;
        //echo "<pre>";print_r($data);die;
        $product->update($data);
        //Sync product_categories (many-to-many pivot table)
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach(); // remove all if none selected
        }
        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    public function delete_product($encrypted_id)
    {
        $id = Crypt::decrypt($encrypted_id);
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.all_products')->with('success', 'Product deleted successfully!');
    }

     public function showImportForm()
    {
        return view('admin.product.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);


        $path = $request->file('csv_file')->getRealPath();
        $csv = Reader::createFromPath($path, 'r');
       $csv->setHeaderOffset(0); // first row = headers
        //echo "<pre>";print_r($csv);
        foreach ($csv as $row) {
            // Insert product
            //echo "<pre>";print_r($row);die;
            $option1 = ['name'=>$row['Option1 Name'],'value'=>$row['Option1 Value']];
            $option2 = ['name'=>$row['Option2 Name'],'value'=>$row['Option2 Value']];
            $option3 = ['name'=>$row['Option3 Name'],'value'=>$row['Option3 Value']];
            $title   = is_array($row['Title']) ? implode(' ', $row['Title']) : $row['Title'];
            $slug    = Str::slug($title);
            //echo json_encode($option1) .'-----'.json_encode($option2) .'-----'.json_encode($option3);die; 
            $product = Product::updateOrCreate(
                [
                    'name'        => $title,
                    'description' => $row['Body (HTML)'],
                    'slug'        => $slug,
                    'variant'     => $row['Variant Grams'] ?? null,
                    'price'       => $row['Variant Price'],
                    'vendor'      => $row['Vendor'],
                    'option_1'    => json_encode($option1) ?? null,
                    'option_2'    => json_encode($option2) ?? null,
                    'option_3'    => json_encode($option3) ?? null,
                    'sku'         => str_replace("'", "", $row['Variant SKU'] ?? '')
                ]
            );

            // Insert product images (comma separated)
            if (!empty($row['Image Src'])) {
                $images = explode(',', $row['Image Src']);
                foreach ($images as $index=>$img) {


                    try {
                    $imageContent = Http::get(trim($img))->body();

                    $imageName = $slug.'-'.$index.'.jpg';
                    Storage::disk('public')->put('products/' . $imageName, $imageContent);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => 'products/' . $imageName,
                    ]);
                    } catch (\Exception $e) {
                        \Log::error("Image download failed: " . $img . " | " . $e->getMessage());
                    }

                   
                }
            }

        $categoryName = trim($row['Categories']);
        $subCategories = explode(',', $row['Sub Category']); // split by comma

        // Main Category (parent)
        $category = Category::firstOrCreate(
            ['name' => strtoupper($categoryName)],
            ['slug' => Str::slug($categoryName), 'parent_id' => '0']
        );

        // Loop through each subcategory
        foreach ($subCategories as $subCategoryName) {
            $subCategoryName = trim($subCategoryName);

            if (!empty($subCategoryName)) {
                // Create/find subcategory under the main category
                $subCategory = Category::firstOrCreate(
                    ['name' => strtoupper($subCategoryName), 'parent_id' => $category->id],
                    ['slug' => Str::slug($subCategoryName)]
                );

                // Attach to product in pivot table
                ProductCategory::firstOrCreate([
                    'product_id'  => $product->id,
                    'category_id' => $subCategory->id,
                    'status'      => '1'
                ]);
            }
        }
        
        

      }
            return back()->with('success', 'Products imported successfully!');
    }

}
