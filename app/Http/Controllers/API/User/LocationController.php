<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;

use App\Exceptions\ApiException;

class LocationController extends Controller
{
    public function divisions ()
    {
        try {
            $divisions = Division::all();
            return $divisions;
        } catch (\Exception $e) {
            throw new ApiException(
                'NOT_FOUND',
                'Error while fetching divisions.',
                'Selected division not found','404'
            );
        }
    }

    public function districts ($id=null)
    {
        try {
            $districts = $id?District::where('division_id', $id)->get():District::all();
            if($districts->isEmpty()){
                throw new \Exception('Districts not found');
            }

            return $districts;
        } catch (\Exception $e) {
            throw new ApiException(
                'NOT_FOUND',
                $e->getMessage(),
                'Something wrong. Please try again',
                '404'
            );
        }
    }

    public function thanas ($id=null)
    {
        try {
            $thanas = $id?Thana::where('district_id', $id)->get():Thana::all();
            if($thanas->isEmpty()){
                throw new \Exception('Thanas not found');
            }

            return $thanas;
        } catch (\Exception $e) {
            throw new ApiException(
                'NOT_FOUND',
                $e->getMessage(),
                'Something wrong. Please try again',
                '404'
            );
        }
    }
}
