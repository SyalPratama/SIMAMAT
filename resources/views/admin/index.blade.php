<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Sidebar -->
    <div class="bg-indigo-600 text-white px-4 py-3 flex justify-between items-center">
        <span class="font-bold text-lg">SIMAMAT</span>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="text-sm hover:underline">Logout</a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <!-- Content -->
    <div class="p-4 space-y-4">
        <h1 class="text-xl font-semibold text-gray-800">Dashboard Superadmin</h1>

        <!-- Pengumuman -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <h2 class="text-lg font-semibold text-indigo-600 mb-2">Pengumuman Terbaru</h2>
            <ul class="text-sm text-gray-700 space-y-2">
                <li>- Jadwal sidang akhir dimulai minggu depan.</li>
                <li>- Maintenance server tanggal 20 Juli 2025.</li>
            </ul>
        </div>
    </div>
</body>
</html>
