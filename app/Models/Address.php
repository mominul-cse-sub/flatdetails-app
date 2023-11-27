<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['division', 'district', 'thana', 'socity_name', 'road_number', 'block', 'house_number','flat_number', 'status'];


    /**
     * Get all of the comments for the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function divisionInfo(): HasOne
    {
        return $this->hasOne(Division::class, 'id', 'division');
    }

    public function districtInfo(): HasOne
    {
        return $this->hasOne(District::class, 'id', 'district');
    }

    public function thanaInfo(): HasOne
    {
        return $this->hasOne(Thana::class, 'id', 'thana');
    }
}
