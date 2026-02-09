<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'active_students' => Student::active()->count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::active()->count(),
            'total_enrollments' => Enrollment::count(),
            'active_enrollments' => Enrollment::where('status', 'مسجل')->count(),
            'total_certificates' => Certificate::count(),
            'total_articles' => Article::count(),
            'total_revenue' => Enrollment::sum('amount_paid'),
            'monthly_revenue' => Enrollment::whereMonth('enrolled_at', Carbon::now()->month)
                ->whereYear('enrolled_at', Carbon::now()->year)
                ->sum('amount_paid'),
        ];

        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->latest()
            ->take(5)
            ->get();

        $recentStudents = Student::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentEnrollments', 'recentStudents'));
    }
}
