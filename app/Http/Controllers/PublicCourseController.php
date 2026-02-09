<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PublicCourseController extends Controller
{
    public function index()
    {
        $query = Course::visibleOnWebsite()->latest();

        if (request('level')) {
            $query->where('level', request('level'));
        }

        $courses = $query->paginate(9);
        return view('public.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if (!$course->show_on_website) {
            abort(404);
        }
        return view('public.courses.show', compact('course'));
    }
}
