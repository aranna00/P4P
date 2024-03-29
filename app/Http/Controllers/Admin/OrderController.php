<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Http\Controllers\Controller;
    use App\Order;
    use App\Product;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Toastr;

    class OrderController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            if (isset($_GET['open'])) {
                $orders=Order::where("processed", "where", 0)->paginate(10);
            } else {
                $orders=Order::query()->paginate(10);
            }
            
            return view("admin.orders.index", compact("orders"));
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }
        
        /**
         * Display the specified resource.
         *
         * @param  $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            /** @var \App\Order $order */
            $order=Order::findOrFail($id);
            $products=$order->products;
            $products->load("tax");
            
            $total=$products->map(function ($item, $key) {
                return $item->price * $item->pivot->amount;
            })->sum();
            
            $tax=$products->map(function ($item, $key) {
                return $item->tax->value * $item->price * $item->pivot->amount / 100;
            })->sum();
            
            return view('admin.orders.show', compact('order', 'total', 'tax'));
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Order $order
         *
         * @return \Illuminate\Http\Response
         */
        public function edit(Order $order)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $id
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(Request $request, $id)
        {
            $order=Order::findOrFail($id);
            $order->processed=true;
            $order->save();

            Toastr::success("Order ". $order->id ." is succesvol verwerkt!");
            
            return \Redirect::back();
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Order $order
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Order $order)
        {
            //
        }
        
        public function products()
        {
            $products=Product::whereHas("orders", function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereProcessed(false);
                $query->where("delivery", "=", Carbon::today()->addDay(1));
            });
            $products=$products->with([
                "brand",
                "orders"=>function ($query) {
                    /** @var \Illuminate\Database\Eloquent\Builder $query */
                    $query->whereProcessed(false);
                }
            ])->get();
            
            return view("admin.orders.products", compact(["products"]));
        }
    }
