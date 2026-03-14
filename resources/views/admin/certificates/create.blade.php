@extends('layouts.admin')
@section('title', __('messages.certificates.add'))
@section('page-title', __('messages.certificates.add'))

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        @if($completedEnrollments->isEmpty() && !$enrollment)
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <p>{{ __('messages.certificates.no_completed_enrollments') }}</p>
                <p class="text-sm mt-1">{{ __('messages.certificates.must_complete_first') }}</p>
            </div>
        @else
            <form action="{{ route('admin.certificates.store') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.certificates.completed_enrollment') }} <span class="text-red-500">*</span></label>
                        <select name="enrollment_id" id="enrollment_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition @error('enrollment_id') border-red-500 @enderror">
                            <option value="">{{ __('messages.certificates.select_enrollment') }}</option>
                            @if($enrollment)
                                <option value="{{ $enrollment->id }}" selected>{{ $enrollment->student->localized_name }} - {{ $enrollment->course->localized_name }}</option>
                            @endif
                            @foreach($completedEnrollments as $enr)
                                <option value="{{ $enr->id }}" {{ old('enrollment_id') == $enr->id ? 'selected' : '' }}>
                                    {{ $enr->student->localized_name }} - {{ $enr->course->localized_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.certificates.grade') }}</label>
                            <select name="grade" id="grade"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="">{{ __('messages.certificates.select_grade') }}</option>
                                <option value="excellent" {{ old('grade') === 'excellent' ? 'selected' : '' }}>{{ __('messages.certificates.grades.excellent') }}</option>
                                <option value="very_good" {{ old('grade') === 'very_good' ? 'selected' : '' }}>{{ __('messages.certificates.grades.very_good') }}</option>
                                <option value="good" {{ old('grade') === 'good' ? 'selected' : '' }}>{{ __('messages.certificates.grades.good') }}</option>
                                <option value="pass" {{ old('grade') === 'pass' ? 'selected' : '' }}>{{ __('messages.certificates.grades.pass') }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="issued_at" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.certificates.issued_at') }} <span class="text-red-500">*</span></label>
                            <input type="date" name="issued_at" id="issued_at" value="{{ old('issued_at', date('Y-m-d')) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.notes') }}</label>
                        <textarea name="notes" id="notes" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                    <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">{{ __('messages.certificates.issue_certificate') }}</button>
                    <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
