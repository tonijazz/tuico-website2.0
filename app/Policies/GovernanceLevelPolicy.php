<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GovernanceLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class GovernanceLevelPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GovernanceLevel');
    }

    public function view(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('View:GovernanceLevel');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GovernanceLevel');
    }

    public function update(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('Update:GovernanceLevel');
    }

    public function delete(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('Delete:GovernanceLevel');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:GovernanceLevel');
    }

    public function restore(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('Restore:GovernanceLevel');
    }

    public function forceDelete(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('ForceDelete:GovernanceLevel');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GovernanceLevel');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GovernanceLevel');
    }

    public function replicate(AuthUser $authUser, GovernanceLevel $governanceLevel): bool
    {
        return $authUser->can('Replicate:GovernanceLevel');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GovernanceLevel');
    }

}