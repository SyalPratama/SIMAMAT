
<!-- Bottom Navigation -->
<nav class="bg-indigo-600 border-t border-gray-200 w-full max-w-sm mx-auto fixed bottom-0 left-0 right-0">
    <div class="flex justify-around text-sm text-white">
        <!-- Beranda -->
        <a href="{{ route('dashboard.dosen') }}"
           class="flex flex-col items-center py-2 {{ Request::routeIs('dashboard.dosen') ? 'text-white' : 'text-indigo-200' }}">
            <i class="bi bi-house-door-fill text-xl mb-1"></i>
            <span class="text-xs">Beranda</span>
        </a>

        <!-- Pengumuman -->
        <a href="{{ route('pengumuman.index') }}"
           class="flex flex-col items-center py-2 {{ Request::routeIs('pengumuman.index') ? 'text-white' : 'text-indigo-200' }}">
            <i class="bi bi-megaphone-fill text-xl mb-1"></i>
            <span class="text-xs">Pengumuman</span>
        </a>

        <!-- Data Tugas -->
        <a href="{{ route('tugas.index') }}"
           class="flex flex-col items-center py-2 {{ Request::routeIs('tugas.index') ? 'text-white' : 'text-indigo-200' }}">
            <i class="bi bi-book-fill text-xl mb-1"></i>
            <span class="text-xs">Data Tugas</span>
        </a>

        <!-- Logout -->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex flex-col items-center py-2 text-red-200 hover:text-white">
            <i class="bi bi-box-arrow-right text-xl mb-1"></i>
            <span class="text-xs">Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</nav>
