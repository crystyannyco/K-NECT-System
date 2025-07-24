
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
    </style>
        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">User Lists</h3>
                    <div class="flex flex-row gap-4 items-center">
                        <button id="downloadExcel" class="flex items-center gap-2 px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 min-w-[120px] justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Excel
                        </button>
                        <button id="downloadWord" class="flex items-center gap-2 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 min-w-[120px] justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Word
                        </button>
                        <button id="downloadPdf" class="flex items-center gap-2 px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 min-w-[120px] justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            PDF
                        </button>
                        <span class="h-6 w-px bg-gray-300 mx-2"></span>
                        <button id="downloadCredentials" class="flex items-center gap-2 px-5 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 min-w-[150px] justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Credentials
                        </button>
                    </div>
                </div>
                
                <!-- Tabs for filtering -->
                <div class="mb-4 flex justify-center">
                  <div class="inline-flex space-x-2 border border-gray-200 rounded-xl bg-gray-50 p-1">
                    <button id="tabAll" class="px-6 py-2 text-sm font-medium rounded-lg focus:outline-none text-gray-700 bg-transparent transition active-tab">All</button>
                    <button id="tabSK" class="px-6 py-2 text-sm font-medium rounded-lg focus:outline-none text-gray-700 bg-transparent transition">SK Chairman</button>
                    <button id="tabPederasyon" class="px-6 py-2 text-sm font-medium rounded-lg focus:outline-none text-gray-700 bg-transparent transition">Pederasyon Officer</button>
                    <button id="tabKK" class="px-6 py-2 text-sm font-medium rounded-lg focus:outline-none text-gray-700 bg-transparent transition">KK Member</button>
                  </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table id="myTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" id="selectAllRows" class="form-checkbox h-4 w-4 text-indigo-600">
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Barangay</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Age</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Sex</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">User Type</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">View</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                    use App\Libraries\BarangayHelper;
                                    ?>
                                    <?php if (!empty($user_list)): ?>
                                        <?php foreach ($user_list as $user): ?>
                                            <tr class="hover:bg-gray-50"
                                                data-sk_username="<?= isset($user['sk_username']) ? esc($user['sk_username']) : '' ?>"
                                                data-sk_password="<?= isset($user['sk_password']) ? esc($user['sk_password']) : '' ?>"
                                                data-ped_username="<?= isset($user['ped_username']) ? esc($user['ped_username']) : '' ?>"
                                                data-ped_password="<?= isset($user['ped_password']) ? esc($user['ped_password']) : '' ?>">
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    <input type="checkbox" class="rowCheckbox form-checkbox h-4 w-4 text-indigo-600" value="<?= esc($user['id']) ?>">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($user['id']) ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <?= esc(BarangayHelper::getBarangayName($user['barangay'])) ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($user['last_name']) ?>, <?= esc($user['first_name']) ?> <?= esc($user['middle_name']) ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($user['age']) ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $user['sex'] == '1' ? 'Male' : ($user['sex'] == '2' ? 'Female' : '') ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
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
                                                    <span class="px-2 py-1 rounded-full text-sm font-medium <?= $statusClass ?>"><?= $statusText ?></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <?php
                                                        $type = isset($user['user_type']) ? (int)$user['user_type'] : 1;
                                                        echo $type == 1 ? 'KK Member' : ($type == 2 ? 'SK Chairman' : ($type == 3 ? 'Pederasyon Officer' : 'Unknown'));
                                                    ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="#" 
                                                        class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded transition-colors duration-200 view-user-btn"
                                                        data-id="<?= esc($user['id']) ?>"
                                                    >
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center py-8">
                                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No KK records found</h3>
                                                    <p class="text-gray-500">There are no KK records in the database yet.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bulk Change Button (hidden by default) -->
    <button id="bulkChangeBtn" class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-full shadow-lg transition-all duration-200 hidden">
        Change Position for Selected
    </button>

    <!-- Bulk Change Modal -->
    <div id="bulkChangeModal" class="fixed inset-0 z-[99999] hidden bg-black bg-opacity-40 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-8 relative">
            <button id="closeBulkChangeModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Bulk Change User Position</h3>
            <div class="mb-6">
                <label for="bulkNewPosition" class="block text-sm font-medium text-gray-700 mb-2">Select New Position</label>
                <select id="bulkNewPosition" class="w-full border border-gray-300 rounded-md px-2 py-2 text-base focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">KK Member</option>
                    <option value="2">SK Chairman</option>
                    <option value="3">Pederasyon Officer</option>
                </select>
            </div>
            <div class="flex justify-center gap-4">
                <button id="confirmBulkChangeBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">Confirm</button>
                <button id="cancelBulkChangeBtn" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">Cancel</button>
            </div>
        </div>
    </div>

    <!-- User Detail Modal - Updated Version -->
    <div id="userDetailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-5xl max-h-[90vh] relative overflow-hidden">
            <!-- Confirmation Popup inside Modal -->
            <div id="roleChangeModal" class="absolute inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-30">
                <div class="bg-white rounded-lg shadow-xl p-8 max-w-md w-full mx-4 border border-gray-200">
            <div class="text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Change User Role</h3>
                <p id="roleChangeMessage" class="text-gray-600 mb-6">Are you sure you want to change the role?</p>
                <div class="flex justify-center gap-4">
                    <button id="confirmRoleChangeBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">Confirm</button>
                    <button id="cancelRoleChangeBtn" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">Cancel</button>
                </div>
            </div>
        </div>
    </div>
            <!-- Modal Header - Simplified -->
            <div class="bg-white border-b border-gray-200 p-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">User Profile</h3>
                <button id="closeUserDetailModal" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content: Two columns -->
            <div class="flex overflow-hidden">
                <!-- Left Side - Profile Picture and User Type -->
                <div class="w-1/3 bg-gray-50 p-6 flex flex-col items-center justify-start">
                    <div class="w-40 h-40 bg-gray-300 mb-4 overflow-hidden shadow-md border-4 border-white flex items-center justify-center relative" style="min-width:160px; min-height:160px; max-width:160px; max-height:160px;">
                        <img id="modalUserPhoto" src="" alt="User Profile" class="w-full h-full object-cover" style="aspect-ratio:1/1; min-width:160px; min-height:160px; max-width:160px; max-height:160px; border-radius:0;">
                    </div>
                    <h4 id="modalUserFullName" class="text-lg font-semibold text-gray-900 text-center mb-1"></h4>
                    <p id="modalUserBarangay" class="text-sm text-gray-500 text-center mb-4"></p>
                    <!-- User Type Change -->
                    <div class="w-full bg-white rounded-md p-3 shadow-sm border">
                        <label for="modalUserType" class="block text-sm font-medium text-gray-700 mb-2">User Type</label>
                        <select id="modalUserType" class="w-full border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1">KK Member</option>
                            <option value="2">SK Chairman</option>
                            <option value="3">Pederasyon Officer</option>
                        </select>
                        <button id="saveUserTypeBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-1.5 rounded-md text-sm font-medium transition-colors duration-200 mt-2">
                            Save Changes
                        </button>
                    </div>
                </div>

                <!-- Right Side - User Information -->
                <div class="w-2/3 p-6 overflow-y-auto max-h-[70vh]">
                    <div class="space-y-6">
                        <!-- Basic Information -->
                        <div>
                            <h5 class="text-sm font-medium text-gray-900 mb-3 pb-1 border-b border-gray-200">Basic Information</h5>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label><p id="modalUserName" class="text-sm text-gray-900"></p></div>
                                <div><label class="block text-sm font-medium text-gray-500 mb-1">User ID</label><p id="modalUserId" class="text-sm text-gray-900"></p></div>
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
                </div>
            </div>
        </div>
    </div>

    <div id="notificationPopup" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[99999] hidden px-6 py-3 rounded-lg shadow-lg text-white text-lg font-semibold transition-all duration-300"></div>
    <script>
        // Barangay mapping from PHP
        const barangayMap = <?= json_encode(BarangayHelper::getBarangayMap()) ?>;
        
        function showNotification(message, type = 'success') {
            const popup = document.getElementById('notificationPopup');
            popup.textContent = message;
            popup.className = `fixed top-6 left-1/2 transform -translate-x-1/2 z-[99999] px-6 py-3 rounded-lg shadow-lg text-white text-lg font-semibold transition-all duration-300 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
            popup.classList.remove('hidden');
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 2500);
        }
        $(document).ready(function () {
            // DataTable and tab logic
            const table = $('#myTable').DataTable({
                columnDefs: [
                    { orderable: false, targets: 0 }
                ],
                order: [[1, 'asc']],
                fixedColumns: {
                    leftColumns: 0,
                    rightColumns: 1
                },
                scrollCollapse: true,
                scrollY: '300px',
                scrollX: true,
                paging: true,
                info: true, // Keep the "Showing x to y of z entries"
                language: {
                    search: "", // Removes default label
                    searchPlaceholder: "Search..." // (not used here but optional)
                },
                initComplete: function () {
                    // Apply Tailwind utility classes to DataTable components
                    $('#myTable_wrapper').addClass('text-sm text-gray-700');
                    $('#myTable_length label').addClass('inline-flex items-center gap-2');
                    $('#myTable_length select').addClass('border border-gray-300 rounded px-2 py-1');
                    $('#myTable_info').addClass('mt-2 text-gray-600');
                    $('#myTable_paginate').addClass('mt-4');
                    $('#myTable_paginate span a').addClass('px-2 py-1 border rounded mx-1');
                }
            });

            // Keep our custom search input functional
            $('#kkSearch').on('keyup', function () {
                table.search(this.value).draw();
            });

            // Download functionality
            function getTableData() {
                const data = [];
                const headers = [];
                
                // Get headers
                $('#myTable thead th').each(function() {
                    headers.push($(this).text().trim());
                });
                data.push(headers);
                
                // Get data rows (only visible rows)
                $('#myTable tbody tr:visible').each(function() {
                    const row = [];
                    $(this).find('td').each(function(index) {
                        // Skip the dropdown column (last column)
                        if (index < $(this).parent().find('td').length - 1) {
                            row.push($(this).text().trim());
                        }
                    });
                    if (row.length > 0) {
                        data.push(row);
                    }
                });
                
                return data;
            }

            // Excel Download
            $('#downloadExcel').on('click', function() {
                const data = getTableData();
                const ws = XLSX.utils.aoa_to_sheet(data);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "KK List");
                
                // Auto-size columns
                const colWidths = data[0].map((header, index) => {
                    const maxLength = Math.max(...data.map(row => row[index] ? row[index].length : 0));
                    return { wch: Math.min(Math.max(maxLength, header.length), 30) };
                });
                ws['!cols'] = colWidths;
                
                XLSX.writeFile(wb, "KK_List_" + new Date().toISOString().split('T')[0] + ".xlsx");
            });

            // Word Download (as HTML)
            $('#downloadWord').on('click', function() {
                const data = getTableData();
                let htmlContent = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>KK List</title>
                        <style>
                            table { border-collapse: collapse; width: 100%; margin: 20px 0; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; font-weight: bold; }
                            h1 { color: #333; text-align: center; }
                        </style>
                    </head>
                    <body>
                        <h1>KK List Report</h1>
                        <p>Generated on: ${new Date().toLocaleDateString()}</p>
                        <table>
                `;
                
                data.forEach((row, index) => {
                    htmlContent += '<tr>';
                    row.forEach(cell => {
                        const tag = index === 0 ? 'th' : 'td';
                        htmlContent += `<${tag}>${cell}</${tag}>`;
                    });
                    htmlContent += '</tr>';
                });
                
                htmlContent += `
                        </table>
                    </body>
                    </html>
                `;
                
                const blob = new Blob([htmlContent], { type: 'application/msword' });
                saveAs(blob, "KK_List_" + new Date().toISOString().split('T')[0] + ".doc");
            });

            // PDF Download
            $('#downloadPdf').on('click', function() {
                const data = getTableData();
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Add title
                doc.setFontSize(16);
                doc.text('KK List Report', 14, 20);
                doc.setFontSize(10);
                doc.text('Generated on: ' + new Date().toLocaleDateString(), 14, 30);
                
                // Prepare data for autoTable
                const tableData = data.slice(1); // Remove header row
                const headers = data[0];
                
                doc.autoTable({
                    head: [headers],
                    body: tableData,
                    startY: 40,
                    styles: {
                        fontSize: 8,
                        cellPadding: 2
                    },
                    headStyles: {
                        fillColor: [66, 139, 202],
                        textColor: 255
                    },
                    alternateRowStyles: {
                        fillColor: [245, 245, 245]
                    }
                });
                
                doc.save("KK_List_" + new Date().toISOString().split('T')[0] + ".pdf");
            });

            // Download Credentials Button
            $('#downloadCredentials').on('click', function() {
                let headers, data = [];
                const activeTab = $('.active-tab').attr('id');
                if (activeTab === 'tabSK') {
                    headers = ['ID', 'Barangay', 'Name', 'SK Username', 'SK Password'];
                } else if (activeTab === 'tabPederasyon') {
                    headers = ['ID', 'Barangay', 'Name', 'PED Username', 'PED Password'];
                } else {
                    headers = ['ID', 'Barangay', 'Name', 'SK Username', 'SK Password', 'PED Username', 'PED Password'];
                }
                data.push(headers);

                $('#myTable tbody tr:visible').each(function() {
                    const tds = $(this).find('td');
                    const id = tds.eq(1).text().trim();
                    const barangay = tds.eq(2).text().trim();
                    const name = tds.eq(3).text().trim();
                    const skUsername = $(this).data('sk_username') || '';
                    const skPassword = $(this).data('sk_password') || '';
                    const pedUsername = $(this).data('ped_username') || '';
                    const pedPassword = $(this).data('ped_password') || '';
                    if (activeTab === 'tabSK') {
                        data.push([id, barangay, name, skUsername, skPassword]);
                    } else if (activeTab === 'tabPederasyon') {
                        data.push([id, barangay, name, pedUsername, pedPassword]);
                    } else {
                        data.push([id, barangay, name, skUsername, skPassword, pedUsername, pedPassword]);
                    }
                });
                // Convert to CSV
                let csvContent = '';
                data.forEach(row => {
                    csvContent += row.map(cell => '"' + cell.replace(/"/g, '""') + '"').join(',') + '\n';
                });
                // Download as CSV
                const blob = new Blob([csvContent], { type: 'text/csv' });
                saveAs(blob, 'User_Credentials_' + new Date().toISOString().split('T')[0] + '.csv');
            });

            // Tab filtering logic
            function setActiveTab(tab) {
                $('#tabAll, #tabSK, #tabPederasyon, #tabKK')
                  .removeClass('bg-white border font-semibold shadow text-gray-900 active-tab')
                  .addClass('bg-transparent text-gray-700 font-normal border-0');
                tab
                  .removeClass('bg-transparent text-gray-700 font-normal border-0')
                  .addClass('bg-white border font-semibold shadow text-gray-900 active-tab');
            }
            // Filtering logic for each tab
            $('#tabAll').on('click', function() {
                setActiveTab($(this));
                $('#myTable tbody tr').show();
                localStorage.setItem('kkTab', 'tabAll');
            });
            $('#tabSK').on('click', function() {
                setActiveTab($(this));
                $('#myTable tbody tr').each(function() {
                    var userType = $(this).find('td').eq(7).text().trim();
                    if (userType === 'SK Chairman') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                localStorage.setItem('kkTab', 'tabSK');
            });
            $('#tabPederasyon').on('click', function() {
                setActiveTab($(this));
                $('#myTable tbody tr').each(function() {
                    var userType = $(this).find('td').eq(7).text().trim();
                    if (userType === 'Pederasyon Officer') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                localStorage.setItem('kkTab', 'tabPederasyon');
            });
            $('#tabKK').on('click', function() {
                setActiveTab($(this));
                $('#myTable tbody tr').each(function() {
                    var userType = $(this).find('td').eq(7).text().trim();
                    if (userType === 'KK Member') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                localStorage.setItem('kkTab', 'tabKK');
            });
            // On page load, restore last selected tab
            var savedTab = localStorage.getItem('kkTab') || 'tabAll';
            $('#' + savedTab).trigger('click');

            // Bulk select checkboxes
            $('#selectAllRows').on('change', function() {
                var checked = $(this).is(':checked');
                $('.rowCheckbox').prop('checked', checked);
                updateBulkChangeBtn();
            });
            $(document).on('change', '.rowCheckbox', function() {
                if (!$(this).is(':checked')) {
                    $('#selectAllRows').prop('checked', false);
                } else if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
                    $('#selectAllRows').prop('checked', true);
                }
                updateBulkChangeBtn();
            });
            // Show/hide bulk change button
            function updateBulkChangeBtn() {
                if ($('.rowCheckbox:checked').length > 0) {
                    $('#bulkChangeBtn').removeClass('hidden');
                } else {
                    $('#bulkChangeBtn').addClass('hidden');
                }
            }
            // Open bulk change modal
            $('#bulkChangeBtn').on('click', function() {
                $('#bulkChangeModal').removeClass('hidden').css('display', 'flex');
            });
            // Close modal handlers
            $('#closeBulkChangeModal, #cancelBulkChangeBtn').on('click', function() {
                $('#bulkChangeModal').addClass('hidden').css('display', 'none');
            });
            // Confirm bulk change
            $('#confirmBulkChangeBtn').on('click', function() {
                var selectedIds = $('.rowCheckbox:checked').map(function() { return $(this).val(); }).get();
                var newType = $('#bulkNewPosition').val();
                if (selectedIds.length === 0) {
                    showNotification('No users selected.', 'error');
                    return;
                }
                // AJAX request to bulk update (endpoint must be implemented in backend)
                $.ajax({
                    url: '/bulkUpdateUserType',
                    method: 'POST',
                    data: { user_ids: selectedIds, user_type: newType },
                    success: function(response) {
                        showNotification('User positions updated successfully!', 'success');
                        location.reload();
                    },
                    error: function() {
                        showNotification('Failed to update user positions.', 'error');
                    }
                });
                $('#bulkChangeModal').addClass('hidden').css('display', 'none');
            });

            // User Detail Modal functionality
                });

            // User Detail Modal functionality
                // User Detail Modal functionality
                $(document).on('click', '.view-user-btn', function(e) {
                    e.preventDefault();
                // User Detail Modal functionality
                $(document).on('click', '.view-user-btn', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('id');
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
                                var noWhyMap = {
                                    1: "There was no KK assembly meeting",
                                    2: "Not interested to attend"
                                };
                                // Populate modal fields
                                var fullName = u.first_name + ' ' + (u.middle_name ? u.middle_name + ' ' : '') + u.last_name + (u.suffix ? ', ' + u.suffix : '');
                                $('#modalUserFullName').text(fullName);
                                $('#modalUserName').text(fullName);
                                // Barangay display (use mapping if numeric)
                                var barangayStr = barangayMap[u.barangay] || u.barangay || '';
                                $('#modalUserBarangay').text(barangayStr);
                                $('#modalUserBarangayDetail').text(barangayStr);
                                $('#modalUserId').text(u.id);
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
                                $('#modalUserZone').text(u.zone_purok || '');
                                // Address formatting with default region/province/municipality
                                var addressParts = [];
                                if (u.zone_purok) addressParts.push(u.zone_purok);
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
                                // Yes/No fields with color
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
                                if (u. _picture && u.profile_picture !== '') {
                                    $('#modalUserPhoto').attr('src', '/uploads/profile_pictures/' + u.profile_picture);
                                } else {
                                    $('#modalUserPhoto').attr('src', '');
                                }
                                // Disable user type change if status is Rejected or Pending
                                if (u.status == 3 || u.status == 1) {
                                    $('#modalUserType').prop('disabled', true);
                                    $('#saveUserTypeBtn').prop('disabled', true).addClass('bg-gray-300 cursor-not-allowed').removeClass('bg-blue-600 hover:bg-blue-700');
                                } else {
                                    $('#modalUserType').prop('disabled', false);
                                    $('#saveUserTypeBtn').prop('disabled', false).removeClass('bg-gray-300 cursor-not-allowed').addClass('bg-blue-600 hover:bg-blue-700');
                                }
                                $('#userDetailModal').removeClass('hidden');
                            } else {
                                showNotification('User not found.', 'error');
                            }
                        },
                        error: function() {
                            showNotification('Failed to fetch user info.', 'error');
                        }
                    });
                });

                // Close modal functionality
                $('#closeUserDetailModal').on('click', function() {
                    $('#userDetailModal').addClass('hidden');
                });

                // Close modal when clicking outside
                $('#userDetailModal').on('click', function(e) {
                    if (e.target === this) {
                        $('#userDetailModal').addClass('hidden');
                    }
                });

                // Save user role functionality
            let pendingUserTypeChange = { userId: null, newType: null };
                $('#saveUserTypeBtn').on('click', function() {
                // Store the intended change
                pendingUserTypeChange.userId = $('#modalUserId').text();
                pendingUserTypeChange.newType = $('#modalUserType').val();
                // Show confirmation modal (now inside userDetailModal)
                $('#roleChangeModal').removeClass('hidden');
                // Ensure it's above modal content
                $('#roleChangeModal').css('display', 'flex');
            });

            // Confirm role change
            $('#confirmRoleChangeBtn').on('click', function() {
                const userId = pendingUserTypeChange.userId;
                const newType = pendingUserTypeChange.newType;
                    $.ajax({
                        url: '/updateUserType',
                        method: 'POST',
                        data: { user_id: userId, user_type: parseInt(newType, 10) },
                        success: function(response) {
                            showNotification('User type updated successfully!', 'success');
                            location.reload();
                        },
                        error: function() {
                            showNotification('Failed to update user type.', 'error');
                        }
                    });
                // Close both modals
                $('#roleChangeModal').addClass('hidden');
                $('#roleChangeModal').css('display', 'none');
                    $('#userDetailModal').addClass('hidden');
                });

            // Cancel role change
            $('#cancelRoleChangeBtn').on('click', function() {
                $('#roleChangeModal').addClass('hidden');
                $('#roleChangeModal').css('display', 'none');
            });

                // Prevent modal from closing when clicking inside the modal content
                $('#userDetailModal .bg-white').on('click', function(e) {
                    e.stopPropagation();
            });
        });
    </script>



</body>
</html>