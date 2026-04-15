<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAccessLogRequest;
use App\Http\Requests\Api\UpdateAccessLogRequest;
use App\Http\Resources\AccessLogResource;
use App\Models\AccessLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AccessLog::query()->with(['accessCard', 'classroom', 'user']);

        if ($request->filled('classroom_id')) {
            $query->where('classroom_id', $request->integer('classroom_id'));
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->integer('user_id'));
        }

        if ($request->filled('result')) {
            $query->where('result', $request->string('result'));
        }

        if ($request->filled('direction')) {
            $query->where('direction', $request->string('direction'));
        }

        $logs = $query->latest('accessed_at')->paginate($request->integer('per_page', 50));

        return AccessLogResource::collection($logs);
    }

    public function store(StoreAccessLogRequest $request): AccessLogResource
    {
        $log = AccessLog::create($request->validated())->load(['accessCard', 'classroom', 'user']);

        return new AccessLogResource($log);
    }

    public function show(AccessLog $accessLog): AccessLogResource
    {
        return new AccessLogResource($accessLog->load(['accessCard', 'classroom', 'user']));
    }

    public function update(UpdateAccessLogRequest $request, AccessLog $accessLog): AccessLogResource
    {
        $accessLog->update($request->validated());

        return new AccessLogResource($accessLog->fresh()->load(['accessCard', 'classroom', 'user']));
    }

    public function destroy(AccessLog $accessLog): JsonResponse
    {
        $accessLog->delete();

        return response()->json(['message' => 'Access log deleted successfully.']);
    }
}
