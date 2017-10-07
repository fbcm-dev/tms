<?php

namespace TMS\Models\Observers;

use TMS\Models\Member;

/**
 * Class MemberObserver
 * @package TMS\Models\Observers
 *
 * listens to Member Model
 */
class MemberObserver
{
    public function created(Member $member){}

    public function creating(Member $member){
       $member->setCodeAttribute();
       $member->setCreatedByAttribute(); //test
    }
}
