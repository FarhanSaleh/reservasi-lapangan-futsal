<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Field;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show schedules for a field
     */
    public function index(Request $request)
    {
        $fieldId = $request->input('field_id');
        
        $fields = Field::all();
        
        $query = Schedule::with('field');
        
        if ($fieldId) {
            $query->where('field_id', $fieldId);
        }
        
        $schedules = $query->paginate(15);
        
        return view('superadmin.schedules.index', compact('schedules', 'fields', 'fieldId'));
    }

    /**
     * Show create schedule form
     */
    public function create()
    {
        $fields = Field::all();
        
        return view('superadmin.schedules.create', compact('fields'));
    }

    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'day_of_week' => 'required|integer|between:0,6',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        Schedule::create($validated);

        return redirect()->route('superadmin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Show edit schedule form
     */
    public function edit($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $fields = Field::all();
        
        return view('superadmin.schedules.edit', compact('schedule', 'fields'));
    }

    /**
     * Update schedule
     */
    public function update($scheduleId, Request $request)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'day_of_week' => 'required|integer|between:0,6',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            'price_per_hour' => 'required|numeric|min:0',
        ]);

        $schedule->update($validated);

        return redirect()->route('superadmin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Delete schedule
     */
    public function delete($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->delete();

        return back()->with('success', 'Schedule deleted successfully.');
    }
}
