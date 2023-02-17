<?php

declare(strict_types=1);

namespace Domains\Admin\Models;

use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'purpose',
        'date',
        'time'
    ];
}
