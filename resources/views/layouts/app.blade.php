<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <script src="{{ asset('js/alerts.js') }}"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Side Menu -->
        <aside class="w-64 bg-white shadow-sm border-r border-gray-200 flex flex-col">
            <div class="p-6 flex flex-col h-full">
                <div>
                    <h1 class="text-xl font-bold text-gray-800 mb-6">Laravel Test</h1>
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('dashboard*') ? 'bg-gray-100 font-medium' : '' }}">
                            データ一覧
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('register*') ? 'bg-gray-100 font-medium' : '' }}">
                            データ登録
                        </a>
                        <a href="{{ route('inquiry') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('inquiry*') ? 'bg-gray-100 font-medium' : '' }}">
                            お問い合わせ
                        </a>
                        @if(Auth::guard('admin')->check())
                        <a href="{{ route('user.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('user*') ? 'bg-gray-100 font-medium' : '' }}">
                            ユーザー管理
                        </a>
                        @endif
                    </nav>
                </div>
                <div class="mt-auto pt-6 border-t border-gray-200">
                    <a href="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                        ログアウト
                    </a>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>

