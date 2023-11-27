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
use App\Models\Address;
use App\Models\Flatdetails;
use App\Models\Files;
use App\Models\Notification;
use Auth;

use App\Traits\FileTrait;
use App\Traits\NotificationTrait;

class FlatOwnerController extends Controller
{
    use FileTrait;
    use NotificationTrait;

    private $defaultValidations = [
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
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allflat = Flatdetails::where('user_id', Auth::user()->id)->count();
        $activeflat = Flatdetails::where('user_id', Auth::user()->id)->where('status', "1")->count();
        $inactiveflat = Flatdetails::where('user_id', Auth::user()->id)->where('status', "2")->count();
        $deleteflat = Flatdetails::where('user_id', Auth::user()->id)->where('status', "3")->count();

        return view('flat.pages.dashboard.dashboard',compact('allflat', 'activeflat', 'inactiveflat','deleteflat'));
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
        $request->validate($this->defaultValidations);

    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:10240'
    //    ]);

    //    if ($validator->fails()) {
    //     return redirect()->Back()->withInput()->withErrors($validator);
    //     }

    $fileids = [];
    if($request->file('file')) {
        $uploadable = 15;
        foreach($request->file('file') as $file){
            if($uploadable>0){
                $upload = $this->uploadFile($file,'flat-',Auth::user());
                $fileids[]=$upload->id;
            }
            $uploadable= $uploadable-1;
        }
    }

        $address = Address::create($request->all());

        $flatDetails = new Flatdetails;
        $flatDetails->address_id = $address->id;
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
        $flatDetails->user_id = Auth::user()->id;
        $flatDetails->images_id = sizeof($fileids)==0?NULL:implode(',',$fileids);

        $flatDetails->save();

        $title = 'New flat has been created.';
        $description='You have created your flat. Now update you flat and stay connected.';
        $event_type =config('variables.EVENT_TYPE.flat_create');

        $this->createNotification($title,$description,$flatDetails->id,$event_type);

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
        $flat = Flatdetails::where('id',$id)->first();
        return view('flat.pages.flatdetails', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $flat = Flatdetails::where('id',$id)->first();

        $divisions = Division::all();
        $districts = District::where('division_id',$flat->address->division)->get();
        $thanas = Thana::where('district_id',$flat->address->district)->get();

        return view('flat.pages.flatdetailsedit', compact('divisions', 'districts', 'thanas','flat'));
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
        $request->validate($this->defaultValidations);

        $flat = Flatdetails::where('id',$id)->first();
        $address = Address::where('id', $flat->address_id)->first();

        $image_count = empty($flat->images_id)?0:sizeof(explode(",",$flat->images_id));


        $fileids =  empty($flat->images_id)?[]:explode(",",$flat->images_id);

        if($request->file('file')) {
            $uploadable = 15-$image_count;
            foreach($request->file('file') as $file){
                if($uploadable>0){
                    $upload = $this->uploadFile($file,'flat-',Auth::user());
                    $fileids[]=$upload->id;
                }
                $uploadable= $uploadable-1;
            }
        }

        $flat->fill($request->post());
        $flat->images_id = sizeof($fileids)==0?NULL:implode(',',$fileids);
        $flat->save();


        $address->fill($request->post())->save();

        $title = 'Flat Details has been Updated.';
        $description='You have updated your flat details. Stay connected.';
        $event_type =config('variables.EVENT_TYPE.flat_update');

        $this->createNotification($title,$description,$flat->id,$event_type);


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
        $flat = Flatdetails::where('id',$id)->first();
        $address = Address::where('id', $flat->address_id)->first();

        $flat->status = 3;
        $address->status = 3;

        $flat->save();
        $address->save();

        $title = 'Flat has been Deleted.';
        $description='You have deleted your flat.';
        $event_type =config('variables.EVENT_TYPE.flat_delete');

        $this->createNotification($title,$description,$flat->id,$event_type);

        Session::flash('message', ['type'=>'danger', 'message'=>'Flat has been deleted successfully']);

        return redirect()->route('flat.allflat');

    }

    public function allflat(){
        $flats = Flatdetails::where('user_id', Auth::user()->id)->whereIn('status', [1, 2])->get();
        return view('flat.pages.showallflat', compact('flats'));
    }

    public function inactive( $id)
    {
        $address = Address::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$address->id)->first();

        $address->status = 2;
        $flatdetails->status = 2;

        $address->save();
        $flatdetails->save();

        Session::flash('message', ['type'=>'danger', 'message'=>'Flat has been inactivate successfully']);

        return redirect()->route('flat.allflat');
    }

