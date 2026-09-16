<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\StudentList;
use App\Models\TeacherList;
use App\Models\user_role;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /** Register application services. */
    public function register(): void
    {
        //
    }

    /** Set up application rules that are available on every request. */
    public function boot(): void
    {

        Gate::define('access-admin-dashboard', function (Authenticatable $user): bool {
            return $user instanceof Admin && $user->role_id === user_role::ADMIN_ID;
        });

        Gate::define('edit-own-admin-profile', function (Authenticatable $user): bool {
            return $user instanceof Admin && $user->role_id === user_role::ADMIN_ID;
        });

        Gate::define('manage-classes', function (Authenticatable $user): bool {
            return $user instanceof Admin && $user->role_id === user_role::ADMIN_ID;
        });

        // Teacher list.
        Gate::define('isTeacher', function (Authenticatable $user): bool {
            return $user->role_id === user_role::ADMIN_ID;
        });

        // Student list.
        Gate::define('isStudent', function (Authenticatable $user): bool {
            return in_array($user->role_id, [user_role::ADMIN_ID, user_role::TEACHER_ID], true);
        });

        // Teacher Profile
        Gate::define('view-teacher-profile', function (Authenticatable $user, TeacherList $teacher): bool {
            return $user->role_id === user_role::ADMIN_ID
                || ($user->role_id === user_role::TEACHER_ID && $user->id === $teacher->id);
        });

        // Student Profile
        Gate::define('view-student-profile', function (Authenticatable $user, StudentList $student): bool {
            return in_array($user->role_id, [user_role::ADMIN_ID, user_role::TEACHER_ID], true)
                || ($user->role_id === user_role::STUDENT_ID && $user->id === $student->id);
        });

        Gate::define('update-student-profile', function (Authenticatable $user, StudentList $student): bool {
            return in_array($user->role_id, [user_role::ADMIN_ID, user_role::TEACHER_ID], true)
                || ($user->role_id === user_role::STUDENT_ID && $user->id === $student->id);
        });

        Paginator::useBootstrapFive();

        $this->configureDefaults();
    }

    /** Configure Laravel defaults for dates, production safety, and passwords. */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
