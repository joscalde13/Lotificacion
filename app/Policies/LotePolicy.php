<?php

namespace App\Policies;

use App\Models\Lote;
use App\Models\User;

class LotePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['asesor', 'oficina'], true);
    }

    public function view(User $user, Lote $lote): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Lote $lote): bool
    {
        return $user->role === 'oficina';
    }
}
