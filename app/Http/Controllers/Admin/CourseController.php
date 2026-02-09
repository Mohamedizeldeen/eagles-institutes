<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $courses = $query->withCount('enrollments')->latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'level' => 'required|in:مبتدئ,متوسط,متقدم',
            'price' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'show_on_website' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['show_on_website'] = $request->has('show_on_website');

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'تم إنشاء الدورة بنجاح');
    }

    public function show(Course $course)
    {
        $course->load(['enrollments.student', 'certificates.student']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'level' => 'required|in:مبتدئ,متوسط,متقدم',
            'price' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'max_students' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'show_on_website' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['show_on_website'] = $request->has('show_on_website');

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'تم تحديث الدورة بنجاح');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'تم حذف الدورة بنجاح');
    }
}
