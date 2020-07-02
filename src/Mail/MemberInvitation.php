<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Owchzzz\Syndicate\Models\Organization;

class MemberInvitation extends Mailable
{
    use Queueable, SerializesModels;
    protected $organization;
    protected $invite_key;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $invite_key, Organization $organization)
    {
        $this->invite_key = $invite_key;
        $this->organization = $organization;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'invite_key' => $this->invite_key,
            'organization' => $this->organization
        ];

        return $this->markdown(config('syndicate.mail.member_invite'))->with($data);
    }
}
