<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Category;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Redirect;
    use Toastr;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories=Category::with(["parent"])->paginate(8);
            
            return view("admin.categories.index", compact("categories"));
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $categories = Category::select(["id","name"]);
            $categories = $categories->get();
            $categories = $categories->mapWithKeys(function($item){
                return [$item->id=>$item->name];
            });
            
            return view("admin.categories.create", compact(["categories"]));
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(Request $request)
        {
            $category = new Category();
            $category->name = $request->get("name");
            $category->description = $request->get("description");
            $category->parent_id = $request->get("parent_id")==0?null:$request->get("parent_id");
            $category->save();
            
            Toastr::success("De category is succesvol aangemaakt");
            
            return Redirect::action("Admin\CategoryController@index");
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function show(Category $category)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $category=Category::findOrFail($id);
            $categories = Category::select(["id","name"])->where("id","!=", $category->id);
            $categories = $categories->get();
            $categories = $categories->mapWithKeys(function($item){
                return [$item->id=>$item->name];
            });
            
            return view("admin.categories.edit", compact(["category","categories"]));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $id
         *
         * @return \Illuminate\Http\RedirectResponse
         * @internal param \App\Category $category
         *
         */
        public function update(Request $request, $id)
        {
            $category=Category::findOrFail($id);
            $category->name = $request->get("name");
            $category->description = $request->get("description");
            $category->parent_id = $request->get("parent_id")==0?null:$request->get("parent_id");
            $category->save();
    
            Toastr::success("De category is succesvol bijgewerkt");
    
            return Redirect::action("Admin\CategoryController@index");
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Category $category
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy($id)
        {
            $category=Category::find($id);
            if($category==null){
                Toastr::error("Deze category bestaat niet");
            }else{
                $category->delete();
    
                Toastr::success("De categorie ". $category->name ." is succesvol verwijderd");
            }
    
            return Redirect::action("Admin\CategoryController@index");
        }
    }
