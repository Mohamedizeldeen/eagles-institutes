@extends('layouts.admin')
@section('title', __('messages.contacts.title'))
@section('page-title', __('messages.contacts.message_details'))

@section('content')

<div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-blue-600 to-gray-700 px-8 py-6 border-b border-gray-200">
        <h2 class="text-3xl font-bold text-white">{{ __('messages.contacts.message_details') }}</h2>
        <p class="text-blue-100 text-sm mt-1">{{ __('messages.contacts.contact_info') }}</p>
    </div>
    
    <div class="p-8 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.sender_name') }}</h3>
                <p class="text-lg font-medium text-gray-900">{{ $contact->name }}</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.email') }}</h3>
                <p class="text-lg font-medium text-blue-600 break-all">{{ $contact->email }}</p>
            </div>
        </div>
        
         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.subject') }}</h3>
                <p class="text-lg font-medium text-gray-900">{{ $contact->subject }}</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.phone') }}</h3>
                <p class="text-lg font-medium text-blue-600 break-all">{{ $contact->phone }}</p>
            </div>
        </div>

        
        
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition">
            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.message_content') }}</h3>
            <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>
        
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ __('messages.contacts.sent_at') }}</h3>
            <p class="text-lg font-medium text-gray-900">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    
    <div class="bg-gray-100 px-8 py-6 flex gap-4 justify-end">
        <a href="{{ route('admin.contacts.index') }}" class="px-6 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">
            {{ __('messages.back') }}
        </a>
        @admin
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
            @csrf @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                {{ __('messages.delete') }}
            </button>
        </form>
        @endadmin
    </div>
</div>

@endsection
