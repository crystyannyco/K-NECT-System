    <div class="flex">
        <aside class="hidden lg:block w-64 bg-white shadow-sm border-r border-gray-200 min-h-screen">
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="<?= base_url('/pederasyon/dashboard') ?>"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/dashboard') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v4m8-4v4"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="<?= base_url('/pederasyon/profile') ?>"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/profile') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">Profile</span>
                    </a>
                    
                    <a href="<?= base_url('/pederasyon/events') ?>"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/events') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Event</span>
                        <span class="ml-auto bg-green-100 text-green-800 text-sm px-2 py-1 rounded-full">5</span>
                    </a>
                    
                    <a href="<?= base_url('/pederasyon/documents') ?>"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/documents') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="font-medium">Document</span>
                    </a>
                    
                    <a href="<?= base_url('/pederasyon/attendance') ?>"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/attendance') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="font-medium">Attendance</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-indigo-50 rounded-lg transition-colors duration-200 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="font-medium">Bulletin</span>
                        <span class="ml-auto bg-red-100 text-red-800 text-sm px-2 py-1 rounded-full">3</span>
                    </a>
                    
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Quick Actions</p>
                        <a href="<?= base_url('/pederasyon/events/new') ?>"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/events/new') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="font-medium">New Meeting</span>
                        </a>
                        <a href="<?= base_url('/pederasyon/profiling') ?>"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/profiling') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span class="font-medium">Add Member</span>
                        </a>
                        <a href="<?= base_url('/pederasyon/member') ?>"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/member') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-7a4 4 0 11-8 0 4 4 0 018 0zm6 4v6m0 0h-6m6 0h6"></path>
                            </svg>
                            <span class="font-medium">Member</span>
                        </a>
                        <a href="<?= base_url('/pederasyon/documents/upload') ?>"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/documents/upload') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium">Upload Document</span>
                        </a>
                    </div>
                    
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <a href="<?= base_url('/pederasyon/settings') ?>"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors duration-200 ease-in-out <?= (uri_string() == 'pederasyon/settings') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-gray-900 hover:bg-indigo-50' ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium">Settings</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside> 