<?php

namespace App\Http\Controllers\Fo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;

class FlatApiController extends Controller
{
    public function divisions ()
    {
        return Division::all();
    }

    public function districts ($id=null)
    {
        return $id?District::where('division_id', $id)->get():District::all();
    }

    public function thanas ($id=null)
    {
        return $id?Thana::where('district_id', $id)->get():Thana::all();
    }


    public function test(){

    }
}
