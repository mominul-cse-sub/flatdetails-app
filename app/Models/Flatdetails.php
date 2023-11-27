<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Flatdetails extends Model
{
    use HasFactory;
    protected $fillable = ['address_id','flat_name','sft', 'bed_room', 'dining_room', 'drawing_room', 'bath_room', 'kitchen_room', 'store_room', 'belkuni', 'status', 'user_id','images_id'];


    /**
     * Get all of the address for the Flatdetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    /**
     * Get all of the files for the Flatdetails
     *
     */
    public function files(){
        return Files::whereIn('id',explode(',', $this->images_id))->get();
    }
}
