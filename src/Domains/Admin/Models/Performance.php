<?php

declare(strict_types=1);

namespace Domains\Admin\Models;

use Domains\Shared\Concerns\HasUuid;
use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model {
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'period',
        'year',
        'subject',
        'marks',
        'status',
        'comment',
        'studentId',
        'totalAwarding',
        'type'
    ];

    public function student(): BelongsTo {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'studentId'
        );
    }
}
