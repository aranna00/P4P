<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(["business"])->paginate(8);

        return view('admin.users.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businesses = Business::all();

        return view("admin.users.create", compact(["businesses"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $credentials = [
            'email' => $request->get("email"),
            'password' => bin2hex(random_bytes(8)),
            "first_name" => $request->get("first_name"),
            "last_name " => $request->get("last_name"),
            "business_id" => (int)$request->get("business")
        ];

        \Sentinel::registerAndActivate($credentials);

        Toastr::success("De gebruiker is succesvol aangemaakt");

        return Redirect::action("Admin\UserController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->first_name = $request->get("first_name");
        $user->last_name = $request->get("last_name");
        $user->email = $request->get("email");

        if ($request->get("generate_new_password")) {
            $user->password = password_hash(bin2hex((random_bytes(8))), 1);
            // mail to user
        }

        $user->save();

        return \Redirect::action("Admin\UserController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user == null) {
            Toastr::error("Deze gebruiker bestaat niet");
        } else
        {
            $user->delete();
            Toastr::success("De gebruiker ". $user->name ." is succesvol verwijderd");
        }
        return Redirect::action("Admin\UserController@index");
    }
}
