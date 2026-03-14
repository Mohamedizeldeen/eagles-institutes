@extends('layouts.admin')
@section('title', __('messages.students.edit') . ': ' . $student->localized_name)
@section('page-title', __('messages.students.edit'))

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.students.update', $student) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.students._form', ['student' => $student])
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">{{ __('messages.students.update_data') }}</button>
                <a href="{{ route('admin.students.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
