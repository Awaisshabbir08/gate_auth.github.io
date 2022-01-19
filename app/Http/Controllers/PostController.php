<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function homeindex()
    {
        $userData = post::get();
        return view('home.index',compact('userData'));
    }

    public function index()
    {
        $userData = post::all();
        // dd($userData);

        if(Gate::denies('isAdmin',$userData)){
        // dd($userData);

        $userData = post::where('user_id',Auth::id())->get();
        return view('home.index',compact('userData'));

        }

        $userData = post::all();
        return view('home.show',compact('userData'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id'=>Auth::id(),
        ]);

    return redirect()->route('showPost');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userData = post::find($id);

        if(Gate::denies('isAdmin',$userData)){
            abort(403);
        }
        return view('home.edit',compact('userData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userData = post::findorfail($id);
        $userData->fill([
        'title' => $request->title,
        'description' => $request->description,
       ])->save();

       return redirect()->route('showPost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = post::findOrFail($id);
        $delete->delete();
        return redirect()->back();
    }
}
