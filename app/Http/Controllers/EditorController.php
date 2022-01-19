<?php

namespace App\Http\Controllers;

use App\Models\editor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function homeindex()
    {
        $userData = editor::get();
        return view('blog.index',compact('userData'));
    }

    public function index()
    {
        $userData = editor::get();
        // dd($userData);

        if(Gate::denies('isManger',$userData)){

            $userData = editor::where('user_id',Auth::id())->get();
           return view('blog.show',compact('userData'));

        }
        $userData = editor::get();
        return view('blog.show',compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        editor::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id'=>Auth::id(),
        ]);

    return redirect()->route('ManagershowPost');
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
        $userData = editor::find($id);

        if(Gate::denies('isManger',$userData)){
            abort(403);
        }
        return view('blog.edit',compact('userData'));
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
        $userData = editor::findorfail($id);
        $userData->fill([
        'title' => $request->title,
        'description' => $request->description,
       ])->save();

       return redirect()->route('ManagershowPost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = editor::findOrFail($id);
        $delete->delete();
        return redirect()->back();
    }
}
