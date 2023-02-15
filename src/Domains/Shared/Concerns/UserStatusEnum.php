<?php

declare(strict_types=1);

namespace Domains\Shared\Concerns;

enum UserStatusEnum: string {
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
