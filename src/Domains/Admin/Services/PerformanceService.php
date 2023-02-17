<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use Domains\Admin\Enums\PerformanceTypeEnums;
use Domains\Admin\Models\Performance;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class PerformanceService {
    public function getAllPerformances(): Collection {
        return QueryBuilder::for(subject: Performance::class)
            ->allowedIncludes(includes: ['student'])
            ->defaultSort('-created_at')
            ->get();
    }

    public function createPerformance(array $studentPerformanceData): void {
        Performance::create($studentPerformanceData);
    }

    public function updatePerformance(array $studentUpdateData, Performance $performance): void {
        $performance->update($studentUpdateData);
    }

    public function getTotalAwarding(string $type): int {
        return match ($type) {
            'cat' => PerformanceTypeEnums::CAT->value,
            'assignment' => PerformanceTypeEnums::ASSIGNMENT->value,
            'exam' => PerformanceTypeEnums::EXAM->value
        };
    }

    public function getPerformanceStatus(string $type, int $marks): string {
        $percentageResults = ($marks / $this->getTotalAwarding(type: $type)) * 100;
        if ($percentageResults > 40) {
            return 'passed';
        }

        return 'failed';
    }

    public function checkIfASimilarPerformanceExists(
        int $studentId,
        string $type,
        string $period,
        string $year,
        string $subject
    ) {
        return Performance::query()
            ->where('studentId', $studentId)
            ->where('type', $type)
            ->where('period', $period)
            ->where('year', $year)
            ->where('subject', $subject)
            ->first();
    }
}
