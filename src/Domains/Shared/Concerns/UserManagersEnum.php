<?php

declare(strict_types=1);

namespace Domains\Shared\Concerns;

enum UserManagersEnum: string {
    case SYSTEM = 'system';
    case ADMIN = 'admin';
}
