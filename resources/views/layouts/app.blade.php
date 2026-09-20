<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TUICO')</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">

    <header class="p-4 border-b">
        {{-- nav goes here later --}}
        @php
            $currentPath = request()->path();
            $isSwahili = str_starts_with($currentPath, 'sw/') || $currentPath === 'sw';
            $basePath = $isSwahili ? substr($currentPath, 3) : $currentPath;
            $basePath = $basePath === '/' ? '' : $basePath;

            $englishUrl = '/' . $basePath;
            $swahiliUrl = $basePath === '' ? '/sw' : '/sw/' . $basePath;
        @endphp

        <div class="flex gap-2 text-sm">
            <a href="{{ $englishUrl }}" class="{{ !$isSwahili ? 'font-bold' : 'text-gray-500' }}">EN</a>
            <span>|</span>
            <a href="{{ $swahiliUrl }}" class="{{ $isSwahili ? 'font-bold' : 'text-gray-500' }}">SW</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="p-4 border-t mt-8">
        {{-- footer goes here later --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <h4 class="font-semibold">Contact Us</h4>
                <p>{{ $siteSettings->street_address }}</p>
                <p>{{ $siteSettings->po_box }}</p>
                <p>{{ $siteSettings->email }}</p>
                <p>{{ $siteSettings->phone }}</p>
                <p>{{ $siteSettings->fax }}</p>
            </div>
            <div>
                <h4 class="font-semibold">Important Links</h4>
                <ul class="list-disc list-inside">
                    @foreach ($footerImportantLinks as $link)
                        <li>
                           <a href="{{ str_starts_with($link->url, 'http') ? $link->url : (app()->getLocale() === 'sw' ? '/sw' . $link->url : $link->url) }}"
   @if (str_starts_with($link->url, 'http')) target="_blank" @endif
   class="text-blue-500 hover:underline">
    {{ $link->label }}
</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="font-semibold">Partners</h4>
                <ul class="list-disc list-inside">
                    @foreach ($footerPartnerLinks as $link)
                        <li>
                            <a href="{{ str_starts_with($link->url, 'http') ? $link->url : (app()->getLocale() === 'sw' ? '/sw' . $link->url : $link->url) }}"
                               @if (str_starts_with($link->url, 'http')) target="_blank" @endif
                               class="text-blue-500 hover:underline">
                                {{ $link->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </footer>

</body>

</html>