    public function active( $id)
    {
        $address = Address::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$address->id)->first();

        $address->status = 1;
        $flatdetails->status = 1;

        $address->save();
        $flatdetails->save();

        Session::flash('message', ['type'=>'success', 'message'=>'Flat has been activate successfully']);

        return redirect()->route('flat.allflat');
    }

    public function inactiveflat()
    {
        $flats = Flatdetails::where('user_id', Auth::user()->id)->where('status', 2)->get();
        return view('flat.pages.showallflat', compact('flats'));
    }
    public function activeflat()
    {
        $flats = Flatdetails::where('user_id', Auth::user()->id)->where('status', 1)->get();
        return view('flat.pages.showallflat', compact('flats'));
    }

    public function addImage($id)
    {
        $address = Address::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$address->id)->first();
        return view('flat.pages.imageupload', compact('address','flatdetails'));

    }

    public function imageupload(Request $request, $id){

        $userid = Auth::user()->id;
        $address = Address::where('id', $id)->first();
        $flatdetails = Flatdetails::where('flat_id',$address->id)->first();

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

        return redirect()->route('flat.show',$address->id);
    }

    public function imagedelete( $id, $flatId)
    {
        // Remove image from flat
        $flat = Flatdetails::where('id', $flatId)->where('user_id', Auth::user()->id)->first();
        if(!$flat){
            Session::flash('message', ['type'=>'danger', 'message'=>'Invalid flat selected']);
            return redirect()->route('flat.show',$flatId);
        }

        $imagesIds = explode(",",$flat->images_id);
        $imagesIdsFiltered = array_filter($imagesIds, function ($element) use ($id) {
            return $element !== $id;
        });
        $flat->images_id = implode(',',$imagesIdsFiltered);
        $flat->save();

        // Update Image status
        $image = Files::where('id', $id)->where('created_by', Auth::user()->id)->first();
        if(!$image){
            Session::flash('message', ['type'=>'danger', 'message'=>'Invalid image selected']);
            return redirect()->route('flat.show',$flatId);
        }
        $image->status = 3;
        $image->save();

        $title = 'Flats image has been Deleted.';
        $description='You have deleted your flats image. You can add more flats image.';
        $event_type =config('variables.EVENT_TYPE.flat_update');

        $this->createNotification($title,$description,$flat->id,$event_type);

        Session::flash('message', ['type'=>'success', 'message'=>'Flat Image has been Delete successfully']);
        return redirect()->route('flat.show',$flat->id);
    }

    public function profile()
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();

        $user = Auth::user();
        $address = Address::where('user_id', Auth::user()->id)->where('status', '0')->first();
        //dd($address);
        return view('flat.pages.profile',compact('divisions', 'districts', 'thanas','user','address'));
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

       $address = Address::where('user_id', Auth::user()->id)->where('status', '0')->first();


       if($address == null){
            $address = Address::create(array_merge($request->all(), ['user_id' => Auth::user()->id],['status' => '0']));
       }
       else{
            $address->fill($request->post())->save();
       }

        Session::flash('message', ['type'=>'success', 'message'=>'Profile Information Has Been updated successfully']);

        return redirect()->route('flat.profile');
    }


}
