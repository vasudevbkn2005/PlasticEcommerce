{{-- Ye Wala Front Ka Page Hai --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <livewire:styles />
</head>
<body>
     <livewire:navbar />
    <div x-data="{ showMobileMenu: false }">
        @yield('content')
    </div>
    @livewire('footer-page')

    <livewire:scripts />
    
    <!-- Load Alpine.js once, here in the layout file -->
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>

