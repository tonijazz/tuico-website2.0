<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ResourceCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourceCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ResourceCategory');
    }

    public function view(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('View:ResourceCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ResourceCategory');
    }

    public function update(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('Update:ResourceCategory');
    }

    public function delete(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('Delete:ResourceCategory');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ResourceCategory');
    }

    public function restore(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('Restore:ResourceCategory');
    }

    public function forceDelete(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('ForceDelete:ResourceCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ResourceCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ResourceCategory');
    }

    public function replicate(AuthUser $authUser, ResourceCategory $resourceCategory): bool
    {
        return $authUser->can('Replicate:ResourceCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ResourceCategory');
    }

}