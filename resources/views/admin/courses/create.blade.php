@extends('layouts.admin')
@section('title', 'إضافة دورة جديدة')
@section('page-title', 'إضافة دورة جديدة')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.courses._form')
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">حفظ الدورة</button>
                <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
