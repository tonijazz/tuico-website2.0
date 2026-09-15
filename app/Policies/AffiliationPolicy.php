<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Affiliation;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Affiliation');
    }

    public function view(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('View:Affiliation');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Affiliation');
    }

    public function update(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('Update:Affiliation');
    }

    public function delete(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('Delete:Affiliation');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Affiliation');
    }

    public function restore(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('Restore:Affiliation');
    }

    public function forceDelete(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('ForceDelete:Affiliation');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Affiliation');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Affiliation');
    }

    public function replicate(AuthUser $authUser, Affiliation $affiliation): bool
    {
        return $authUser->can('Replicate:Affiliation');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Affiliation');
    }

}