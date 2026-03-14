@extends('layouts.admin')
@section('title', __('messages.users.title'))
@section('page-title', __('messages.users.title'))

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <p class="text-gray-500">{{ __('messages.users.subtitle') }}</p>
        @admin
        <a href="{{ route('admin.users.create') }}" class="bg-blue-700 text-white px-5 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium flex items-center gap-2 w-fit">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            {{ __('messages.users.add_new') }}
        </a>
        @endadmin
    </div>

    {{-- Users Table --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">#</th>
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.users.name') }}</th>
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.users.email') }}</th>
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.users.phone') }}</th>
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.users.role') }}</th>
                        <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-500">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br {{ $user->isAdmin() ? 'from-purple-500 to-purple-700' : 'from-blue-500 to-blue-700' }} rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ mb_substr($user->localized_name, 0, 1) }}
                                </div>
                                {{ $user->localized_name }}
                                @if($user->id === auth()->id())
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">{{ __('messages.users.you') }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600" dir="ltr">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-gray-600" dir="ltr">{{ $user->phone ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $user->isAdmin() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $user->role_name }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">{{ __('messages.edit') }}</a>
                                @if(!$user->isAdmin() && $user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('{{ __('messages.users.confirm_delete') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">{{ __('messages.delete') }}</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-400">{{ __('messages.users.no_users') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-4 py-3 border-t">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
