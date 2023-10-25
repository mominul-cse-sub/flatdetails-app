<?php

namespace App\Http\Controllers\Fo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flatlocation;
use App\Models\Flatdetails;
use App\Models\Files;
use Auth;

class FlatOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('flat.pages.dashboard.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        return view("flat.pages.registration",compact('divisions', 'districts', 'thanas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'flat_name' => 'required',
            'sft' => 'required',
            'bed_room' => 'required',
            'dining_room' => 'required',
            'drawing_room' => 'required',
            'bath_room' => 'required',
            'kitchen_room' => 'required',
            'store_room' => 'required',
            'belkuni' => 'required',
            'status' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:10240'
       ]);

       if ($validator->fails()) {
        return redirect()->Back()->withInput()->withErrors($validator);
        }

        $flatlocation = Flatlocation::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));

        $flatDetails = new Flatdetails;
        $flatDetails->flat_id = $flatlocation->id;
        $flatDetails->flat_name = $request->input('flat_name');
        $flatDetails->sft = $request->input('sft');
        $flatDetails->bed_room = $request->input('bed_room');
        $flatDetails->dining_room = $request->input('dining_room');
        $flatDetails->drawing_room = $request->input('drawing_room');
        $flatDetails->bath_room = $request->input('bath_room');
        $flatDetails->kitchen_room = $request->input('kitchen_room');
        $flatDetails->store_room = $request->input('store_room');
        $flatDetails->belkuni = $request->input('belkuni');
        $flatDetails->status = $request->input('status');

        $flatDetails->save();

        if($request->file('file')) {

                $image = $request->file('file');
                $imagename = File::name($image->getClientOriginalName());
                $newName = $flatlocation->id.'-flat-'.sha1(microtime(true).File::name($image->getClientOriginalName()));
                $mime = $image->getMimeType();
                $extension = File::extension($image->getClientOriginalName());

                // File upload location
                $location = 'uploads'. '/' . $newName.'.'.$extension;
                $thumb_location = 'uploads'. '/200X200-' . $newName.'.'.$extension;

                $img = Image::make($image->getRealPath())
                    ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    });

                $img->save(public_path($location));

                $thumbImg = Image::make($image->getRealPath())
                    ->fit(200, 200);

                $thumbImg->save(public_path($thumb_location));

                // Insert record
                $insertData_arr = array(
                    'flat_id' => $flatDetails->flat_id,
                    'name' => $imagename,
                    'mime_type' => $mime,
                    'file_extension' => $extension,
                    'created_by' => Auth::user()->id,
                    'status'=> 1,
                    'imagepath' => '/'.$location,
                );

                Files::create($insertData_arr);

                // Session
                Session::flash('message', ['type'=>'success', 'message'=>'Image Upload successfully.']);

        }else{

                // Session
                Session::flash('message', ['type'=>'danger', 'message'=>'Image not Uploaded.']);
        }

        Session::flash('message', ['type'=>'success', 'message'=>'Flat data has been created successfully.']);

        return redirect()->route('flat.allflat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();
        $images = Files::where('flat_id',$flatlocation->id)->where('status',1)->get();
        return view('flat.pages.flatdetails', compact('flatlocation','flatdetails','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();

        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();
        $images = Files::where('flat_id',$flatlocation->id)->where('status',1)->get();
        return view('flat.pages.flatdetailsedit', compact('divisions', 'districts', 'thanas','flatlocation','flatdetails','images'));
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
            'flat_name' => 'required',
            'sft' => 'required',
            'bed_room' => 'required',
            'dining_room' => 'required',
            'drawing_room' => 'required',
            'bath_room' => 'required',
            'kitchen_room' => 'required',
            'store_room' => 'required',
            'belkuni' => 'required',
            'status' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:10240'
       ]);

       $flatlocation = Flatlocation::where('id', $id)->first();
       $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();

       if($request->file('file')){
            if ($validator->fails()) {
                return redirect()->Back()->withInput()->withErrors($validator);
            }
            else{
                $image = $request->file('file');
                $imagename = File::name($image->getClientOriginalName());
                $newName = $flatlocation->id.'-flat-'.sha1(microtime(true).File::name($image->getClientOriginalName()));
                $mime = $image->getMimeType();
                $extension = File::extension($image->getClientOriginalName());

                // File upload location
                $location = 'uploads'. '/' . $newName.'.'.$extension;
                $thumb_location = 'uploads'. '/200X200-' . $newName.'.'.$extension;

                $img = Image::make($image->getRealPath())
                    ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    });

                $img->save(public_path($location));

                $thumbImg = Image::make($image->getRealPath())
                    ->fit(200, 200);

                $thumbImg->save(public_path($thumb_location));

                // Insert record
                $insertData_arr = array(
                    'flat_id' => $flatdetails->flat_id,
                    'name' => $imagename,
                    'mime_type' => $mime,
                    'file_extension' => $extension,
                    'created_by' => Auth::user()->id,
                    'status'=> 1,
                    'imagepath' => '/'.$location,
                );

                Files::create($insertData_arr);

                }
       }

        $flatlocation->fill($request->post())->save();
        $flatdetails->fill($request->post())->save();

        Session::flash('message', ['type'=>'success', 'message'=>'Flat Details Has Been updated successfully']);

        return redirect()->route('flat.allflat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();

        $flatlocation->status = 3;
        $flatdetails->status = 3;

        $flatlocation->save();
        $flatdetails->save();

        Session::flash('message', ['type'=>'danger', 'message'=>'Flat has been deleted successfully']);

        return redirect()->route('flat.allflat');

    }

    public function allflat(){
        $flatlocations = Flatlocation::where('user_id', Auth::user()->id)->whereIn('status', [1, 2])->get();
        return view('flat.pages.showallflat', compact('flatlocations'));
    }

    public function inactive( $id)
    {
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();

        $flatlocation->status = 2;
        $flatdetails->status = 2;

        $flatlocation->save();
        $flatdetails->save();

        Session::flash('message', ['type'=>'danger', 'message'=>'Flat has been inactivate successfully']);

        return redirect()->route('flat.allflat');
    }

    public function active( $id)
    {
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();

        $flatlocation->status = 1;
        $flatdetails->status = 1;

        $flatlocation->save();
        $flatdetails->save();

        Session::flash('message', ['type'=>'success', 'message'=>'Flat has been activate successfully']);

        return redirect()->route('flat.allflat');
    }

    public function inactiveflat()
    {
        $flatlocations = Flatlocation::where('user_id', Auth::user()->id)->where('status', 2)->get();
        return view('flat.pages.showallflat', compact('flatlocations'));
    }
    public function activeflat()
    {
        $flatlocations = Flatlocation::where('user_id', Auth::user()->id)->where('status', 1)->get();
        return view('flat.pages.showallflat', compact('flatlocations'));
    }

    public function addImage($id)
    {
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();
        return view('flat.pages.imageupload', compact('flatlocation','flatdetails'));

    }

    public function imageupload(Request $request, $id){

        $userid = Auth::user()->id;
        $flatlocation = Flatlocation::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$flatlocation->id)->first();

        $validator = Validator::make($request->all(), [
             'file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:10240'
        ]);

        if ($validator->fails()) {
             return redirect()->Back()->withInput()->withErrors($validator);
        }else{

             if($request->file('file')) {

                    $image = $request->file('file');
                    $imagename = File::name($image->getClientOriginalName());
                    $newName = $id.'-flat-'.sha1(microtime(true).File::name($image->getClientOriginalName()));
                    $mime = $image->getMimeType();
                    $extension = File::extension($image->getClientOriginalName());

                   // File upload location
                   $location = 'uploads'. '/' . $newName.'.'.$extension;
                   $thumb_location = 'uploads'. '/200X200-' . $newName.'.'.$extension;

                    $img = Image::make($image->getRealPath())
                        ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        });

                    $img->save(public_path($location));

                    $thumbImg = Image::make($image->getRealPath())
                        ->fit(200, 200);

                    $thumbImg->save(public_path($thumb_location));

                   // Insert record
                   $insertData_arr = array(
                        'flat_id' => $flatdetails->id,
                        'name' => $imagename,
                        'mime_type' => $mime,
                        'file_extension' => $extension,
                        'created_by' => $userid,
                        'status'=> 1,
                        'imagepath' => '/'.$location,
                   );

                   Files::create($insertData_arr);

                   // Session
                   Session::flash('message', ['type'=>'success', 'message'=>'Image Upload successfully.']);

             }else{

                   // Session
                   Session::flash('message', ['type'=>'danger', 'message'=>'Image not Uploaded.']);
             }

        }

        return redirect()->route('flat.show',$flatlocation->id);
    }

    public function imagedelete( $id)
    {
        $image = Files::where('id', $id)->first();

        $image->status = 3;

        $image->save();

        Session::flash('message', ['type'=>'danger', 'message'=>'Flat Image has been Delete successfully']);

        return redirect()->route('flat.show',$image->flat_id);

    }

    public function profile()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();

        $user = Auth::user();
        $flatlocation = Flatlocation::where('user_id', Auth::user()->id)->where('status', '0')->first();
        //dd($flatlocation);
        return view('flat.pages.profile',compact('divisions', 'districts', 'thanas','user','flatlocation'));
    }

    public function profileupdate(Request $request)
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

       $flatlocation = Flatlocation::where('user_id', Auth::user()->id)->where('status', '0')->first();


       if($flatlocation == null){
            $flatlocation = Flatlocation::create(array_merge($request->all(), ['user_id' => Auth::user()->id],['status' => '0']));
       }
       else{
            $flatlocation->fill($request->post())->save();
       }

        Session::flash('message', ['type'=>'success', 'message'=>'Profile Information Has Been updated successfully']);

        return redirect()->route('flat.profile');
    }


}
