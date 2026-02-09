@extends('layouts.admin')
@section('title', 'إدارة الشهادات')
@section('page-title', 'إدارة الشهادات')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form action="{{ route('admin.certificates.index') }}" method="GET" class="flex gap-3 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث برقم الشهادة أو اسم الطالب..."
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-64">
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">بحث</button>
    </form>
    <a href="{{ route('admin.certificates.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        إصدار شهادة
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">رقم الشهادة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الطالب</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الدورة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">التقدير</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">تاريخ الإصدار</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($certificates as $cert)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono text-xs" dir="ltr">{{ $cert->certificate_number }}</td>
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route('admin.students.show', $cert->student) }}" class="text-blue-600 hover:text-blue-800">{{ $cert->student->name }}</a>
                        </td>
                        <td class="px-4 py-3">{{ $cert->course->name }}</td>
                        <td class="px-4 py-3">{{ $cert->grade ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $cert->issued_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.certificates.print', $cert) }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="طباعة">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                </a>
                                <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="حذف">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-500">لا توجد شهادات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $certificates->withQueryString()->links() }}</div>
</div>
@endsection
