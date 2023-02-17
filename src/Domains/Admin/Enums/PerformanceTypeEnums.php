<?php

declare(strict_types=1);

namespace Domains\Admin\Enums;

enum PerformanceTypeEnums: int {
    case ASSIGNMENT = 15;
    case CAT = 30;
    case EXAM = 70;
}
