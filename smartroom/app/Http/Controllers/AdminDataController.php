<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreAccessCardRequest;
use App\Http\Requests\Api\StoreAccessLogRequest;
use App\Http\Requests\Api\StoreCourseRequest;
use App\Http\Requests\Api\UpdateAccessCardRequest;
use App\Http\Requests\Api\UpdateAccessLogRequest;
use App\Http\Requests\Api\UpdateCourseRequest;
use App\Mail\TemporaryPasswordMail;
use App\Models\AccessCard;
use App\Models\AccessLog;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class AdminDataController extends Controller
{
    public function storeUser(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'department' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:admin,faculty,student'],
        ]);

        $tempPassword = Str::random(random_int(8, 12));

        $emailSent = false;

        try {
            $user = User::create([
                'name' => trim($validated['first_name'].' '.$validated['last_name']),
                'email' => $validated['email'],
                'password' => Hash::make($tempPassword),
                'must_change_password' => true,
                'department' => $validated['department'] ?? null,
                'role' => $validated['role'],
            ]);
        } catch (Throwable $exception) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unable to create user.',
                ], 500);
            }

            return back()->withErrors([
                'email' => 'Unable to create user. Please try again.',
            ])->withInput();
        }

        try {
            Mail::to($user->email)->send(new TemporaryPasswordMail($user, $tempPassword));
            $emailSent = true;
        } catch (Throwable $exception) {
            report($exception);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $emailSent
                    ? 'User created successfully. Temporary password sent by email.'
                    : 'User created successfully, but the temporary password email could not be sent.',
                'email_sent' => $emailSent,
                'data' => $user,
            ], 201);
        }

        if ($emailSent) {
            return redirect()->route('admin.users')->with('status', 'User created successfully. Temporary password sent by email.');
        }

        return redirect()->route('admin.users')->with('warning', 'User created, but email sending failed. Please verify SMTP settings and manually reset password if needed.');
    }

    public function storeCourse(StoreCourseRequest $request): RedirectResponse|JsonResponse
    {
        $course = Course::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Course created successfully.', 'data' => $course], 201);
        }

        return redirect()->back()->with('status', 'Course created successfully.');
    }

    public function updateCourse(UpdateCourseRequest $request, Course $course): RedirectResponse|JsonResponse
    {
        $course->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Course updated successfully.', 'data' => $course]);
        }

        return redirect()->back()->with('status', 'Course updated successfully.');
    }

    public function destroyCourse(Request $request, Course $course): RedirectResponse|JsonResponse
    {
        $course->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Course deleted successfully.']);
        }

        return redirect()->back()->with('status', 'Course deleted successfully.');
    }

    public function storeAccessCard(StoreAccessCardRequest $request): RedirectResponse|JsonResponse
    {
        $card = AccessCard::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access card created successfully.', 'data' => $card], 201);
        }

        return redirect()->back()->with('status', 'Access card created successfully.');
    }

    public function updateAccessCard(UpdateAccessCardRequest $request, AccessCard $accessCard): RedirectResponse|JsonResponse
    {
        $accessCard->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access card updated successfully.', 'data' => $accessCard]);
        }

        return redirect()->back()->with('status', 'Access card updated successfully.');
    }

    public function destroyAccessCard(Request $request, AccessCard $accessCard): RedirectResponse|JsonResponse
    {
        $accessCard->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access card deleted successfully.']);
        }

        return redirect()->back()->with('status', 'Access card deleted successfully.');
    }

    public function storeAccessLog(StoreAccessLogRequest $request): RedirectResponse|JsonResponse
    {
        $accessLog = AccessLog::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access log created successfully.', 'data' => $accessLog], 201);
        }

        return redirect()->back()->with('status', 'Access log created successfully.');
    }

    public function updateAccessLog(UpdateAccessLogRequest $request, AccessLog $accessLog): RedirectResponse|JsonResponse
    {
        $accessLog->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access log updated successfully.', 'data' => $accessLog]);
        }

        return redirect()->back()->with('status', 'Access log updated successfully.');
    }

    public function destroyAccessLog(Request $request, AccessLog $accessLog): RedirectResponse|JsonResponse
    {
        $accessLog->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Access log deleted successfully.']);
        }

        return redirect()->back()->with('status', 'Access log deleted successfully.');
    }

    public function updateUser(Request $request, User $user): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'department' => ['nullable', 'string', 'max:255'],
            'role' => ['sometimes', 'string', 'in:admin,faculty,student'],
        ]);

        $user->update($validated);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'User updated successfully.', 'data' => $user->fresh()]);
        }

        return redirect()->back()->with('status', 'User updated successfully.');
    }

    public function destroyUser(Request $request, User $user): RedirectResponse|JsonResponse
    {
        $user->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'User deleted successfully.']);
        }

        return redirect()->back()->with('status', 'User deleted successfully.');
    }
}
