<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="valentine">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV. Sun Firdaus - Project Commercial Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased">
    @php
        $showNotifDrawer = false;
    @endphp

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width>

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <div class="text-2xl">SuFi</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="Notifications" icon="o-bell" class="btn-ghost btn-sm" />
        </x-slot:actions>
    </x-mary-nav>

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" class="bg-neutral-100">
            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Home" icon="o-home" link="/dashboard" />
                <x-mary-menu-separator />
                {{-- Submenu --}}
                <x-mary-menu-sub title="Master" icon="fas.wand-magic-sparkles">
                    <x-mary-menu-item title="User" icon="fas.user" />
                    <x-mary-menu-item title="Role" icon="fas.user-group" />
                    <x-mary-menu-item title="Permission" icon="fas.user-shield" />
                    <x-mary-menu-item title="Customer" icon="fas.people-arrows" link="/customer" />
                    <x-mary-menu-item title="Supplier" icon="fas.people-carry-box" link="/supplier"/>
                    <x-mary-menu-item title="Armada" icon="o-truck" />
                    <x-mary-menu-item title="Biaya" icon="o-banknotes" />
                </x-mary-menu-sub>

                <x-mary-menu-sub title="Manajemen" icon="fas.briefcase">
                    <x-mary-menu-item title="Project" icon="fas.handshake" />
                    <x-mary-menu-item title="Invoice" icon="fas.file-invoice-dollar" />
                    <x-mary-menu-item title="Order" icon="fas.cart-shopping" />
                    <x-mary-menu-item title="> Order Detail" icon="fas.cart-plus" />
                    <x-mary-menu-item title="Ka Lap Project" icon="fas.helmet-safety" />
                    <x-mary-menu-item title="> PiC Surat Jalan" icon="fas.person-running" />
                    <x-mary-menu-item title="> Pengajuan Keuangan" icon="far.pen-to-square" />
                </x-mary-menu-sub>

                <x-mary-menu-separator title="Transaksi" icon="o-sparkles" />
                    <x-mary-menu-item title="Surat Jalan" icon="fas.file-signature" />
                    <x-mary-menu-item title="Absensi" icon="far.address-book" />
                    <x-mary-menu-item title="Timesheet" icon="fas.snowplow" />
                    <x-mary-menu-item title="Kas Kecil" icon="fas.money-bill-1" />

                {{-- Separator with title and icon --}}
                <x-mary-menu-separator />
                <x-mary-menu-item title="Profile" icon="fas.user-pen" :href="route('profile')" wire:navigate/>
                <x-mary-menu-item title="Logout" icon="fas.right-from-bracket" link="/logout" wire:navigate/>
            </x-mary-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content class="bg-neutral-50 min-h-screen">
            {{ $slot }}
        </x-slot:content>

        {{-- Footer area --}}
        <x-slot:footer class="footer items-center p-4 bg-neutral text-neutral-content">
            <aside class="items-center grid-flow-col">
                <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    fill-rule="evenodd" clip-rule="evenodd" class="fill-current">
                    <path
                        d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
                    </path>
                </svg>
                <p>Copyright © 2024 - All right reserved</p>
            </aside>
        </x-slot:footer>
    </x-mary-main>

</body>

</html>
