<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Users::get();
    }

    public function search(Request $request)
    {
        $search = $request->key;
        return Users::where('name', 'like', $search.'%')->orWhere('id', 'like', $search.'%')->orWhere('id', '=', $search)->orWhere('surname', 'like', $search.'%')->get();
        // return Users::where('id', '=', 1)->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(Users::$rules);
        $answers[] = [
            'name' => $request->name,
            'surname' => $request->surname,
        ];
        Users::insert($answers);

        return ['message' => 'Users Created'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //   $attributes = request()->validate(E06s::$rules_case_termination_date);
        // E06s::where('case_id', '=', $request->numbers['id'])->update([
        //     'case_termination_date' => $request->case_termination_date.'T00:00:00'
        // ]);

        // return ['message' => 'e06 Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Users::where('id', '=', $request->id)->delete();
    }
}
