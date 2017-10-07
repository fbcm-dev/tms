<?php
/**
 * Created by PhpStorm.
 * User: jeiel
 * Date: 10/7/2017
 * Time: 4:30 PM
 */

namespace TMS\Models\Observers;

use TMS\Models\Record;

class RecordsObserver
{
    public function created(Record $record){}

    public function creating(Record $record){
        $record->setCreatedByAttribute();
    }

}