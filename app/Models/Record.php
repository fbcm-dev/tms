<?php

namespace TMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\Auth;

class Record extends Model
{
    use CrudTrait;
    use Notifiable;
     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'records';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
     protected $fillable = [
         'member_id',
         'service_type',
         'for_date',
         'status',
         'tithe_amnt',
         'faith_amnt',
         'love_amnt',
         'special_offering',
         'special_offering_details',
         'encoded_by',
         'verified_by',
     ];
     // protected $hidden = [];
     protected $dates = [
         'encoded_at', 'verified_at'
     ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function records()
    {
        return $this->belongsTo('TMS\Models\Member');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setEncodedByAttribute(){
        $this->attributes['encoded_by'] = Auth::user()->id;
    }

    public function setVerifiedByAttribute(){
        $this->attributes['verified_by'] = Auth::user()->id;
    }
}
