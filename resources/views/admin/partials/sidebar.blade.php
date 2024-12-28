@php
    use App\Enums\AdminRole;
    $admin = Auth::guard('admin')->user();
@endphp

<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <img class="h-8 w-auto" src="{{ asset('images/logo-white.svg') }}" alt="Logo">
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard - visible to all -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                        >
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Products - visible to sales -->
                    @if($admin->hasRole(AdminRole::SALES) || $admin->isSuperAdmin())
                    <li>
                        <div x-data="{ open: {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product-categories.*') || request()->routeIs('admin.brands.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" 
                                    class="{{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product-categories.*') || request()->routeIs('admin.brands.*') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex items-center justify-between w-full rounded-md p-2 text-sm leading-6 font-semibold">
                                <div class="flex gap-x-3">
                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                    Products
                                </div>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" class="mt-1 space-y-1" style="display: none;">
                                <a href="{{ route('admin.products.index') }}" 
                                   class="{{ request()->routeIs('admin.products.index') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    All Products
                                </a>
                                <a href="{{ route('admin.product-categories.index') }}" 
                                   class="{{ request()->routeIs('admin.product-categories.*') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    Categories
                                </a>
                                <a href="{{ route('admin.brands.index') }}" 
                                   class="{{ request()->routeIs('admin.brands.*') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    Brands
                                </a>
                            </div>
                        </div>
                    </li>
                    @endif

                    <!-- Shipping - visible to sales -->
                    @if($admin->hasRole(AdminRole::SALES) || $admin->isSuperAdmin())
                    <li>
                        <div x-data="{ open: {{ request()->routeIs('admin.shipping.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" 
                                    class="{{ request()->routeIs('admin.shipping.*') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex items-center justify-between w-full rounded-md p-2 text-sm leading-6 font-semibold">
                                <div class="flex gap-x-3">
                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                    Shipping
                                </div>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" class="mt-1 space-y-1" style="display: none;">
                                <a href="{{ route('admin.shipping.zones.index') }}" 
                                   class="{{ request()->routeIs('admin.shipping.zones.*') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    Zones
                                </a>
                                <a href="{{ route('admin.shipping.methods.index') }}" 
                                   class="{{ request()->routeIs('admin.shipping.methods.*') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    Methods
                                </a>
                                <a href="{{ route('admin.shipping.addresses.index') }}" 
                                   class="{{ request()->routeIs('admin.shipping.addresses.*') ? 'bg-gray-700' : '' }} text-gray-400 hover:text-white hover:bg-gray-700 group flex gap-x-3 rounded-md p-2 pl-11 text-sm leading-6 font-semibold">
                                    Addresses
                                </a>
                            </div>
                        </div>
                    </li>
                    @endif

                    <!-- Orders - visible to sales -->
                    @if($admin->hasRole(AdminRole::SALES) || $admin->isSuperAdmin())
                    <li>
                        <x-admin.nav-link 
                            href="{{ route('admin.orders.index') }}"
                            :active="request()->routeIs('admin.orders.*')"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Orders</span>
                        </x-admin.nav-link>
                    </li>
                    @endif

                    <!-- Hide all other menu items for sales role -->
                    @unless($admin->hasRole(AdminRole::SALES))
                    <!-- All other menu items -->
                    <!-- ... keep existing menu items ... -->
                    @endunless

                </ul>
            </li>
            
            <!-- Logout Button - visible to all -->
            <li class="mt-auto">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-gray-800 hover:text-white w-full">
                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div> 