<?php
namespace RichardAbear\Syndicate\Contracts;

interface OrganizationInterface
{
    /**
     * Returns all members of that organization.
     *
     */
    public function members();

    /**
     * Get the member manager class that will be used for managing invite_options
     *
     */
    public function getMemberManager();
}
