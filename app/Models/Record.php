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
         'created_by',
         'updated_by',
     ];
     // protected $hidden = [];

     protected $dates = [
         'created_at', 'updated_at'
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

    public function setCreatedByAttribute(){
        $this->attributes['created_by'] = Auth::user()->id;
    }

    public function setUpdatedByAttribute(){
        $this->attributes['updated_by'] = Auth::user()->id;
    }
}
