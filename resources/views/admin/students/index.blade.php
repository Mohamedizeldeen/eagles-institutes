@extends('layouts.admin')
@section('title', 'إدارة الطلاب')
@section('page-title', 'إدارة الطلاب')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form action="{{ route('admin.students.index') }}" method="GET" class="flex gap-3 items-center flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم أو الهاتف أو رقم الهوية..."
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-64">
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">بحث</button>
    </form>
    <a href="{{ route('admin.students.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        إضافة طالب
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الاسم</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">رقم الهوية</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الهاتف</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الدورات</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الحالة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $student->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $student->name }}</td>
                        <td class="px-4 py-3 text-gray-600" dir="ltr">{{ $student->id_number }}</td>
                        <td class="px-4 py-3 text-gray-600" dir="ltr">{{ $student->phone }}</td>
                        <td class="px-4 py-3">{{ $student->enrollments_count }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full {{ $student->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $student->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.students.show', $student) }}" class="text-blue-600 hover:text-blue-800" title="عرض">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('admin.students.edit', $student) }}" class="text-amber-600 hover:text-amber-800" title="تعديل">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطالب؟')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="حذف">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-8 text-gray-500">لا يوجد طلاب حتى الآن</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $students->withQueryString()->links() }}</div>
</div>
@endsection
