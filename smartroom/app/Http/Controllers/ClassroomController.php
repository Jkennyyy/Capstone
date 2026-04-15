<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreClassroomRequest;
use App\Http\Requests\Api\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');

        $query = Classroom::query()->with([
            'schedules' => function ($q): void {
                $q->with(['course.instructor'])->latest('start_at');
            },
        ]);

        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        $classrooms = $query->latest('id')->get();

        return view('frontend.admin.classrooms', [
            'classrooms' => $classrooms,
            'filter' => $filter,
        ]);
    }

    public function show(int $id): View
    {
        $classroom = Classroom::query()
            ->with([
                'schedules.course.instructor',
                'accessLogs.user',
            ])
            ->findOrFail($id);

        return view('frontend.admin.classroom-detail', [
            'classroom' => $classroom,
        ]);
    }

    public function store(StoreClassroomRequest $request): RedirectResponse|JsonResponse
    {
        $payload = $request->validated();
        $payload['status'] = strtolower((string) ($payload['status'] ?? 'available'));

        if (! in_array($payload['status'], ['maintenance', 'unavailable'], true)) {
            $payload['unavailable_reason'] = null;
        }

        $classroom = Classroom::create($payload);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Classroom created successfully.', 'data' => $classroom], 201);
        }

        return redirect()->route('admin.classrooms')->with('status', 'Classroom created successfully.');
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse|JsonResponse
    {
        $payload = $request->validated();

        if (array_key_exists('status', $payload)) {
            $payload['status'] = strtolower((string) $payload['status']);
            if (! in_array($payload['status'], ['maintenance', 'unavailable'], true)) {
                $payload['unavailable_reason'] = null;
            }
        }

        $classroom->update($payload);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Classroom updated successfully.', 'data' => $classroom]);
        }

        return redirect()->route('admin.classrooms.show', $classroom->id)->with('status', 'Classroom updated successfully.');
    }

    public function destroy(Request $request, Classroom $classroom): RedirectResponse|JsonResponse
    {
        $classroom->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Classroom deleted successfully.']);
        }

        return redirect()->route('admin.classrooms')->with('status', 'Classroom deleted successfully.');
    }
}
