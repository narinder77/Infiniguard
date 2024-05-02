<?php

namespace App\Policies;

use Log;
use App\Models\User;
use App\Models\CertifiedProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertifiedProviderPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(CertifiedProvider $certifiedProvider): bool
    {
    
        if ($certifiedProvider->isAdmin()) {
            return true;
        }
        return false;
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(CertifiedProvider $certifiedProvider): bool
    {
        if ($certifiedProvider->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(CertifiedProvider $certifiedProvider): bool
    {
        if ($certifiedProvider->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(CertifiedProvider $certifiedProvider): bool
    {
        return $certifiedProvider->provider_type === '1';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(CertifiedProvider $certifiedProvider): bool
    {
        return $certifiedProvider->provider_type === '1';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(CertifiedProvider $certifiedProvider): bool
    {
        return $certifiedProvider->provider_type === '1';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(CertifiedProvider $certifiedProvider): bool
    {
        return $certifiedProvider->provider_type === '1';
    }
}
