<?php

declare(strict_types=1);

namespace Domains\Shared\Models;

use Database\Factories\UserFactory;;
use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasUuid;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'uuid',
        'reg_id',
        'name',
        'email',
        'password',
        'cod',
        'race',
        'address',
        'class',
        'age',
        'father_name',
        'father_phone',
        'mother_name',
        'mother_phone',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo {
        return $this->belongsTo(
            related: Role::class,
            foreignKey: 'role_id'
        );
    }

    protected static function newFactory(): UserFactory {
        return new UserFactory;
    }
}
