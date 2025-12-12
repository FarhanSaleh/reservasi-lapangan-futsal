<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Show all fields
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Field::query();
        
        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%");
        }
        
        $fields = $query->paginate(15);
        
        return view('superadmin.fields.index', compact('fields', 'search'));
    }

    /**
     * Show create field form
     */
    public function create()
    {
        return view('superadmin.fields.create');
    }

    /**
     * Store new field
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|json',
            'price_per_hour' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        Field::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'facilities' => $validated['facilities'] ?? null,
            'price_per_hour' => $validated['price_per_hour'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('superadmin.fields.index')
            ->with('success', 'Field created successfully.');
    }

    /**
     * Show edit field form
     */
    public function edit($fieldId)
    {
        $field = Field::findOrFail($fieldId);
        
        return view('superadmin.fields.edit', compact('field'));
    }

    /**
     * Update field
     */
    public function update($fieldId, Request $request)
    {
        $field = Field::findOrFail($fieldId);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|json',
            'price_per_hour' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $field->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'facilities' => $validated['facilities'] ?? null,
            'price_per_hour' => $validated['price_per_hour'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('superadmin.fields.index')
            ->with('success', 'Field updated successfully.');
    }

    /**
     * Delete field
     */
    public function delete($fieldId)
    {
        $field = Field::findOrFail($fieldId);
        $field->delete();

        return back()->with('success', 'Field deleted successfully.');
    }
}
