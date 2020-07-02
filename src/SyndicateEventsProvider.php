<?php
namespace Owchzzz\Syndicate;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Owchzzz\Syndicate\Events\Organization\MemberInvited;
use Owchzzz\Syndicate\Listeners\SendMemberInvite;

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
