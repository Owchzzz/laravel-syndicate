<?php

namespace Owchzzz\Syndicate\Events\Organization;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Owchzzz\Syndicate\Models\Organization;

abstract class MemberEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Model $entity the removed entity
     */
    protected Model $entity;
    
    /**
     * @var Organization $organization the organization that was acting upon the removal
     */ 
    protected Organization $organization;

    /**
     * @var Model $entity (optional) The notifying entity.
     */
    protected Model $notifier;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model, Organization $organization, Model $notifier = null)
    {
        $this->entity = $model;
        $this->organization = $organization;
        $this->notifier = $notifier;
    }
}
