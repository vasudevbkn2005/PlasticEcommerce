{{-- Ye Admin BAse Vaala HAi --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex">

        <div x-data="{ open: false }" class="flex h-screen">
            @livewire('admin-dashboard')

            @yield('content')
      </div> 
</body>

 </html>
