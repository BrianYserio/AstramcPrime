@props(['id' => ''])

<nav id="{{ $id }}" class="bg-[#f7f7f8] h-screen fixed top-0 left-0 min-w-[250px] py-6 px-4 transition-all duration-300">
    <div class="relative">
        <a href="#"><img src="{{asset('assets/img/new-astra-logo-low.png')}}" alt="logo" class="w-[150px]" /></a>

        <div id="sidebarToggle"
            class="absolute -right-6 top-1 h-6 w-6 p-[6px] cursor-pointer bg-[#007bff] flex items-center justify-center rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" class="w-4 h-4" viewBox="0 0 55.752 55.752">
                <path d="M43.006 23.916a5.36 5.36 0 0 0-.912-.727L20.485 1.581a5.4 5.4 0 0 0-7.637 7.638l18.611 18.609-18.705 18.707a5.398 5.398 0 1 0 7.634 7.635l21.706-21.703a5.35 5.35 0 0 0 .912-.727 5.373 5.373 0 0 0 1.574-3.912 5.363 5.363 0 0 0-1.574-3.912z" />
            </svg>
        </div>
    </div>

    <div class="overflow-auto py-6 h-full mt-4">
        <ul class="space-y-2">
            <li>
                <a href="#" class="text-slate-800 font-medium hover:bg-gray-200 text-[15px] flex items-center rounded px-4 py-2">
                    <x-dashboardIcon />
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <button type="button"
                    class="w-full text-left text-slate-800 font-medium hover:bg-gray-200 text-[15px] flex items-center rounded px-4 py-2"
                    onclick="toggleSubmenu('humanresourceSubmenu')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 512 512">
                        <path d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703z"/>
                    </svg>
                    <span>Human Resource</span>
                </button>

                <ul id="humanresourceSubmenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="{{ route('employees.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-gray-200 rounded">Employees</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<script>
    function toggleSubmenu(id) {
        const submenu = document.getElementById(id);

        if (!submenu) return;

        submenu.classList.toggle('hidden');
    }
</script>