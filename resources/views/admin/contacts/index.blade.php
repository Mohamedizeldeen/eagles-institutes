@extends('layouts.admin')
@section('title', ' الرسائل الواردة')
@section('page-title', 'إدارة الرسائل الواردة')

@section('content')


<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">اسم المرسل</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">البريد الإلكتروني</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الموضوع</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">تاريخ الإرسال</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($contacts as $contact)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $contact->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $contact->name }}</td>
                        <td class="px-4 py-3">{{ $contact->email }}</td>
                        <td class="px-4 py-3">{{ $contact->subject }}</td>
                        <td class="px-4 py-3">{{ $contact->created_at }}</td>
                        
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-800" title="عرض">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="حذف">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-500">لا توجد رسائل واردة حتى الآن</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $contacts->withQueryString()->links() }}</div>
</div>
@endsection
