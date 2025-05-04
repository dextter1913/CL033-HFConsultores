<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir que un usuario modifique solo su propio registro
     * o que tenga rol 'admin'.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    // Opcional: bloque global para super-admins
    public function before(User $user, $ability)
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    }
}
