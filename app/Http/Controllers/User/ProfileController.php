<?php

namespace App\Http\Controllers\User;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Controllers\Controller;
use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use App\Traits\NotificationTrait;
use App\Traits\FileTrait;

class ProfileController extends Controller
{

    use NotificationTrait;
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $address = Address::where('id', Auth::user()->address_id)->where('status', '1')->first();

        if(empty($address)){
            $address = new Address();
            $divisions = Division::all();
            $districts = NULL;
            $thanas = NULL;
        }else{
            $divisions = Division::all();
            $districts = District::where('division_id',$address->division)->get();
            $thanas = Thana::where('district_id',$address->district)->get();
        }
        return view('user.profile',compact('divisions', 'districts', 'thanas','user','address'));
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
        $file = $request->file('file');
        $upload = $this->uploadFile($file,'flat-',Auth::user());

        Auth::user()->avatar = $upload->id;
        Auth::user()->save();

        die('success');
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
            $address = Address::create(array_merge($request->all(), ['user_id' => Auth::user()->id],['status' => '1']));
            $user = Auth::user();
            $user->update([
                'address_id'=>$address->id
            ]);
       }
       else{
            $address = Address::where('id', Auth::user()->address_id)->where('status', '1')->first();
            $address->fill($request->post())->save();
       }


        $title = 'Profile Info has been Updated.';
        $description='You have updated your profile information. Stay connected.';
        $event_type =config('variables.EVENT_TYPE.profile_update');

        $this->createNotification($title,$description,Auth::user()->address_id,$event_type);

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
