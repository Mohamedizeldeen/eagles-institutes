<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $month = $request->get('month');

        // إيرادات شهرية لكل شهر في السنة المحددة
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[$m] = Enrollment::whereYear('enrolled_at', $year)
                ->whereMonth('enrolled_at', $m)
                ->sum('amount_paid');
        }

        // إيرادات كل دورة
        $courseRevenue = Course::withCount('enrollments')
            ->get()
            ->map(function ($course) {
                $course->revenue = $course->totalRevenue();
                return $course;
            })
            ->sortByDesc('revenue');

        // إحصائيات عامة
        $stats = [
            'total_revenue' => Enrollment::sum('amount_paid'),
            'yearly_revenue' => Enrollment::whereYear('enrolled_at', $year)->sum('amount_paid'),
            'total_students' => Student::count(),
            'new_students_this_month' => Student::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'total_enrollments' => Enrollment::count(),
            'completed_enrollments' => Enrollment::where('status', 'مكتمل')->count(),
            'active_enrollments' => Enrollment::where('status', 'مسجل')->count(),
            'unpaid_amount' => Enrollment::where('payment_status', 'غير مدفوع')
                ->orWhere('payment_status', 'جزئي')
                ->sum(\DB::raw('(SELECT price FROM courses WHERE courses.id = enrollments.course_id) - amount_paid')),
        ];

        // حالة الدفع
        $paymentStats = [
            'مدفوع' => Enrollment::where('payment_status', 'مدفوع')->count(),
            'جزئي' => Enrollment::where('payment_status', 'جزئي')->count(),
            'غير مدفوع' => Enrollment::where('payment_status', 'غير مدفوع')->count(),
        ];

        // تسجيلات حسب المستوى
        $levelStats = [
            'مبتدئ' => Course::where('level', 'مبتدئ')->withCount('enrollments')->get()->sum('enrollments_count'),
            'متوسط' => Course::where('level', 'متوسط')->withCount('enrollments')->get()->sum('enrollments_count'),
            'متقدم' => Course::where('level', 'متقدم')->withCount('enrollments')->get()->sum('enrollments_count'),
        ];

        return view('admin.reports.index', compact(
            'monthlyRevenue', 'courseRevenue', 'stats', 'paymentStats', 'levelStats', 'year'
        ));
    }
}
