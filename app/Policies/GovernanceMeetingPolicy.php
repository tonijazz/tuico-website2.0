<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GovernanceMeeting;
use Illuminate\Auth\Access\HandlesAuthorization;

class GovernanceMeetingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GovernanceMeeting');
    }

    public function view(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('View:GovernanceMeeting');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GovernanceMeeting');
    }

    public function update(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('Update:GovernanceMeeting');
    }

    public function delete(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('Delete:GovernanceMeeting');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:GovernanceMeeting');
    }

    public function restore(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('Restore:GovernanceMeeting');
    }

    public function forceDelete(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('ForceDelete:GovernanceMeeting');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GovernanceMeeting');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GovernanceMeeting');
    }

    public function replicate(AuthUser $authUser, GovernanceMeeting $governanceMeeting): bool
    {
        return $authUser->can('Replicate:GovernanceMeeting');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GovernanceMeeting');
    }

}