@extends('layouts.admin')
@section('title', 'تعديل الطالب: ' . $student->name)
@section('page-title', 'تعديل بيانات الطالب')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.students.update', $student) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.students._form', ['student' => $student])
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">تحديث البيانات</button>
                <a href="{{ route('admin.students.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
