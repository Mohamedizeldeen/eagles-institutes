@extends('layouts.admin')
@section('title', __('messages.courses.title'))
@section('page-title', __('messages.courses.title'))

@section('content')
<div class="flex items-center justify-between mb-6">
    <form action="{{ route('admin.courses.index') }}" method="GET" class="flex gap-3 items-center flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.courses.search_placeholder') }}"
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-48">
        <select name="level" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">{{ __('messages.courses.all_levels') }}</option>
            <option value="مبتدئ" {{ request('level') === 'مبتدئ' ? 'selected' : '' }}>{{ __('messages.courses.beginner') }}</option>
            <option value="متوسط" {{ request('level') === 'متوسط' ? 'selected' : '' }}>{{ __('messages.courses.intermediate') }}</option>
            <option value="متقدم" {{ request('level') === 'متقدم' ? 'selected' : '' }}>{{ __('messages.courses.advanced') }}</option>
        </select>
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">{{ __('messages.search') }}</button>
    </form>
    @admin
    <a href="{{ route('admin.courses.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        {{ __('messages.courses.add') }}
    </a>
    @endadmin
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.name') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.level') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.price') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.duration') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.students.title') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.status') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($courses as $course)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $course->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $course->localized_name }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $course->level === 'مبتدئ' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $course->level === 'متوسط' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $course->level === 'متقدم' ? 'bg-red-100 text-red-700' : '' }}
                            ">{{ $course->localized_level }}</span>
                        </td>
                        <td class="px-4 py-3">{{ number_format($course->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $course->duration_hours }} {{ __('messages.courses.hours') }}</td>
                        <td class="px-4 py-3">{{ $course->enrollments_count }}</td>
                        <td class="px-4 py-3">
                            @if($course->is_active)
                                <span class="inline-block px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">{{ __('messages.courses.active_status') }}</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">{{ __('messages.courses.inactive_status') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-blue-600 hover:text-blue-800" title="{{ __('messages.view') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                @admin
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-amber-600 hover:text-amber-800" title="{{ __('messages.edit') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="{{ __('messages.delete') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                @endadmin
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-500">{{ __('messages.courses.no_courses') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $courses->withQueryString()->links() }}</div>
</div>
@endsection
