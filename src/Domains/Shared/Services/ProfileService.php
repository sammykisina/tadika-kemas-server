<?php

declare(strict_types=1);

namespace Domains\Shared\Services;

use Domains\Shared\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService {
    public function getAllProfileData(string $email): User {
        return User::query()
          ->where('email', $email)
          ->with(['performances', 'notifications'])
          ->first();
    }

    public function changePassword(array $data): void {
        $user = User::query()->where('email', $data['email'])->first();

        $user->update([
            'password' => Hash::make(value: $data['password'])
        ]);
    } 
}
