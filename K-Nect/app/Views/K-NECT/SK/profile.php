
    <style>
        table.dataTable thead th {
            @apply bg-gray-50 text-gray-500 text-sm uppercase tracking-wide;
        }
        table.dataTable tbody tr:hover {
            @apply bg-indigo-50;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply text-gray-700 hover:text-indigo-600 transition;
        }
        
        /* Panzoom Controls Styling */
        .panzoom-controls {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            background: rgba(248, 250, 252, 0.95);
            border-radius: 6px;
            padding: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            gap: 3px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }
        
        .panzoom-controls button {
            width: 28px;
            height: 28px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            color: #374151;
        }
        
        .panzoom-controls button:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .panzoom-controls button:active {
            transform: translateY(0);
        }
        
        .panzoom-controls button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .panzoom-container {
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            position: relative;
        }
        
        .panzoom-element {
            cursor: grab;
            transition: transform 0.1s ease;
        }
        
        .panzoom-element:active {
            cursor: grabbing;
        }
        
        .panzoom-container:hover {
            border-color: #d1d5db;
        }
        
        /* Filter Tabs Styling */
        .filter-tab.active {
            background: white;
            color: #1f2937;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        .filter-tab:not(.active):hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">List of KK</h3>
                        <?php if (isset($barangay_name) && $barangay_name): ?>
                        <p class="text-sm text-gray-600 mt-1">Showing constituents from <span class="font-semibold text-purple-600"><?= esc($barangay_name) ?></span></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button id="downloadExcel" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Excel
                        </button>
                        <button id="downloadWord" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Word
                        </button>
                        <button id="downloadPdf" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </button>
                    </div>
                </div>
                
                <!-- Filter Tabs and Zone Selector -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <!-- Status Filter Tabs -->
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-700 mr-2">Status:</span>
                                <div class="flex bg-gray-100 rounded-lg p-1">
                                    <button id="filterAll" class="filter-tab active px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 bg-white text-gray-900 shadow-sm">
                                        All <span id="countAll" class="ml-1 bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full text-xs">0</span>
                                    </button>
                                    <button id="filterPending" class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                                        Pending <span id="countPending" class="ml-1 bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded-full text-xs">0</span>
                                    </button>
                                    <button id="filterVerified" class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                                        Verified <span id="countVerified" class="ml-1 bg-green-200 text-green-800 px-2 py-0.5 rounded-full text-xs">0</span>
                                    </button>
                                    <button id="filterRejected" class="filter-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                                        Rejected <span id="countRejected" class="ml-1 bg-red-200 text-red-800 px-2 py-0.5 rounded-full text-xs">0</span>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Zone Filter -->
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-700">Zone:</span>
                                <select id="zoneFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">All Zones</option>
                                    <!-- Zone options will be populated dynamically -->
                                </select>
                                <button id="clearFilters" class="ml-2 px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table id="kkTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 border-b">No.</th>
                                        <th class="px-4 py-2 border-b">User ID</th>
                                        <th class="px-4 py-2 border-b">Barangay</th>
                                        <th class="px-4 py-2 border-b">Zone/Purok</th>
                                        <th class="px-4 py-2 border-b text-left">Full Name</th>
                                        <th class="px-4 py-2 border-b">Age</th>
                                        <th class="px-4 py-2 border-b">Birthday</th>
                                        <th class="px-4 py-2 border-b">Sex</th>
                                        <th class="px-4 py-2 border-b">Status</th>
                                        <th class="px-4 py-2 border-b">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    use App\Libraries\BarangayHelper;
                                    use App\Libraries\ZoneHelper;
                                    ?>
                                    <?php if (!empty($user_list)): ?>
                                        <?php 
                                        // Debug: Check if zone_purok data exists
                                        $hasZoneData = false;
                                        foreach ($user_list as $user) {
                                            if (isset($user['zone_purok']) && !empty($user['zone_purok'])) {
                                                $hasZoneData = true;
                                                break;
                                            }
                                        }
                                        ?>
                                        <!-- Debug: Show zone data status -->
                                        <script>
                                            console.log('Zone data available:', <?= $hasZoneData ? 'true' : 'false' ?>);
                                            console.log('Sample user data:', <?= json_encode(isset($user_list[0]) ? $user_list[0] : []) ?>);
                                        </script>
                                        
                                        <?php foreach ($user_list as $user): ?>
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2 border-b text-center"><?= esc($user['id']) ?></td>
                                                <td class="px-4 py-2 border-b text-center">
                                                    <?php if (isset($user['user_id']) && $user['user_id']): ?>
                                                        <?= esc($user['user_id']) ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-4 py-2 border-b text-center">
                                                    <?= esc(BarangayHelper::getBarangayName($user['barangay'])) ?>
                                                </td>
                                                <td class="px-4 py-2 border-b text-center">
                                                    <?= isset($user['zone_purok']) && !empty($user['zone_purok']) ? esc(ZoneHelper::getZoneName($user['zone_purok'])) : '-' ?>
                                                </td>
                                                <td class="px-4 py-2 border-b text-left">
                                                    <?php
                                                        $fullName = esc($user['last_name']);
                                                        if (!empty($user['first_name'])) {
                                                            $fullName .= ', ' . esc($user['first_name']);
                                                        }
                                                        if (!empty($user['middle_name'])) {
                                                            $fullName .= ' ' . esc($user['middle_name']);
                                                        }
                                                        echo $fullName;
                                                    ?>
                                                </td>
                                                <td class="px-4 py-2 border-b text-center"><?= esc($user['age']) ?></td>
                                                <td class="px-4 py-2 border-b text-center"><?= esc($user['birthdate']) ?></td>
                                                <td class="px-4 py-2 border-b text-center"><?= $user['sex'] == '1' ? 'Male' : ($user['sex'] == '2' ? 'Female' : '') ?></td>
                                                <td class="px-4 py-2 border-b text-center">
                                                    <?php
                                                    $status = isset($user['status']) ? (int)$user['status'] : 1;
                                                    $statusClass = '';
                                                    $statusText = '';
                                                    switch($status) {
                                                        case 2:
                                                            $statusClass = 'bg-green-100 text-green-800';
                                                            $statusText = 'Accepted';
                                                            break;
                                                        case 3:
                                                            $statusClass = 'bg-red-100 text-red-800';
                                                            $statusText = 'Rejected';
                                                            break;
                                                        default:
                                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                                            $statusText = 'Pending';
                                                    }
                                                    ?>
                                                    <span class="px-2 py-1 rounded-full text-xs font-medium <?= $statusClass ?>"><?= $statusText ?></span>
                                                </td>
                                                <td class="px-4 py-2 border-b text-center">
                                                    <?php if (!empty($user['birth_certificate']) || !empty($user['upload_id'])): ?>
                                                        <?php if ($status === 1): ?>
                                                            <button type="button" onclick="openReviewModal('<?= esc($user['id']) ?>', '<?= esc($user['birth_certificate']) ?>', '<?= esc($user['upload_id']) ?>', <?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)" class="inline-flex items-center px-3 py-1 bg-yellow-400 text-yellow-900 rounded hover:bg-yellow-500 mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                                Verify
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" onclick="openViewModal('<?= esc($user['id']) ?>', '<?= esc($user['birth_certificate']) ?>', '<?= esc($user['upload_id']) ?>', <?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)" class="inline-flex items-center px-3 py-1 bg-gray-400 text-white rounded cursor-not-allowed opacity-50 mr-2" disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                                Verify
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <button type="button" onclick="openViewModal('<?= esc($user['id']) ?>', '<?= esc($user['birth_certificate']) ?>', '<?= esc($user['upload_id']) ?>', <?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)" class="inline-flex items-center px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="9" class="px-4 py-2 text-center">No KK records found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modals (reuse your existing modal HTML/JS here) -->
            <!-- Modal for document preview -->
            <div id="previewModal" class="fixed inset-0 z-[9998] hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-xl w-[90vw] max-h-[90vh] relative overflow-hidden flex flex-col">
                    <!-- Modal Header -->
                    <div class="w-full bg-white border-b border-gray-200 p-4 flex justify-between items-center z-20">
                        <h3 class="text-lg font-semibold text-gray-900">User Profile</h3>
                        <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content Wrapper (takes remaining vertical space) -->
                    <div class="flex-1 flex overflow-hidden"> <!-- New wrapper -->
                        <!-- Left: User Info -->
                        <div class="w-[40%] bg-gray-50 p-6 flex flex-col items-center justify-start overflow-y-auto">
                            <div class="w-40 h-40 bg-gray-300 mb-4 overflow-hidden shadow-md border-4 border-white flex items-center justify-center relative" style="min-width:220px; min-height:220px; max-width:220px; max-height:220px;">
                                <img id="modalUserPhoto" src="" alt="User Profile" class="w-full h-full object-cover" style="aspect-ratio:1/1; min-width:220px; min-height:220px; max-width:220px; max-height:220px; border-radius:0;">
                            </div>
                            <h4 id="modalUserFullName" class="text-lg font-semibold text-gray-900 text-center mb-1"></h4>
                            <p id="modalUserBarangay" class="text-sm text-gray-500 text-center mb-4"></p>
                            <!-- User Info Sections -->
                            <div class="w-full space-y-6">
                                <!-- Basic Information -->
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">Basic Information</h5>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label><p id="modalUserName" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">KK ID</label><p id="modalUserId" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Sex</label><p id="modalUserSex" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Email</label><p id="modalUserEmail" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Birthday</label><p id="modalUserBirthday" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Age</label><p id="modalUserAge" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Civil Status</label><p id="modalUserCivilStatus" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Status</label><span id="modalUserStatus" class="inline-flex px-2 py-1 rounded-full text-sm font-medium"></span></div>
                                    </div>
                                </div>
                                <!-- Address Information -->
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">Address Information</h5>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Barangay</label><p id="modalUserBarangayDetail" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Zone</label><p id="modalUserZone" class="text-sm text-gray-900"></p></div>
                                        <div class="col-span-2"><label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label><p id="modalUserAddress" class="text-sm text-gray-900"></p></div>
                                    </div>
                                </div>
                                <!-- Youth Classification -->
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">Youth Classification</h5>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Youth Classification</label><p id="modalUserYouthClassification" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Work Status</label><p id="modalUserWorkStatus" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Youth Age Group</label><p id="modalUserYouthAgeGroup" class="text-sm text-gray-900"></p></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Educational Background</label><p id="modalUserEducation" class="text-sm text-gray-900"></p></div>
                                    </div>
                                </div>
                                <!-- Voting Information -->
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">Voting Information</h5>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Registered SK Voter</label><span id="modalUserSKVoter" class="inline-flex px-2 py-1 rounded-full text-sm font-medium"></span></div>
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Voted Last SK Election</label><span id="modalUserVotedSK" class="inline-flex px-2 py-1 rounded-full text-sm font-medium"></span></div>
                                        <div class="col-span-2"><label class="block text-sm font-medium text-gray-500 mb-1">Registered National Voter</label><span id="modalUserNationalVoter" class="inline-flex px-2 py-1 rounded-full text-sm font-medium"></span></div>
                                    </div>
                                </div>
                                <!-- Assembly Attendance -->
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">KK Assembly Attendance</h5>
                                    <div class="space-y-3">
                                        <div><label class="block text-sm font-medium text-gray-500 mb-1">Have you attended a KK Assembly?</label><span id="modalUserAttendedAssembly" class="inline-flex px-2 py-1 rounded-full text-sm font-medium"></span></div>
                                        <div id="assemblyTimesContainer"><label class="block text-sm font-medium text-gray-500 mb-1">How many times?</label><p id="modalUserAssemblyTimes" class="text-sm text-gray-900"></p></div>
                                        <div id="assemblyReasonContainer" class="hidden"><label class="block text-sm font-medium text-gray-500 mb-1">If No, Why?</label><p id="modalUserAssemblyReason" class="text-sm text-gray-900"></p></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Action Buttons (Accept/Reject) -->
                            <div id="actionButtonsContainer" class="mt-6 flex flex-col gap-3 pt-4 border-t w-full">
                                <button id="acceptButton" onclick="acceptUser()" class="w-full py-3 px-4 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Accept
                                </button>
                                <button id="rejectButton" onclick="rejectUser()" class="w-full py-3 px-4 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reject
                                </button>
                                <button id="reverifyButton" onclick="reVerifyUser()" class="w-full py-3 px-4 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 font-semibold transition-all duration-200 flex items-center justify-center gap-2" style="display: none;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Re-verify
                                </button>
                            </div>
                        </div>
                        <!-- Right: Document Preview -->
                        <div class="w-[60%] p-6 flex flex-col gap-8 items-center justify-start relative overflow-y-auto bg-white border-l border-gray-200" id="modalDocPreview">
                            <!-- Document preview will be injected here -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Confirmation Modal with Enhanced Dark Effect -->
            <div id="confirmationModal" class="fixed inset-0 z-[9999] hidden opacity-0 transition-all duration-300 ease-in-out">
                <!-- Dark overlay with blur effect -->
                <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
                
                <!-- Modal content -->
                <div class="relative flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform scale-95 transition-all duration-300 ease-in-out border border-gray-200" id="confirmationModalContent">
                        <!-- Close button -->
                        <button onclick="closeConfirmationModal()" class="absolute -top-3 -right-3 bg-white rounded-full p-2 shadow-xl border border-gray-300 hover:bg-gray-100 transition-all duration-200 z-10">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <div id="confirmationIcon" class="mx-auto mb-4"></div>
                                <h3 id="confirmationTitle" class="text-xl font-semibold mb-2 text-gray-800"></h3>
                                <p id="confirmationMessage" class="text-gray-600"></p>
                            </div>
                            
                            <!-- Reason field (for reject only) -->
                            <div id="rejectReasonContainer" class="mb-6 hidden">
                                <label for="rejectReason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                                <textarea id="rejectReason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none" placeholder="Please provide a reason for rejection..."></textarea>
                                <p id="reasonError" class="mt-1 text-red-500 text-sm hidden">Please provide a reason for rejection.</p>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="flex gap-3">
                                <button onclick="closeConfirmationModal()" class="flex-1 py-2 px-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg font-medium transition-all duration-200">
                                    Cancel
                                </button>
                                <button id="confirmButton" class="flex-1 py-2 px-4 rounded-lg font-medium transition-all duration-200">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Notification Popup -->
    <div id="notificationPopup" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[99999] hidden px-6 py-3 rounded-lg shadow-lg text-white text-lg font-semibold transition-all duration-300"></div>
    <script>
    // Barangay mapping from PHP
    const barangayMap = <?= json_encode(BarangayHelper::getBarangayMap()) ?>;
    
    // Zone mapping from PHP
    const zoneMap = <?= json_encode(ZoneHelper::getZoneMap()) ?>;
    
    let currentUserId = null;
    let currentBirthCertFile = null;
    let currentUploadIdFile = null;
    let isAfterReVerify = false;
    let panzoomInstances = {};

    // Initialize Panzoom with Controls for an image
    function initializePanzoom(containerId, imageId) {
        const container = document.getElementById(containerId);
        const image = document.getElementById(imageId);
        
        if (!container || !image) return;
        
        // Create panzoom instance
        const panzoom = Panzoom(image, {
            maxScale: 10,
            minScale: 0.5,
            contain: 'outside',
            startScale: 1,
            startX: 0,
            startY: 0
        });
        
        // Store the instance
        panzoomInstances[containerId] = panzoom;
        
        // Create custom controls
        const controlsContainer = document.createElement('div');
        controlsContainer.className = 'panzoom-controls';
        
        // Zoom In button
        const zoomInBtn = document.createElement('button');
        zoomInBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><path d="M11 8v6"/><path d="M8 11h6"/></svg>';
        zoomInBtn.title = 'Zoom In';
        zoomInBtn.onclick = () => panzoom.zoomIn();
        
        // Zoom Out button
        const zoomOutBtn = document.createElement('button');
        zoomOutBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><path d="M8 11h6"/></svg>';
        zoomOutBtn.title = 'Zoom Out';
        zoomOutBtn.onclick = () => panzoom.zoomOut();
        
        // Reset button
        const resetBtn = document.createElement('button');
        resetBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0z"/><path d="M9 12l2 2 4-4"/></svg>';
        resetBtn.title = 'Reset View';
        resetBtn.onclick = () => {
            panzoom.reset();
            // Reset rotation and flip states
            image.dataset.rotation = '0';
            image.dataset.flippedH = 'false';
            image.dataset.flippedV = 'false';
            // Let panzoom handle the transform
            image.style.transform = '';
        };
        
        // Toggle Zoom Level button
        const toggleBtn = document.createElement('button');
        toggleBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><text x="12" y="16" text-anchor="middle" font-size="12" font-weight="bold" fill="currentColor">1:1</text></svg>';
        toggleBtn.title = 'Toggle Zoom Level (1:1)';
        toggleBtn.onclick = () => {
            const currentScale = panzoom.getScale();
            if (currentScale === 1) {
                panzoom.zoomTo(2);
            } else {
                panzoom.reset();
            }
        };
        
        // Rotate Left button
        const rotateLeftBtn = document.createElement('button');
        rotateLeftBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M18.37 15a9 9 0 1 1-1.56-8.28L3 8"/></svg>';
        rotateLeftBtn.title = 'Rotate Left (Counter-clockwise)';
        rotateLeftBtn.onclick = () => {
            const currentRotation = parseInt(image.dataset.rotation || '0');
            const newRotation = currentRotation - 90;
            image.dataset.rotation = newRotation;
            // Get current panzoom transform and add rotation
            const currentScale = panzoom.getScale();
            const currentX = panzoom.getPan().x;
            const currentY = panzoom.getPan().y;
            const isFlippedH = image.dataset.flippedH === 'true';
            const isFlippedV = image.dataset.flippedV === 'true';
            const horizontalFlip = isFlippedH ? ' scaleX(-1)' : '';
            const verticalFlip = isFlippedV ? ' scaleY(-1)' : '';
            // Apply rotation to the image element directly
            image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${newRotation}deg)${horizontalFlip}${verticalFlip}`;
        };
        
        // Rotate Right button
        const rotateRightBtn = document.createElement('button');
        rotateRightBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M5.63 15a9 9 0 1 0 1.56-8.28L21 8"/></svg>';
        rotateRightBtn.title = 'Rotate Right (Clockwise)';
        rotateRightBtn.onclick = () => {
            const currentRotation = parseInt(image.dataset.rotation || '0');
            const newRotation = currentRotation + 90;
            image.dataset.rotation = newRotation;
            // Get current panzoom transform and add rotation
            const currentScale = panzoom.getScale();
            const currentX = panzoom.getPan().x;
            const currentY = panzoom.getPan().y;
            const isFlippedH = image.dataset.flippedH === 'true';
            const isFlippedV = image.dataset.flippedV === 'true';
            const horizontalFlip = isFlippedH ? ' scaleX(-1)' : '';
            const verticalFlip = isFlippedV ? ' scaleY(-1)' : '';
            // Apply rotation to the image element directly
            image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${newRotation}deg)${horizontalFlip}${verticalFlip}`;
        };
        
        // Flip Horizontal button
        const flipHBtn = document.createElement('button');
        flipHBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h3"/><path d="M16 3h3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-3"/><path d="M12 20v2"/><path d="M12 14v2"/><path d="M12 8v2"/><path d="M12 2v2"/></svg>';
        flipHBtn.title = 'Flip Horizontal (Mirror)';
        flipHBtn.onclick = () => {
            const isFlippedH = image.dataset.flippedH === 'true';
            image.dataset.flippedH = !isFlippedH;
            // Get current panzoom transform and add flip
            const currentScale = panzoom.getScale();
            const currentX = panzoom.getPan().x;
            const currentY = panzoom.getPan().y;
            const currentRotation = parseInt(image.dataset.rotation || '0');
            const isFlippedV = image.dataset.flippedV === 'true';
            const verticalFlip = isFlippedV ? ' scaleY(-1)' : '';
            if (!isFlippedH) {
                image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${currentRotation}deg) scaleX(-1)${verticalFlip}`;
            } else {
                image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${currentRotation}deg)${verticalFlip}`;
            }
        };
        
        // Flip Vertical button
        const flipVBtn = document.createElement('button');
        flipVBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h3"/><path d="M16 3h3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-3"/><path d="M12 20v2"/><path d="M12 14v2"/><path d="M12 8v2"/><path d="M12 2v2"/></svg>';
        flipVBtn.title = 'Flip Vertical (Mirror)';
        flipVBtn.style.transform = 'rotate(90deg)';
        flipVBtn.onclick = () => {
            const isFlippedV = image.dataset.flippedV === 'true';
            image.dataset.flippedV = !isFlippedV;
            // Get current panzoom transform and add flip
            const currentScale = panzoom.getScale();
            const currentX = panzoom.getPan().x;
            const currentY = panzoom.getPan().y;
            const currentRotation = parseInt(image.dataset.rotation || '0');
            const isFlippedH = image.dataset.flippedH === 'true';
            const horizontalFlip = isFlippedH ? ' scaleX(-1)' : '';
            if (!isFlippedV) {
                image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${currentRotation}deg)${horizontalFlip} scaleY(-1)`;
            } else {
                image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentScale}) rotate(${currentRotation}deg)${horizontalFlip}`;
            }
        };
        
        // Add all buttons to controls container
        controlsContainer.appendChild(zoomInBtn);
        controlsContainer.appendChild(zoomOutBtn);
        controlsContainer.appendChild(toggleBtn);
        controlsContainer.appendChild(rotateLeftBtn);
        controlsContainer.appendChild(rotateRightBtn);
        controlsContainer.appendChild(flipHBtn);
        controlsContainer.appendChild(flipVBtn);
        controlsContainer.appendChild(resetBtn);
        
        // Add controls to container
        container.appendChild(controlsContainer);
        
        return panzoom;
    }

    // Clean up panzoom instances
    function cleanupPanzoom(containerId) {
        if (panzoomInstances[containerId]) {
            panzoomInstances[containerId].destroy();
            delete panzoomInstances[containerId];
        }
    }

    function openReviewModal(userId, birthCertFile, uploadIdFile, userInfo) {
        // Remove the old action container show - we'll handle this based on status
        currentUserId = userId;
        currentBirthCertFile = birthCertFile;
        currentUploadIdFile = uploadIdFile;
        // Fetch user info via AJAX
        $.ajax({
            url: '/getUserInfo',
            method: 'POST',
            data: { user_id: userId },
            success: function(response) {
                if (response.success) {
                    var u = response.user;
                    // Mappings for profiling fields
                    var civilStatusMap = {
                        1: 'Single', 2: 'Married', 3: 'Widowed', 4: 'Divorced', 5: 'Separated', 6: 'Annulled', 7: 'Live-in', 8: 'Unknown'
                    };
                    var youthClassificationMap = {
                        1: 'In School Youth', 2: 'Out-of-School Youth', 3: 'Working Youth', 4: 'Youth with Specific Needs', 5: 'Person with Disability', 6: 'Children in Conflict with the Law', 7: 'Indigenous People'
                    };
                    var ageGroupMap = {
                        1: 'Child Youth (15-17 years old)', 2: 'Core Youth (18-24 years old)', 3: 'Young Adult (25-30 years old)'
                    };
                    var workStatusMap = {
                        1: 'Employed', 2: 'Unemployed', 3: 'Self-Employed', 4: 'Currently Looking for a Job', 5: 'Not Interested Looking for a Job'
                    };
                    var educationMap = {
                        1: 'Elementary Level', 2: 'Elementary Graduate', 3: 'High School Level', 4: 'High School Graduate', 5: 'Vocational Level', 6: 'College Level', 7: 'College Graduate', 8: 'Vocational Level', 9: 'Master Level', 10: 'Master Graduate', 11: 'Doctorate Level', 12: 'Doctorate Graduate'
                    };
                    var howManyTimesMap = {
                        1: '1-2 times',
                        2: '3-4 times',
                        3: '5 or more times'
                    };
                    var zoneMap = {
                        1: 'Zone 1', 2: 'Zone 2', 3: 'Zone 3', 4: 'Zone 4', 5: 'Zone 5',
                        6: 'Zone 6', 7: 'Zone 7', 8: 'Zone 8', 9: 'Zone 9', 10: 'Zone 10'
                    };
                    var noWhyMap = {
                        1: "There was no KK assembly meeting",
                        2: "Not interested to attend"
                    };
                    var fullName = u.first_name + ' ' + (u.middle_name ? u.middle_name + ' ' : '') + u.last_name + (u.suffix ? ', ' + u.suffix : '');
                    var barangayStr = barangayMap[u.barangay] || u.barangay || '';
                    // User type mapping  
                    var userTypeMap = {
                        1: 'KK Member',
                        2: 'SK Official', 
                        3: 'Pederasyon Officer'
                    };
                    var userTypeStr = userTypeMap[u.user_type] || 'Unknown';
                    $('#modalUserFullName').text(fullName);
                    $('#modalUserName').text(fullName);
                    $('#modalUserBarangay').text(userTypeStr);
                    $('#modalUserBarangayDetail').text(barangayStr);
                    $('#modalUserId').text(u.user_id ? u.user_id : '-');
                    $('#modalUserAge').text(u.age + ' years old');
                    $('#modalUserSex').text(u.sex == '1' ? 'Male' : (u.sex == '2' ? 'Female' : ''));
                    $('#modalUserType').val(String(u.user_type));
                    $('#modalUserEmail').text(u.email || '');
                    if (u.birthdate) {
                        const dateObj = new Date(u.birthdate);
                        if (!isNaN(dateObj)) {
                            const day = dateObj.getDate();
                            const month = dateObj.toLocaleString('default', { month: 'long' });
                            const year = dateObj.getFullYear();
                            $('#modalUserBirthday').text(`${day}, ${month}, ${year}`);
                        } else {
                            $('#modalUserBirthday').text(u.birthdate);
                        }
                    } else {
                        $('#modalUserBirthday').text('');
                    }
                    $('#modalUserCivilStatus').text(civilStatusMap[u.civil_status] || '');
                    let statusText = '';
                    let statusClass = '';
                    if (u.status == 1) {
                        statusText = 'Pending';
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (u.status == 2) {
                        statusText = 'Accepted';
                        statusClass = 'bg-green-100 text-green-800';
                    } else if (u.status == 3) {
                        statusText = 'Rejected';
                        statusClass = 'bg-red-100 text-red-800';
                    }
                    $('#modalUserStatus').text(statusText)
                        .removeClass()
                        .addClass('inline-flex px-2 py-1 rounded-full text-sm font-medium ' + statusClass);
                    $('#modalUserZone').text(zoneMap[u.zone_purok] || u.zone_purok || '');
                    var addressParts = [];
                    if (u.zone_purok) addressParts.push(zoneMap[u.zone_purok] || u.zone_purok);
                    if (barangayStr) addressParts.push(barangayStr);
                    addressParts.push('Iriga City');
                    addressParts.push('Camarines Sur');
                    addressParts.push('Region 5');
                    var fullAddress = addressParts.join(', ');
                    $('#modalUserAddress').text(fullAddress);
                    $('#modalUserYouthClassification').text(youthClassificationMap[u.youth_classification] || '');
                    $('#modalUserWorkStatus').text(workStatusMap[u.work_status] || '');
                    $('#modalUserYouthAgeGroup').text(ageGroupMap[u.age_group] || '');
                    $('#modalUserEducation').text(educationMap[u.educational_background] || '');
                    function setYesNoColor(selector, value) {
                        let text = '';
                        let colorClass = '';
                        if (value === '1') {
                            text = 'Yes';
                            colorClass = 'bg-green-100 text-green-800';
                        } else if (value === '0') {
                            text = 'No';
                            colorClass = 'bg-red-100 text-red-800';
                        } else {
                            text = '';
                            colorClass = 'bg-yellow-100 text-yellow-800';
                        }
                        $(selector).text(text)
                            .removeClass()
                            .addClass('inline-flex px-2 py-1 rounded-full text-sm font-medium ' + colorClass);
                    }
                    setYesNoColor('#modalUserSKVoter', u.sk_voter);
                    setYesNoColor('#modalUserVotedSK', u.sk_election);
                    setYesNoColor('#modalUserNationalVoter', u.national_voter);
                    setYesNoColor('#modalUserAttendedAssembly', u.kk_assembly);
                    $('#modalUserAssemblyTimes').text(howManyTimesMap[u.how_many_times] || '');
                    $('#modalUserAssemblyReason').text(noWhyMap[u.no_why] || '');
                    if (u.profile_picture && u.profile_picture !== '') {
                        $('#modalUserPhoto').attr('src', '/uploads/profile_pictures/' + u.profile_picture);
                    } else {
                        $('#modalUserPhoto').attr('src', ''); // Set src to empty
                    }
                    // Disable user type change if status is Rejected or Pending
                    if (u.status == 3 || u.status == 1) {
                        $('#modalUserType').prop('disabled', true);
                        $('#saveUserTypeBtn').prop('disabled', true).addClass('bg-gray-300 cursor-not-allowed').removeClass('bg-blue-600 hover:bg-blue-700');
                    } else {
                        $('#modalUserType').prop('disabled', false);
                        $('#saveUserTypeBtn').prop('disabled', false).removeClass('bg-gray-300 cursor-not-allowed').addClass('bg-blue-600 hover:bg-blue-700');
                    }
                    
                    // Show/Hide action buttons based on status in review modal
                    const actionContainer = $("#actionButtonsContainer");
                    const acceptButton = $("#acceptButton");
                    const rejectButton = $("#rejectButton");
                    const reverifyButton = $("#reverifyButton");
                    
                    console.log('Review Modal - User status:', u.status, 'Type:', typeof u.status);
                    
                    if (u.status == 1) { // Pending
                        console.log('Review Modal - Showing Accept/Reject buttons for Pending user');
                        actionContainer.show();
                        acceptButton.show();
                        rejectButton.show();
                        reverifyButton.hide();
                    } else if (u.status == 2) { // Accepted
                        console.log('Review Modal - Showing Re-verify button for Accepted user');
                        actionContainer.show();
                        acceptButton.hide();
                        rejectButton.hide();
                        reverifyButton.show();
                    } else if (u.status == 3) { // Rejected
                        console.log('Review Modal - Showing Re-verify button for Rejected user');
                        actionContainer.show();
                        acceptButton.hide();
                        rejectButton.hide();
                        reverifyButton.show();
                    } else {
                        console.log('Review Modal - Hiding all buttons - unknown status:', u.status);
                        actionContainer.hide();
                    }
                } else {
                    alert('User not found.');
                }
            },
            error: function() {
                alert('Failed to fetch user info.');
            }
        });
        let modalHtml = '';
        if (birthCertFile) {
            let url = '<?= base_url('/previewDocument/certificate/') ?>' + birthCertFile;
            let ext = birthCertFile.split('.').pop().toLowerCase();
            modalHtml += `<div class="w-full border border-gray-200 rounded-lg bg-gray-50 p-4">
                <div class='font-semibold text-gray-700 mb-2'>Birth Certificate</div>
                <div class='relative w-full'>`;
            if (['pdf'].includes(ext)) {
                modalHtml += `<iframe src='${url}' style='width: 100%; height: 600px;' class='rounded border' frameborder='0'></iframe>`;
            } else if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
                modalHtml += `<div id='certPreviewWrapper' class='f-panzoom' style='max-height: 600px;'>
                    <img id='modalPreviewImgCert' class='f-panzoom__content rounded' src='${url}' alt='Birth Certificate Image' style='width: 100%; height: auto; display: block;'>
                </div>`;
            } else {
                modalHtml += `<div class='text-red-600 p-4'>Cannot preview this file type.</div>`;
            }
            modalHtml += `</div></div>`;
        }
        if (uploadIdFile) {
            let url = '<?= base_url('/previewDocument/id/') ?>' + uploadIdFile;
            let ext = uploadIdFile.split('.').pop().toLowerCase();
            modalHtml += `<div class="w-full border border-gray-200 rounded-lg mb-6 bg-gray-50 p-4">
                <div class='font-semibold text-gray-700 mb-2'>ID</div>
                <div class='relative w-full'>`;
            if (['pdf'].includes(ext)) {
                modalHtml += `<iframe src='${url}' style='width: 100%; height: 600px;' class='rounded border' frameborder='0'></iframe>`;
            } else if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
                modalHtml += `<div id='idPreviewWrapper' class='f-panzoom' style='max-height: 600px;'>
                    <img id='modalPreviewImgId' class='f-panzoom__content rounded' src='${url}' alt='ID Image' style='width: 100%; height: auto; display: block;'>
                </div>`;
            } else {
                modalHtml += `<div class='text-red-600 p-4'>Cannot preview this file type.</div>`;
            }
            modalHtml += `</div></div>`;
        }
        if (!birthCertFile && !uploadIdFile) {
            modalHtml = `<div class='text-red-600 p-4'>No birth certificate or ID uploaded for this user.</div>`;
        }
        document.getElementById('modalDocPreview').innerHTML = modalHtml;
        
        // Set modal title for verification
        document.querySelector('#previewModal h3').textContent = 'User Verification';
        
        document.getElementById('previewModal').classList.remove('hidden');
        
        // Initialize Panzoom for images after DOM is updated
        setTimeout(() => {
            console.log('Panzoom availability check:', {
                Panzoom: typeof Panzoom,
                Controls: typeof Controls,
                windowPanzoom: window.Panzoom,
                windowControls: window.Controls
            });
            
            if (birthCertFile && ['jpg','jpeg','png','gif','webp'].includes(birthCertFile.split('.').pop().toLowerCase())) {
                const certContainer = document.getElementById('certPreviewWrapper');
                if (certContainer) {
                    console.log('Initializing cert Panzoom for:', certContainer);
                    try {
                        // Try different ways to access Panzoom and Controls
                        let PanzoomClass = Panzoom || window.Panzoom;
                        let ControlsClass = Controls || window.Controls;
                        
                        if (PanzoomClass && ControlsClass) {
                            const certPanzoom = new PanzoomClass(certContainer, {
                                Controls: {
                                    display: [
                                        'zoomIn',
                                        'zoomOut',
                                        'toggle1to1',
                                        'toggleFull',
                                        'rotateCCW',
                                        'rotateCW',
                                        'flipX',
                                        'flipY',
                                        'reset'
                                    ]
                                }
                            }, { Controls: ControlsClass });
                            console.log('Cert Panzoom initialized successfully');
                        } else {
                            console.warn('Panzoom or Controls not available');
                        }
                    } catch (error) {
                        console.error('Error initializing cert Panzoom:', error);
                    }
                }
            }
            if (uploadIdFile && ['jpg','jpeg','png','gif','webp'].includes(uploadIdFile.split('.').pop().toLowerCase())) {
                const idContainer = document.getElementById('idPreviewWrapper');
                if (idContainer) {
                    console.log('Initializing ID Panzoom for:', idContainer);
                    try {
                        // Try different ways to access Panzoom and Controls
                        let PanzoomClass = Panzoom || window.Panzoom;
                        let ControlsClass = Controls || window.Controls;
                        
                        if (PanzoomClass && ControlsClass) {
                            const idPanzoom = new PanzoomClass(idContainer, {
                                Controls: {
                                    display: [
                                        'zoomIn',
                                        'zoomOut',
                                        'toggle1to1',
                                        'toggleFull',
                                        'rotateCCW',
                                        'rotateCW',
                                        'flipX',
                                        'flipY',
                                        'reset'
                                    ]
                                }
                            }, { Controls: ControlsClass });
                            console.log('ID Panzoom initialized successfully');
                        } else {
                            console.warn('Panzoom or Controls not available');
                        }
                    } catch (error) {
                        console.error('Error initializing ID Panzoom:', error);
                    }
                }
            }
        }, 100);
    }

    function closePreviewModal(reloadTable = false) {
        document.getElementById('previewModal').classList.add('hidden');
        const userInfoElem = document.getElementById('modalUserInfo');
        if (userInfoElem) userInfoElem.innerHTML = '';
        
        // Clean up Panzoom instances
        cleanupPanzoom('certPreviewWrapper');
        cleanupPanzoom('idPreviewWrapper');
        
        document.getElementById('modalDocPreview').innerHTML = '';
        
        // Check if we should reload the table (after re-verification)
        const shouldReload = reloadTable || isAfterReVerify;
        
        // Show notification if closing after re-verification
        if (isAfterReVerify) {
            showNotification('User status updated successfully', 'success');
        }
        
        currentUserId = null;
        currentBirthCertFile = null;
        currentUploadIdFile = null;
        isAfterReVerify = false;
        
        // Reload table data if needed (after re-verification)
        if (shouldReload) {
            setTimeout(() => {
                location.reload();
            }, 500);
        }
    }

    function showConfirmationModal(type) {
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.getElementById('confirmationModalContent');
        const title = document.getElementById('confirmationTitle');
        const message = document.getElementById('confirmationMessage');
        const icon = document.getElementById('confirmationIcon');
        const confirmBtn = document.getElementById('confirmButton');
        const rejectReasonContainer = document.getElementById('rejectReasonContainer');
        const reasonError = document.getElementById('reasonError');
        
        // Reset reason field
        document.getElementById('rejectReason').value = '';
        reasonError.classList.add('hidden');
        
        if (type === 'accept') {
            title.textContent = 'Accept User';
            message.textContent = 'Are you sure you want to accept this user? This action cannot be undone.';
            icon.innerHTML = `<svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`;
            confirmBtn.className = 'flex-1 py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200';
            confirmBtn.textContent = 'Accept';
            rejectReasonContainer.classList.add('hidden');
            confirmBtn.onclick = handleAcceptUser;
        } else if (type === 'reverify') {
            title.textContent = 'Re-verify User';
            message.textContent = 'Are you sure you want to re-verify this user? This will change their status to pending and allow them to be reviewed again.';
            icon.innerHTML = `<svg class="w-16 h-16 text-blue-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>`;
            confirmBtn.className = 'flex-1 py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all duration-200';
            confirmBtn.textContent = 'Re-verify';
            rejectReasonContainer.classList.add('hidden');
            confirmBtn.onclick = handleReVerifyUser;
        } else {
            title.textContent = 'Reject User';
            message.textContent = 'Are you sure you want to reject this user? This action cannot be undone.';
            icon.innerHTML = `<svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`;
            confirmBtn.className = 'flex-1 py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200';
            confirmBtn.textContent = 'Reject';
            rejectReasonContainer.classList.remove('hidden');
            confirmBtn.onclick = () => {
                const reason = document.getElementById('rejectReason').value.trim();
                if (!reason) {
                    reasonError.classList.remove('hidden');
                    return;
                }
                handleRejectUser(reason);
            };
        }
        
        // Show modal with animation
        modal.classList.remove('hidden');
        
        // Force reflow to ensure the transition works
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        });
    }

    function closeConfirmationModal() {
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.getElementById('confirmationModalContent');
        
        // Hide modal with animation
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        // Hide modal after animation completes
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function acceptUser() {
        showConfirmationModal('accept');
    }

    function rejectUser() {
        showConfirmationModal('reject');
    }

    function reVerifyUser() {
        showConfirmationModal('reverify');
    }

    // Close modal when clicking outside of it
    document.getElementById('confirmationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmationModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('confirmationModal');
            if (!modal.classList.contains('hidden')) {
                closeConfirmationModal();
            }
        }
    });

    // Add functions to handle API calls
    function showNotification(message, type = 'success') {
        const popup = document.getElementById('notificationPopup');
        popup.textContent = message;
        popup.className = `fixed top-6 left-1/2 transform -translate-x-1/2 z-[99999] px-6 py-3 rounded-lg shadow-lg text-white text-lg font-semibold transition-all duration-300 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
        popup.classList.remove('hidden');
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 2500);
    }

    function handleAcceptUser() {
        if (!currentUserId) return;
        fetch(`<?= rtrim(base_url('/approved'), '/') ?>/${currentUserId}`, {
            method: 'POST'
        })
        .then(async response => {
            const text = await response.text();
            console.log('Raw response (accept):', text);
            let data = {};
            try {
                data = JSON.parse(text);
            } catch (e) {
                showNotification('An error occurred while accepting the user', 'error');
                return;
            }
            if (response.ok && data.success) {
                showNotification('User accepted successfully', 'success');
                closeConfirmationModal();
                closePreviewModal();
                setTimeout(() => location.reload(), 1200);
            } else {
                showNotification('Failed to accept user: ' + (data.message || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred while accepting the user', 'error');
        });
    }

    function handleRejectUser(reason) {
        if (!currentUserId) return;
        const formData = new FormData();
        formData.append('reason', reason);
        fetch(`<?= rtrim(base_url('/reject'), '/') ?>/${currentUserId}`, {
            method: 'POST',
            body: formData
        })
        .then(async response => {
            const text = await response.text();
            console.log('Raw response (reject):', text);
            let data = {};
            try {
                data = JSON.parse(text);
            } catch (e) {
                showNotification('An error occurred while rejecting the user', 'error');
                return;
            }
            if (response.ok && data.success) {
                showNotification('User rejected successfully', 'success');
                closeConfirmationModal();
                closePreviewModal();
                setTimeout(() => location.reload(), 1200);
            } else {
                showNotification('Failed to reject user: ' + (data.message || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred while rejecting the user', 'error');
        });
    }

    function handleReVerifyUser() {
        if (!currentUserId) return;
        fetch(`<?= rtrim(base_url('/reverify'), '/') ?>/${currentUserId}`, {
            method: 'POST'
        })
        .then(async response => {
            const text = await response.text();
            console.log('Raw response (reverify):', text);
            let data = {};
            try {
                data = JSON.parse(text);
            } catch (e) {
                showNotification('An error occurred while re-verifying the user', 'error');
                return;
            }
            if (response.ok && data.success) {
                // Don't show notification here - let closePreviewModal handle it
                
                // Store the values locally before clearing them
                const userId = currentUserId;
                const birthCert = currentBirthCertFile;
                const uploadId = currentUploadIdFile;
                
                closeConfirmationModal();
                
                // Set the flag to indicate we're after re-verify
                isAfterReVerify = true;
                
                // Close the modal - this will trigger the success notification
                closePreviewModal();
            } else {
                showNotification('Failed to re-verify user: ' + (data.message || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred while re-verifying the user', 'error');
        });
    }




    // DataTables and download logic
    $(document).ready(function () {
        const table = $('#kkTable').DataTable({
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 1
            },
            scrollCollapse: true,
            scrollY: '300px',
            scrollX: true,
            paging: true,
            info: true,
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
            initComplete: function () {
                $('#kkTable_wrapper').addClass('text-sm text-gray-700');
                $('#kkTable_length label').addClass('inline-flex items-center gap-2');
                $('#kkTable_length select').addClass('border border-gray-300 rounded px-2 py-1');
                $('#kkTable_info').addClass('mt-2 text-gray-600');
                $('#kkTable_paginate').addClass('mt-4');
                $('#kkTable_paginate span a').addClass('px-2 py-1 border rounded mx-1');
                
                // Populate zone filter options and update counts
                populateZoneFilter();
                updateStatusCounts();
            }
        });
        
        // Function to update status counts
        function updateStatusCounts() {
            let allCount = 0;
            let pendingCount = 0;
            let verifiedCount = 0;
            let rejectedCount = 0;
            
            $('#kkTable tbody tr').each(function() {
                const statusCell = $(this).find('td').eq(8); // Status is in column 8
                if (statusCell.length) {
                    const statusText = statusCell.find('span').text().trim();
                    allCount++;
                    
                    switch(statusText) {
                        case 'Pending':
                            pendingCount++;
                            break;
                        case 'Accepted':
                            verifiedCount++;
                            break;
                        case 'Rejected':
                            rejectedCount++;
                            break;
                    }
                }
            });
            
            $('#countAll').text(allCount);
            $('#countPending').text(pendingCount);
            $('#countVerified').text(verifiedCount);
            $('#countRejected').text(rejectedCount);
        }
        
        // Function to populate zone filter dropdown
        function populateZoneFilter() {
            const zones = new Set();
            $('#kkTable tbody tr').each(function() {
                const zoneCell = $(this).find('td').eq(3); // Zone/Purok is now in the 4th column (0-indexed)
                if (zoneCell.length) {
                    const zoneText = zoneCell.text().trim();
                    if (zoneText && zoneText !== '-') {
                        zones.add(zoneText);
                    }
                }
            });
            
            console.log('Found zones:', Array.from(zones)); // Debug log
            
            const zoneFilter = $('#zoneFilter');
            Array.from(zones).sort().forEach(zone => {
                zoneFilter.append(`<option value="${zone}">${zone}</option>`);
            });
        }
        
        // Status filter tabs
        $('.filter-tab').on('click', function() {
            // Remove active class from all tabs
            $('.filter-tab').removeClass('active').removeClass('bg-white text-gray-900 shadow-sm').addClass('text-gray-500 hover:text-gray-700');
            
            // Add active class to clicked tab
            $(this).addClass('active').removeClass('text-gray-500 hover:text-gray-700').addClass('bg-white text-gray-900 shadow-sm');
            
            const filterId = $(this).attr('id');
            let filterValue = '';
            
            switch(filterId) {
                case 'filterPending':
                    filterValue = 'Pending';
                    break;
                case 'filterVerified':
                    filterValue = 'Accepted'; // Assuming "Verified" means "Accepted" status
                    break;
                case 'filterRejected':
                    filterValue = 'Rejected';
                    break;
                case 'filterAll':
                default:
                    filterValue = '';
                    break;
            }
            
            // Apply status filter (status is now in column 8 - 0-indexed)
            table.column(8).search(filterValue).draw();
            
            // Update counts after filtering
            setTimeout(updateStatusCounts, 100);
        });
        
        // Zone filter dropdown
        $('#zoneFilter').on('change', function() {
            const zoneValue = $(this).val();
            // Apply zone filter (zone/purok is in column 3 - 0-indexed)
            table.column(3).search(zoneValue).draw();
            
            // Update counts after filtering
            setTimeout(updateStatusCounts, 100);
        });
        
        // Clear filters button
        $('#clearFilters').on('click', function() {
            // Reset status filter to "All"
            $('.filter-tab').removeClass('active').removeClass('bg-white text-gray-900 shadow-sm').addClass('text-gray-500 hover:text-gray-700');
            $('#filterAll').addClass('active').removeClass('text-gray-500 hover:text-gray-700').addClass('bg-white text-gray-900 shadow-sm');
            
            // Reset zone filter
            $('#zoneFilter').val('');
            
            // Clear all column searches
            table.columns().search('').draw();
            
            // Update counts
            setTimeout(updateStatusCounts, 100);
        });
        
        function getTableData() {
            const data = [];
            const headers = [];
            $('#kkTable thead th').each(function() {
                headers.push($(this).text().trim());
            });
            data.push(headers);
            $('#kkTable tbody tr').each(function() {
                const row = [];
                $(this).find('td').each(function(index) {
                    row.push($(this).text().trim());
                });
                if (row.length > 0) {
                    data.push(row);
                }
            });
            return data;
        }
        $('#downloadExcel').on('click', function() {
            const data = getTableData();
            const ws = XLSX.utils.aoa_to_sheet(data);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "KK List");
            const colWidths = data[0].map((header, index) => {
                const maxLength = Math.max(...data.map(row => row[index] ? row[index].length : 0));
                return { wch: Math.min(Math.max(maxLength, header.length), 30) };
            });
            ws['!cols'] = colWidths;
            XLSX.writeFile(wb, "KK_List_" + new Date().toISOString().split('T')[0] + ".xlsx");
        });
        $('#downloadWord').on('click', function() {
            const data = getTableData();
            let htmlContent = `<!DOCTYPE html><html><head><meta charset=\"UTF-8\"><title>KK List</title><style>table { border-collapse: collapse; width: 100%; margin: 20px 0; }th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }th { background-color: #f2f2f2; font-weight: bold; }h1 { color: #333; text-align: center; }</style></head><body><h1>KK List Report</h1><p>Generated on: ${new Date().toLocaleDateString()}</p><table>`;
            data.forEach((row, index) => {
                htmlContent += '<tr>';
                row.forEach(cell => {
                    const tag = index === 0 ? 'th' : 'td';
                    htmlContent += `<${tag}>${cell}</${tag}>`;
                });
                htmlContent += '</tr>';
            });
            htmlContent += `</table></body></html>`;
            const blob = new Blob([htmlContent], { type: 'application/msword' });
            saveAs(blob, "KK_List_" + new Date().toISOString().split('T')[0] + ".doc");
        });
        $('#downloadPdf').on('click', function() {
            const data = getTableData();
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.setFontSize(16);
            doc.text('KK List Report', 14, 20);
            doc.setFontSize(10);
            doc.text('Generated on: ' + new Date().toLocaleDateString(), 14, 30);
            const tableData = data.slice(1);
            const headers = data[0];
            doc.autoTable({
                head: [headers],
                body: tableData,
                startY: 40,
                styles: { fontSize: 8, cellPadding: 2 },
                headStyles: { fillColor: [66, 139, 202], textColor: 255 },
                alternateRowStyles: { fillColor: [245, 245, 245] }
            });
            doc.save("KK_List_" + new Date().toISOString().split('T')[0] + ".pdf");
        });
    });

    // Add JS for openViewModal
    function openViewModal(userId, birthCertFile, uploadIdFile, userInfo) {
        currentUserId = userId;
        currentBirthCertFile = birthCertFile;
        currentUploadIdFile = uploadIdFile;
        // Fetch user info via AJAX (same as openReviewModal)
        $.ajax({
            url: '/getUserInfo',
            method: 'POST',
            data: { user_id: userId },
            success: function(response) {
                if (response.success) {
                    var u = response.user;
                    // Mappings for profiling fields (same as openReviewModal)
                    var civilStatusMap = {
                        1: 'Single', 2: 'Married', 3: 'Widowed', 4: 'Divorced', 5: 'Separated', 6: 'Annulled', 7: 'Live-in', 8: 'Unknown'
                    };
                    var youthClassificationMap = {
                        1: 'In School Youth', 2: 'Out-of-School Youth', 3: 'Working Youth', 4: 'Youth with Specific Needs', 5: 'Person with Disability', 6: 'Children in Conflict with the Law', 7: 'Indigenous People'
                    };
                    var ageGroupMap = {
                        1: 'Child Youth (15-17 years old)', 2: 'Core Youth (18-24 years old)', 3: 'Young Adult (25-30 years old)'
                    };
                    var workStatusMap = {
                        1: 'Employed', 2: 'Unemployed', 3: 'Self-Employed', 4: 'Currently Looking for a Job', 5: 'Not Interested Looking for a Job'
                    };
                    var educationMap = {
                        1: 'Elementary Level', 2: 'Elementary Graduate', 3: 'High School Level', 4: 'High School Graduate', 5: 'Vocational Level', 6: 'College Level', 7: 'College Graduate', 8: 'Vocational Level', 9: 'Master Level', 10: 'Master Graduate', 11: 'Doctorate Level', 12: 'Doctorate Graduate'
                    };
                    var howManyTimesMap = {
                        1: '1-2 times',
                        2: '3-4 times',
                        3: '5 or more times'
                    };
                    var zoneMap = {
                        1: 'Zone 1', 2: 'Zone 2', 3: 'Zone 3', 4: 'Zone 4', 5: 'Zone 5',
                        6: 'Zone 6', 7: 'Zone 7', 8: 'Zone 8', 9: 'Zone 9', 10: 'Zone 10'
                    };
                    var noWhyMap = {
                        1: "There was no KK assembly meeting",
                        2: "Not interested to attend"
                    };
                    var fullName = u.first_name + ' ' + (u.middle_name ? u.middle_name + ' ' : '') + u.last_name + (u.suffix ? ', ' + u.suffix : '');
                    var barangayStr = barangayMap[u.barangay] || u.barangay || '';
                    // User type mapping  
                    var userTypeMap = {
                        1: 'KK Member',
                        2: 'SK Official', 
                        3: 'Pederasyon Officer'
                    };
                    var userTypeStr = userTypeMap[u.user_type] || 'Unknown';
                    $('#modalUserFullName').text(fullName);
                    $('#modalUserName').text(fullName);
                    $('#modalUserBarangay').text(userTypeStr);
                    $('#modalUserBarangayDetail').text(barangayStr);
                    $('#modalUserId').text(u.user_id ? u.user_id : '-');
                    $('#modalUserAge').text(u.age + ' years old');
                    $('#modalUserSex').text(u.sex == '1' ? 'Male' : (u.sex == '2' ? 'Female' : ''));
                    $('#modalUserType').val(String(u.user_type));
                    $('#modalUserEmail').text(u.email || '');
                    if (u.birthdate) {
                        const dateObj = new Date(u.birthdate);
                        if (!isNaN(dateObj)) {
                            const day = dateObj.getDate();
                            const month = dateObj.toLocaleString('default', { month: 'long' });
                            const year = dateObj.getFullYear();
                            $('#modalUserBirthday').text(`${day}, ${month}, ${year}`);
                        } else {
                            $('#modalUserBirthday').text(u.birthdate);
                        }
                    } else {
                        $('#modalUserBirthday').text('');
                    }
                    $('#modalUserCivilStatus').text(civilStatusMap[u.civil_status] || '');
                    let statusText = '';
                    let statusClass = '';
                    if (u.status == 1) {
                        statusText = 'Pending';
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (u.status == 2) {
                        statusText = 'Accepted';
                        statusClass = 'bg-green-100 text-green-800';
                    } else if (u.status == 3) {
                        statusText = 'Rejected';
                        statusClass = 'bg-red-100 text-red-800';
                    }
                    $('#modalUserStatus').text(statusText)
                        .removeClass()
                        .addClass('inline-flex px-2 py-1 rounded-full text-sm font-medium ' + statusClass);
                    $('#modalUserZone').text(zoneMap[u.zone_purok] || u.zone_purok || '');
                    var addressParts = [];
                    if (u.zone_purok) addressParts.push(zoneMap[u.zone_purok] || u.zone_purok);
                    if (barangayStr) addressParts.push(barangayStr);
                    addressParts.push('Iriga City');
                    addressParts.push('Camarines Sur');
                    addressParts.push('Region 5');
                    var fullAddress = addressParts.join(', ');
                    $('#modalUserAddress').text(fullAddress);
                    $('#modalUserYouthClassification').text(youthClassificationMap[u.youth_classification] || '');
                    $('#modalUserWorkStatus').text(workStatusMap[u.work_status] || '');
                    $('#modalUserYouthAgeGroup').text(ageGroupMap[u.age_group] || '');
                    $('#modalUserEducation').text(educationMap[u.educational_background] || '');
                    function setYesNoColor(selector, value) {
                        let text = '';
                        let colorClass = '';
                        if (value === '1') {
                            text = 'Yes';
                            colorClass = 'bg-green-100 text-green-800';
                        } else if (value === '0') {
                            text = 'No';
                            colorClass = 'bg-red-100 text-red-800';
                        } else {
                            text = '';
                            colorClass = 'bg-yellow-100 text-yellow-800';
                        }
                        $(selector).text(text)
                            .removeClass()
                            .addClass('inline-flex px-2 py-1 rounded-full text-sm font-medium ' + colorClass);
                    }
                    setYesNoColor('#modalUserSKVoter', u.sk_voter);
                    setYesNoColor('#modalUserVotedSK', u.sk_election);
                    setYesNoColor('#modalUserNationalVoter', u.national_voter);
                    setYesNoColor('#modalUserAttendedAssembly', u.kk_assembly);
                    $('#modalUserAssemblyTimes').text(howManyTimesMap[u.how_many_times] || '');
                    $('#modalUserAssemblyReason').text(noWhyMap[u.no_why] || '');
                    if (u.profile_picture && u.profile_picture !== '') {
                        $('#modalUserPhoto').attr('src', '/uploads/profile_pictures/' + u.profile_picture);
                    } else {
                        $('#modalUserPhoto').attr('src', ''); // Set src to empty
                    }
                    
                    // Show/Hide action buttons based on status for VIEW modal
                    const actionContainer = $("#actionButtonsContainer");
                    const acceptButton = $("#acceptButton");
                    const rejectButton = $("#rejectButton");
                    const reverifyButton = $("#reverifyButton");
                    
                    console.log('View Modal - User status:', u.status, 'Type:', typeof u.status);
                    
                    if (u.status == 1) { // Pending - hide all buttons in view modal
                        console.log('View Modal - Hiding all buttons for Pending user');
                        actionContainer.hide();
                    } else if (u.status == 2) { // Accepted - show only Re-verify
                        console.log('View Modal - Showing Re-verify button for Accepted user');
                        actionContainer.show();
                        acceptButton.hide();
                        rejectButton.hide();
                        reverifyButton.show();
                    } else if (u.status == 3) { // Rejected - show only Re-verify
                        console.log('View Modal - Showing Re-verify button for Rejected user');
                        actionContainer.show();
                        acceptButton.hide();
                        rejectButton.hide();
                        reverifyButton.show();
                    } else {
                        console.log('View Modal - Hiding all buttons - unknown status:', u.status);
                        actionContainer.hide();
                    }
                } else {
                    alert('User not found.');
                }
            },
            error: function() {
                alert('Failed to fetch user info.');
            }
        });
        let modalHtml = '';
        if (birthCertFile) {
            let url = '<?= base_url('/previewDocument/certificate/') ?>' + birthCertFile;
            let ext = birthCertFile.split('.').pop().toLowerCase();
            modalHtml += `<div class="w-full border border-gray-200 rounded-lg bg-gray-50 p-4">
                <div class='font-semibold text-gray-700 mb-2'>Birth Certificate</div>
                <div class='relative w-full'>`;
            if (['pdf'].includes(ext)) {
                modalHtml += `<iframe src='${url}' style='width: 100%; height: 600px;' class='rounded border' frameborder='0'></iframe>`;
            } else if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
                modalHtml += `<div id='certPreviewWrapper' class='f-panzoom' style='max-height: 600px;'>
                    <img id='modalPreviewImgCert' class='f-panzoom__content rounded' src='${url}' alt='Birth Certificate Image' style='width: 100%; height: auto; display: block;'>
                </div>`;
            } else {
                modalHtml += `<div class='text-red-600 p-4'>Cannot preview this file type.</div>`;
            }
            modalHtml += `</div></div>`;
        }
        if (uploadIdFile) {
            let url = '<?= base_url('/previewDocument/id/') ?>' + uploadIdFile;
            let ext = uploadIdFile.split('.').pop().toLowerCase();
            modalHtml += `<div class="w-full border border-gray-200 rounded-lg mb-6 bg-gray-50 p-4">
                <div class='font-semibold text-gray-700 mb-2'>ID</div>
                <div class='relative w-full'>`;
            if (['pdf'].includes(ext)) {
                modalHtml += `<iframe src='${url}' style='width: 100%; height: 600px;' class='rounded border' frameborder='0'></iframe>`;
            } else if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
                modalHtml += `<div id='idPreviewWrapper' class='f-panzoom' style='max-height: 600px;'>
                    <img id='modalPreviewImgId' class='f-panzoom__content rounded' src='${url}' alt='ID Image' style='width: 100%; height: auto; display: block;'>
                </div>`;
            } else {
                modalHtml += `<div class='text-red-600 p-4'>Cannot preview this file type.</div>`;
            }
            modalHtml += `</div></div>`;
        }
        if (!birthCertFile && !uploadIdFile) {
            modalHtml = `<div class='text-red-600 p-4'>No birth certificate or ID uploaded for this user.</div>`;
        }
        document.getElementById('modalDocPreview').innerHTML = modalHtml;
        
        // Set modal title for profile view
        document.querySelector('#previewModal h3').textContent = 'User Profile';
        
        document.getElementById('previewModal').classList.remove('hidden');
        // Initialize Panzoom for images after DOM is updated
        setTimeout(() => {
            if (birthCertFile && ['jpg','jpeg','png','gif','webp'].includes(birthCertFile.split('.').pop().toLowerCase())) {
                const certPanzoom = Panzoom(document.getElementById('certPreviewWrapper'), {
                    Controls: {
                        display: [
                            'zoomIn',
                            'zoomOut',
                            'toggle1to1',
                            'rotateCCW',
                            'rotateCW',
                            'flipX',
                            'flipY',
                            'reset'
                        ]
                    }
                }, { Controls });
                certPanzoom.init();
            }
            if (uploadIdFile && ['jpg','jpeg','png','gif','webp'].includes(uploadIdFile.split('.').pop().toLowerCase())) {
                const idPanzoom = Panzoom(document.getElementById('idPreviewWrapper'), {
                    Controls: {
                        display: [
                            'zoomIn',
                            'zoomOut',
                            'toggle1to1',
                            'rotateCCW',
                            'rotateCW',
                            'flipX',
                            'flipY',
                            'reset'
                        ]
                    }
                }, { Controls });
                idPanzoom.init();
            }
        }, 100);
    }
    </script>
</body>
</html>