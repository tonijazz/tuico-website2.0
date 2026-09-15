<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StrategicArea;
use Illuminate\Auth\Access\HandlesAuthorization;

class StrategicAreaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StrategicArea');
    }

    public function view(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('View:StrategicArea');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StrategicArea');
    }

    public function update(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('Update:StrategicArea');
    }

    public function delete(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('Delete:StrategicArea');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:StrategicArea');
    }

    public function restore(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('Restore:StrategicArea');
    }

    public function forceDelete(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('ForceDelete:StrategicArea');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StrategicArea');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StrategicArea');
    }

    public function replicate(AuthUser $authUser, StrategicArea $strategicArea): bool
    {
        return $authUser->can('Replicate:StrategicArea');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StrategicArea');
    }

}