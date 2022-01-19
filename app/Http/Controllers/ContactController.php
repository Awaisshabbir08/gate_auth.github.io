<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function homeindex()
    {
        $userData = Contact::get();
        return view('contact.index',compact('userData'));
    }

    public function index()
    {
        $userData = Contact::get();
        // dd($userData);

        if(Gate::denies('isManger',$userData)){

            $userData = Contact::where('user_id',Auth::id())->get();
             return view('contact.show',compact('userData'));

        }
        $userData = Contact::get();
        return view('contact.show',compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contact::create([
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
        $userData = Contact::find($id);

        if(Gate::denies('isManger',$userData)){
            abort(403);
        }
        return view('contact.edit',compact('userData'));
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
        $userData = Contact::findorfail($id);
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
        $delete = Contact::findOrFail($id);
        $delete->delete();
        return redirect()->back();
    }
}
