<?php
namespace Owchzzz\Syndicate\Listeners;

use Owchzzz\Syndicate\Mail\MemberInvitation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Owchzzz\Syndicate\Events\Organization\MemberInvited;

class SendMemberInvite
{
    public function handle(MemberInvited $event)
    {
        $pivot = $event->organization->members()->where($event->entity->getKeyName(), $event->entity->getKey())->first();

        $key = Crypt::encrypt($pivot->invite_key);
        Mail::to($event->entity->email)->queue(new MemberInvitation($key, $event->organization));
    }
}
