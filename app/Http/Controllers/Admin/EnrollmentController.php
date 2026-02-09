<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'course']);

        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('id_number', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $enrollments = $query->latest()->paginate(15);
        $courses = Course::active()->get();

        return view('admin.enrollments.index', compact('enrollments', 'courses'));
    }

    public function create()
    {
        $students = Student::active()->orderBy('name')->get();
        $courses = Course::active()->get();
        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'amount_paid' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:مدفوع,جزئي,غير مدفوع',
            'enrolled_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $existing = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->whereIn('status', ['مسجل'])
            ->first();

        if ($existing) {
            return back()->withErrors(['student_id' => 'هذا الطالب مسجل بالفعل في هذه الدورة'])
                ->withInput();
        }

        $validated['discount'] = $validated['discount'] ?? 0;
        $validated['status'] = 'مسجل';

        Enrollment::create($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'تم تسجيل الطالب في الدورة بنجاح');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'course', 'certificate']);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::active()->orderBy('name')->get();
        $courses = Course::active()->get();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:مدفوع,جزئي,غير مدفوع',
            'status' => 'required|in:مسجل,مكتمل,منسحب,مؤجل',
            'completed_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        if ($validated['status'] === 'مكتمل' && empty($validated['completed_at'])) {
            $validated['completed_at'] = now();
        }

        $enrollment->update($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'تم تحديث التسجيل بنجاح');
    }

    public function complete(Enrollment $enrollment)
    {
        $enrollment->update([
            'status' => 'مكتمل',
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم إكمال الدورة بنجاح');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')
            ->with('success', 'تم حذف التسجيل بنجاح');
    }
}
