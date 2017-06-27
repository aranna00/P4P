<?php
    
    namespace App\Http\Controllers;
    
    use App\AttributeGroup;
    use App\Brand;
    use App\Category;
    use App\Product;
    use Symfony\Component\HttpFoundation\Request;

    class ProductController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories=Category::whereNull("parent_id");
            $categories=$categories->get();
            
            $products=Product::all();
            $products->load("brand");
    
            $brands=Brand::whereHas("products", function ($query) use ($products) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereIn("id", $products->map(function ($item, $key) {
                    return $item->id;
                }));
            })->get();
    
            return view('products.index', compact(["categories", "products", "brands"]));
        }
        
        /**
         * Display a listing of the resource.
         *
         * @param int $parent_id
         *
         * @return \Illuminate\Http\Response
         */
        public function filtered($parent_id)
        {
            $parent=Category::find($parent_id);
            $categories=$parent->children;
            $products=$parent->products;
            $attribute_groups=AttributeGroup::whereHas("attributes", function ($query) use ($products) {
                $query->whereHas("product", function ($query) use ($products) {
                    $query->whereIn("id", $products->map(function ($item, $key) {
                        return $item->id;
                    }));
                });
            });
            $attribute_groups=$attribute_groups->with(["attributes"])->get();
    
            $brands=Brand::whereHas("products", function ($query) use ($products) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereIn("id", $products->map(function ($item, $key) {
                    return $item->id;
                }));
            })->get();
            
            $breadcrumbs=[[$parent->id, $parent->name]];
            while ($parent->parent_id != null) {
                $parent=$parent->parent;
                array_push($breadcrumbs, [$parent->id, $parent->name]);
            }
            
            return view('products.index',
                compact(["parent_id", "categories", "breadcrumbs", "attribute_groups", "brands", "products"]));
        }
        
        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function filtered_products(Request $request)
        {
            if (array_key_exists("parent", $_REQUEST)) {
                $parentId=$request->query("parent");
                $parent=Category::find($parentId);
                $products=$parent->products();
            } else {
                $products=Product::query();
                $parentId=null;
            }
            if ($request->has("search")) {
                /** @var \App\Product $products */
                $products->where(function ($query) use ($request) {
                    $query->orWhere("name", "like", "%" . $request->query("search") . "%");
                    $query->orWhere("code", "like", "%" . $request->query("search") . "%");
                });
            }
            if ($request->has("brands")) {
                $products->whereIn("brand_id", explode(",", $request->query("brands")));
            }
            if ($request->has("price_from")) {
                $products->where("price", ">=", $request->query("price_from"));
            }
            if ($request->has("price_to")) {
                $products->where("price", "<=", $request->query("price_to"));
            }
    
            $products=$products->with("brand")
                               ->orderBy($request->has("type") ? $request->query("type") : "name",
                                   $request->has("sorting") ? $request->query("sorting") : "asc")
                               ->paginate($request->has("perPage") ? $request->query("perPage") : 10)
                               ->appends($_REQUEST);
    
            $user=\Sentinel::check();
    
            $wishlists=$user->wishlists;
    
            return view("products.products", compact(["products", "parentId", "wishlists"]));
        }
        
        
        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $product = Product::whereId($id)->get()->first();

            $user=\Sentinel::check();
            $wishlists=$user->wishlists;

            return view('products.product', compact(['product', 'wishlists']));
        }
    }
