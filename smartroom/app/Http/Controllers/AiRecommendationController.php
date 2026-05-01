<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Schedule;
use Carbon\Carbon;

class AiRecommendationController extends Controller
{
    /**
     * Return simple AI-like recommendations for available classrooms.
     *
     * This is a light-weight heuristic: pick classrooms that have no
     * schedules in the next N hours and sort by capacity descending.
     */
    public function index(Request $request)
    {
        $hours = (int) $request->query('hours', 2);
        $now = Carbon::now();
        $until = $now->copy()->addHours($hours);

        // classrooms that have schedules overlapping the window
        $busyClassroomIds = Schedule::where(function ($q) use ($now, $until) {
            $q->whereBetween('start_at', [$now, $until])
              ->orWhereBetween('end_at', [$now, $until])
              ->orWhere(function ($qq) use ($now, $until) {
                  $qq->where('start_at', '<=', $now)->where('end_at', '>=', $until);
              });
        })->pluck('classroom_id')->filter()->unique()->toArray();

        $candidates = Classroom::whereNotIn('id', $busyClassroomIds)
            ->where('status', '!=', 'unavailable')
            ->orderByDesc('capacity')
            ->limit(6)
            ->get();

        $recs = $candidates->map(function ($c, $idx) use ($now, $hours) {
            return [
                'id' => $c->id,
                'name' => $c->name,
                'building' => $c->building,
                'capacity' => (int) ($c->capacity ?? 0),
                'distance' => ($idx === 0) ? '1 min walk' : ($idx === 1 ? '2 min walk' : '4 min walk'),
                'free_for' => ($hours + ($idx % 2)),
                'score' => 90 - ($idx * 5),
                'features' => ['AC', 'Projector', 'WiFi'],
            ];
        })->values();

        return response()->json(['success' => true, 'recommendations' => $recs]);
    }
}
