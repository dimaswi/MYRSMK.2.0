<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="/">
            {{ App\Models\Setting::first()->app_name ?? '' }}
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->routeIs('home'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold @if (request()->routeIs('home')) text-gray-800 dark:text-gray-100 @endif
                    dark:hover:text-gray-200 transition-colors duration-150 hover:text-gray-800 "
                    href="{{ route('home') }}">
                    <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">{{ __('messages.home') }}</span>
                </a>
            </li>
        </ul>
        @can('manage_logbook')
        <ul class="">
            <li class="relative px-6 py-3">
                @if (request()->routeIs('logbook') || request()->routeIs('logbook_create') | request()->routeIs('logbook_detail') )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold @if (request()->routeIs('logbook') || request()->routeIs('logbook_create')) text-gray-800 dark:text-gray-100 @endif
                    dark:hover:text-gray-200 transition-colors duration-150 hover:text-gray-800 "
                    @if (auth()->user()->hasRole('Logbook Verifikator'))
                        href="{{ route('logbook') }}"
                    @else
                        href="{{ route('logbook_create') }}"
                    @endif>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                      </svg>
                      
                    <span class="ml-4">{{ __('Logbook') }}</span>
                </a>
            </li>
        </ul>
        @endcan
        @can('manage_users')
        <ul>
            
            <li x-data="{menuAdmin:false}" class="relative px-6 py-3  text-gray-800 dark:text-gray-100">
                @if (request()->routeIs('admin_permission') || request()->routeIs('admin_users') || request()->routeIs('admin_unit') || request()->routeIs('admin_bagian') || request()->routeIs('admin_roles') )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="menuAdmin=!menuAdmin" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                        <span class="ml-4">{{ __('messages.administration') }}</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="menuAdmin">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('agency_clients')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_users') }}">{{ __('User') }}</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('admin_unit')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_unit') }}">{{ __('Kepala Unit') }}</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('admin_bagian')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_bagian') }}">{{ __('Kepala Bagian') }}</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('admin_roles')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_roles') }}">{{ __('Roles') }}</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('admin_permission')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_permission') }}">{{ __('Permissions') }}</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 @if (request()->
                            routeIs('admin_jam_kerja')) text-gray-800 dark:text-gray-100 @endif
                            hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full"
                                href="{{ route('admin_jam_kerja') }}">{{ __('Jam Kerja') }}</a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul> 
        @endcan
    </div>

</aside>
