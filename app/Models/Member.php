<?php

namespace TMS\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\Auth;

class Member extends Model
{
    use CrudTrait;
    use Notifiable;
     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'members';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code', 'name', 'organization', 'created_by'
    ];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    /**
     *
     * Generates member code
     *
     * @param $name
     * @return string
     */
    protected function generateMemberCode($name = null)
    {
        if ($name == null) $name = $this->name;

        $expName = explode(' ', $name);
        $last_name = end($expName);
        $nameInitial = $last_name;

        foreach ($expName as $key) {
            if($key != $last_name){
                $tempNameInitial = substr($key, 0, 1);
                $nameInitial .= $tempNameInitial;
            }
        }

        return strtolower($nameInitial);
    }

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    public function member()
    {
        return $this->hasMany('TMS\Models\Record');
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

    public function setCodeAttribute(){
        $this->attributes['code'] = $this->generateMemberCode();
    }

    public function setCreatedByAttribute(){
        $this->attributes['created_by'] = Auth::user()->id;
    }
}
