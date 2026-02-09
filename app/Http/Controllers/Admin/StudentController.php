<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('id_number', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $students = $query->withCount('enrollments')
            ->latest()
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:30|unique:students,id_number',
            'gender' => 'nullable|in:ذكر,أنثى',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'تم تسجيل الطالب بنجاح');
    }

    public function show(Student $student)
    {
        $student->load(['enrollments.course', 'certificates.course']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:30|unique:students,id_number,' . $student->id,
            'gender' => 'nullable|in:ذكر,أنثى',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'تم تحديث بيانات الطالب بنجاح');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
            ->with('success', 'تم حذف الطالب بنجاح');
    }
}
