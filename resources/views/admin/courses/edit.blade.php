@extends('layouts.admin')
@section('title', 'تعديل الدورة: ' . $course->name)
@section('page-title', 'تعديل الدورة')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.courses._form', ['course' => $course])
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">تحديث الدورة</button>
                <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
