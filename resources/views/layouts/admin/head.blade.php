<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .scroll-mobile::-webkit-scrollbar {
            display: none;
        }

        .scroll-mobile {
            -ms-overflow-style: none;
            scrollbar-width: none;
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex flex-col overflow-hidden">
    
    <!-- Konten -->
    @yield('konten')

    <!-- Footer -->
    @include('layouts.admin.footer')

    <!-- JS Section -->
    @yield('js')
    <!-- Loading Script -->
    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader').style.display = 'none';
                document.getElementById('content').classList.remove('hidden');
            }, 2000); // 2 detik = 2000 ms
        });
    </script>
</body>

</html>
