<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SecretaryGeneralMessage;
use Illuminate\Auth\Access\HandlesAuthorization;

class SecretaryGeneralMessagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SecretaryGeneralMessage');
    }

    public function view(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('View:SecretaryGeneralMessage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SecretaryGeneralMessage');
    }

    public function update(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('Update:SecretaryGeneralMessage');
    }

    public function delete(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('Delete:SecretaryGeneralMessage');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SecretaryGeneralMessage');
    }

    public function restore(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('Restore:SecretaryGeneralMessage');
    }

    public function forceDelete(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('ForceDelete:SecretaryGeneralMessage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SecretaryGeneralMessage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SecretaryGeneralMessage');
    }

    public function replicate(AuthUser $authUser, SecretaryGeneralMessage $secretaryGeneralMessage): bool
    {
        return $authUser->can('Replicate:SecretaryGeneralMessage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SecretaryGeneralMessage');
    }

}