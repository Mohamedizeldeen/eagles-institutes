<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - معهد النسور</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen flex items-center justify-center font-sans p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <div class="bg-blue-700 text-white w-16 h-16 rounded-xl flex items-center justify-center font-bold text-2xl mx-auto mb-4">EN</div>
            <h1 class="text-2xl font-bold text-gray-800">معهد النسور</h1>
            <p class="text-gray-500 mt-1">تسجيل الدخول إلى لوحة التحكم</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-left" dir="ltr"
                    placeholder="admin@eagles.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-left" dir="ltr"
                    placeholder="••••••••">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remember" class="text-sm text-gray-600 mr-2">تذكرني</label>
            </div>

            <button type="submit" class="w-full bg-blue-700 text-white py-2.5 rounded-lg font-medium hover:bg-blue-800 transition focus:ring-4 focus:ring-blue-300">
                تسجيل الدخول
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-700 transition">العودة إلى الموقع</a>
        </div>
    </div>
</body>
</html>
