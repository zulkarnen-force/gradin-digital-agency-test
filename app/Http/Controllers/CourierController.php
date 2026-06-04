<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourierResource;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $level = $request->query('level');
        $search = $request->query('search');

        $sortableColumns = [
            'first_name',
            'last_name',
            'created_at',
        ];

        $sortBy = $request->query('sort_by', 'created_at');
        $sortDirection = strtolower(
            $request->query('sort_direction', 'desc')
        );

        if (! in_array($sortBy, $sortableColumns)) {
            $sortBy = 'created_at';
        }

        if (! in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $couriers = Courier::query()
            ->when($level, function ($query) use ($level) {
                $query->where('level', $level);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate(
                $request->integer('per_page', 10)
            );

        return CourierResource::collection($couriers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Courier::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'level' => $request->input('level'),
        ]);

        return response()->json([
            'message' => 'Courier created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $courier = Courier::findOrFail($id);
        return new CourierResource($courier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $courier = Courier::findOrFail($id);

        $courier->update(
            $request->only([
                'first_name',
                'last_name',
                'level',
            ])
        );

        return new CourierResource($courier->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $courier = Courier::findOrFail($id);
        $courier->delete();
        return response()->json([
            'message' => 'Courier deleted successfully',
        ]);
    }
}
