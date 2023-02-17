<?php

declare(strict_types=1);

namespace Domains\Shared\Services;

use App\Http\Requests\Admin\StudentRegisterRequest;
use Carbon\Carbon;
use Domains\Shared\Models\Role;
use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StudentRegistrationService {
    public function calculateAge(Carbon $dateOfBirth): int {
        return Carbon::parse($dateOfBirth)->age;
    }

    public function create(StudentRegisterRequest $request): void {
        $studentRole = Role::query()->where("slug", 'student')->first();
        User::create([
            'reg_id' => $request->get(key: 'studentRegId'),
            'name' => $request->get(key: 'name'),
            'email' =>  $request->get(key: 'email'),
            'password'  => Hash::make(value:  $request->get(key: 'password')),
            'cob'  =>  $request->get(key: 'studentCob'),
            'race'  =>  $request->get(key: 'selectedRace'),
            'address'  =>  $request->get(key: 'address'),
            'class'  =>  $request->get(key: 'selectedClass'),
            'age'  =>  $this->calculateAge(dateOfBirth: new Carbon($request->get(key: 'dateOfBirth'))),
            'father_name'  =>  $request->get(key: 'fartherName'),
            'father_phone'  =>  $request->get(key: 'fartherPhone'),
            'mother_name'  =>  $request->get(key: 'motherName'),
            'mother_phone'  =>  $request->get(key: 'motherPhone'),
            'date_of_birth'  =>  $request->get(key: 'dateOfBirth'),
            'enroll_date'  =>  $request->get(key: 'dateOfEnrollment'),
            'role_id'  =>  $studentRole->id,
        ]);
    }

    public function updateStudent(array $validated, User $student): void {
        $student->update([
            'reg_id' => $validated['studentRegId'],
            'name' => $validated['name'],
            'email' =>  $validated['email'],
            'password'  => Hash::make(value:  $validated['password']),
            'cob'  => $validated['studentCob'],
            'race'  => $validated['selectedRace'],
            'address'  =>  $validated['address'],
            'class'  => $validated['selectedClass'],
            'age'  =>  $this->calculateAge(dateOfBirth: new Carbon($validated['dateOfBirth'])),
            'father_name'  => $validated['fartherName'],
            'father_phone'  => $validated['fartherPhone'],
            'mother_name'  =>  $validated['motherName'] ,
            'mother_phone'  =>  $validated['motherPhone'] ,
            'date_of_birth'  =>  $validated['dateOfBirth'],
            'enroll_date'  =>  $validated['dateOfEnrollment']
        ]);
    }

    public function getAllStudents(): Collection {
        return QueryBuilder::for(subject: User::class)
           ->allowedIncludes(includes: ['role', 'course', 'intake'])
           ->defaultSort('-created_at')
           ->allowedFilters(filters: AllowedFilter::exact('role.slug'))
           ->get();
    }

    public function deleteStudent(User $student): void {
        $student->delete();
    }
}
