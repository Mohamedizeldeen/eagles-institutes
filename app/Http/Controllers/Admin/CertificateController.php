<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::with(['student', 'course']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('certificate_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('student', function ($sq) use ($request) {
                      $sq->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $certificates = $query->latest()->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create(Request $request)
    {
        $enrollment = null;
        if ($request->filled('enrollment_id')) {
            $enrollment = Enrollment::with(['student', 'course'])->findOrFail($request->enrollment_id);
        }

        $completedEnrollments = Enrollment::with(['student', 'course'])
            ->where('status', 'مكتمل')
            ->whereDoesntHave('certificate')
            ->get();

        return view('admin.certificates.create', compact('completedEnrollments', 'enrollment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id|unique:certificates,enrollment_id',
            'grade' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'issued_at' => 'required|date',
        ]);

        $enrollment = Enrollment::with(['student', 'course'])->findOrFail($validated['enrollment_id']);

        Certificate::create([
            'student_id' => $enrollment->student_id,
            'course_id' => $enrollment->course_id,
            'enrollment_id' => $enrollment->id,
            'certificate_number' => Certificate::generateNumber(),
            'issued_at' => $validated['issued_at'],
            'grade' => $validated['grade'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'تم إصدار الشهادة بنجاح');
    }

    public function show(Certificate $certificate)
    {
        $certificate->load(['student', 'course', 'enrollment']);
        return view('admin.certificates.show', compact('certificate'));
    }

    public function print(Certificate $certificate)
    {
        $certificate->load(['student', 'course']);
        return view('admin.certificates.print', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')
            ->with('success', 'تم حذف الشهادة بنجاح');
    }
}
