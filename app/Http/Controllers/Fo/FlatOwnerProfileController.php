<?php

namespace App\Http\Controllers\Fo;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Flatlocation;
use App\Http\Controllers\Controller;
use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;

class FlatOwnerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();

        $user = Auth::user();
        $flatlocation = Flatlocation::where('id', Auth::user()->address_id)->where('status', '1')->first();
        if(empty($flatlocation)){
            $flatlocation = new Flatlocation();
        }
        return view('flat.pages.profile',compact('divisions', 'districts', 'thanas','user','flatlocation'));
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
        //
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
        //
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
        $request->validate([
            'division' => 'required',
            'district' => 'required',
            'thana' => 'required',
            'socity_name' => 'required',
            'road_number' => 'required',
            'block' => 'required',
            'house_number' => 'required',
            'flat_number' => 'required',
        ]);

       if(Auth::user()->address_id == null){
            $flatlocation = Flatlocation::create(array_merge($request->all(), ['user_id' => Auth::user()->id],['status' => '1']));
            $user = Auth::user();
            $user->update([
                'address_id'=>$flatlocation->id
            ]);
       }
       else{
            $flatlocation = Flatlocation::where('id', Auth::user()->address_id)->where('status', '1')->first();
            $flatlocation->fill($request->post())->save();
       }

        Session::flash('message', ['type'=>'success', 'message'=>'Profile Information Has Been updated successfully']);

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
