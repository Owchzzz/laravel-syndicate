<?php
namespace RichardAbear\Syndicate;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use RichardAbear\Syndicate\Events\Organization\MemberInvited;
use RichardAbear\Syndicate\Listeners\SendMemberInvite;

class SyndicateEventsProvider extends EventServiceProvider
{
    protected $listen = [
        MemberInvited::class => [
            SendMemberInvite::class
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}
