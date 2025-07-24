<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiling</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
        <h1 class="text-3xl font-bold text-center mb-4 text-blue-700">KK Profiling</h1>

        <?php if (session('success')): ?>
            <div id="success-popup" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="fixed inset-0 bg-black opacity-30 z-40"></div>
                <div class="bg-green-100 border border-green-400 text-green-700 px-8 py-6 rounded-lg shadow-lg relative animate-fade-in z-50" style="min-width:300px;max-width:90vw;">
                    <span class="block text-lg font-semibold mb-2">Success!</span>
                    <span><?= session('success') ?></span>
                    <button onclick="document.getElementById('success-popup').style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900 text-xl font-bold">&times;</button>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    var popup = document.getElementById('success-popup');
                    if (popup) popup.style.display = 'none';
                }, 3500);
            </script>
        <?php endif; ?>
    
        <ol class="flex items-center justify-between w-full mb-8 px-24">
            <!-- Step 1 Circle: Qualification -->
            <li class="flex flex-col items-center relative">
                <?php if ($step > 1): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </span>
                <?php elseif ($step == 1): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        1
                    </span>
                <?php else: ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-white border-2 border-blue-600 rounded-full text-blue-600 text-sm font-bold">
                        1
                    </span>
                <?php endif; ?>
                <span class="absolute left-1/2 -translate-x-1/2 top-full mt-2 text-xs text-gray-500 font-medium whitespace-nowrap">Qualification</span>
            </li>
            <!-- Line between Step 1 and Step 2 -->
            <div class="flex-1 h-1 <?php echo ($step >= 2) ? 'bg-blue-600' : 'bg-blue-100'; ?>"></div>
            <!-- Step 2 Circle: Profile -->
            <li class="flex flex-col items-center relative">
                <?php if ($step > 2): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </span>
                <?php elseif ($step == 2): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        2
                    </span>
                <?php else: ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-white border-2 border-blue-600 rounded-full text-blue-600 text-sm font-bold">
                        2
                    </span>
                <?php endif; ?>
                <span class="absolute left-1/2 -translate-x-1/2 top-full mt-2 text-xs text-gray-500 font-medium whitespace-nowrap">Profile</span>
            </li>
            <!-- Line between Step 2 and Step 3 -->
            <div class="flex-1 h-1 <?php echo ($step >= 3) ? 'bg-blue-600' : 'bg-blue-100'; ?>"></div>
            <!-- Step 3 Circle: Demographic -->
            <li class="flex flex-col items-center relative">
                <?php if ($step > 3): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </span>
                <?php elseif ($step == 3): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        3
                    </span>
                <?php else: ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-white border-2 border-blue-600 rounded-full text-blue-600 text-sm font-bold">
                        3
                    </span>
                <?php endif; ?>
                <span class="absolute left-1/2 -translate-x-1/2 top-full mt-2 text-xs text-gray-500 font-medium whitespace-nowrap">Demographic</span>
            </li>
            <!-- Line between Step 3 and Step 4 -->
            <div class="flex-1 h-1 <?php echo ($step >= 4) ? 'bg-blue-600' : 'bg-blue-100'; ?>"></div>
            <!-- Step 4 Circle: Account -->
            <li class="flex flex-col items-center relative">
                <?php if ($step > 4): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </span>
                <?php elseif ($step == 4): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        4
                    </span>
                <?php else: ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-white border-2 border-blue-600 rounded-full text-blue-600 text-sm font-bold">
                        4
                    </span>
                <?php endif; ?>
                <span class="absolute left-1/2 -translate-x-1/2 top-full mt-2 text-xs text-gray-500 font-medium whitespace-nowrap">Account</span>
            </li>
            <!-- Line between Step 4 and Step 5 -->
            <div class="flex-1 h-1 <?php echo ($step >= 5) ? 'bg-blue-600' : 'bg-blue-100'; ?>"></div>
            <!-- Step 5 Circle: Finish -->
            <li class="flex flex-col items-center relative">
                <?php if ($step == 5): ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 border-2 border-blue-600 rounded-full text-white text-sm font-bold">
                        5
                    </span>
                <?php else: ?>
                    <span class="flex items-center justify-center w-8 h-8 bg-white border-2 border-blue-600 rounded-full text-blue-600 text-sm font-bold">
                        5
                    </span>
                <?php endif; ?>
                <span class="absolute left-1/2 -translate-x-1/2 top-full mt-2 text-xs text-gray-500 font-medium whitespace-nowrap">Finish</span>
            </li>
        </ol>

        <!-- Step 1: Qualification -->
        <div class="qualification_container" id="part0" style="<?= $step == 1 ? '' : 'display:none;' ?>">
            <h2 class="text-xl font-semibold mb-2">Qualification</h2>
            <p class="mb-4">Please review the qualification requirements before proceeding.</p>
            <ul class="list-disc pl-6 mb-4 text-gray-700">
                <li>Must be 15-30 years old (or turning 15 within 1 month)</li>
                <li>Must be a resident of the specified region, province, and municipality</li>
                <li>Other requirements as specified by the program</li>
            </ul>
            <form action="<?= base_url('profiling/step1') ?>" method="post">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">I Qualify, Continue</button>
            </form>
        </div>
        <!-- Step 2: Profile Form -->
        <div class="profile_container" id="part1" style="<?= $step == 2 ? '' : 'display:none;' ?>">
            <h2 class="text-xl font-semibold mb-2">I. PROFILE</h2>
            <form action="<?= base_url('profiling/step1') ?>" method="post" class="space-y-6" id="step1Form">
                <div class="profiling-container">
                    <h4 class="font-medium">Name of Respondent:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 mt-2 mb-4">
                        <div>
                            <h4 class="font-medium">Last Name <span class="text-red-500">*</span></h4>
                            <input
                                type="text"
                                name="last_name"
                                placeholder="Dela Cruz"
                                value="<?= old('last_name') !== null ? old('last_name') : (isset($profile_data['last_name']) ? esc($profile_data['last_name']) : '') ?>"
                                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('last_name') ? 'border-red-500' : 'border-gray-300' ?>"
                            >
                            <?php if (session('validation_user') && session('validation_user')->hasError('last_name')): ?>
                                <p class="text-red-500 text-xs"><?= session('validation_user')->getError('last_name') ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-medium">First Name <span class="text-red-500">*</span></h4>
                            <input  
                                type="text"
                                name="first_name"
                                placeholder="Juan"
                                value="<?= old('first_name') !== null ? old('first_name') : (isset($profile_data['first_name']) ? esc($profile_data['first_name']) : '') ?>"
                                class="w-full  p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('first_name') ? 'border-red-500' : 'border-gray-300' ?>"
                            >
                            <?php if (session('validation_user') && session('validation_user')->hasError('first_name')): ?>
                                <p class="text-red-500 text-xs"><?= session('validation_user')->getError('first_name') ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-medium">Middle Name <i>(Optional)</i></h4>
                            <input  
                                type="text"
                                name="middle_name"
                                placeholder="Santos"
                                value="<?= old('middle_name') !== null ? old('middle_name') : (isset($profile_data['middle_name']) ? esc($profile_data['middle_name']) : '') ?>"
                                class="w-full  p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('middle_name') ? 'border-red-500' : 'border-gray-300' ?>"
                            >
                            <?php if (session('validation_user') && session('validation_user')->hasError('middle_name')): ?>
                                <p class="text-red-500 text-xs"><?= session('validation_user')->getError('middle_name') ?></p>
                            <?php endif; ?>
                        </div>
                        <div> 
                            <h4 class="font-medium">Suffix <i>(Optional)</i></h4>
                            <input  
                                type="text"
                                name="suffix"
                                placeholder="Jr."
                                value="<?= old('suffix') !== null ? old('suffix') : (isset($profile_data['suffix']) ? esc($profile_data['suffix']) : '') ?>"
                                class="w-full  p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('suffix') ? 'border-red-500' : 'border-gray-300' ?>"
                            >
                            <?php if (session('validation_user') && session('validation_user')->hasError('suffix')): ?>
                                <p class="text-red-500 text-xs"><?= session('validation_user')->getError('suffix') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="location-container">
                        <h4 class="font-medium">Location:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-2 mt-2">
                            <div>
                                <h4 class="font-medium">Region <span class="text-red-500">*</span></h4>
                        <input  
                            type="text"
                            name="region"
                            placeholder="Region"
                            value="<?= old('region') !== null ? old('region') : (isset($profile_data['region']) ? esc($profile_data['region']) : 'Region V') ?>"
                            readonly
                                    class="input input-bordered w-full   p-2 border rounded <?= session('validation_address') && session('validation_address')->hasError('region') ? 'border-red-500' : '' ?>"
                        >
                        <?php if (session('validation_address') && session('validation_address')->hasError('region')): ?>
                            <p class="text-red-500 text-xs"><?= session('validation_address')->getError('region') ?></p>
                        <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-medium">Province <span class="text-red-500">*</span></h4>
                        <input  
                            type="text"
                            name="province"
                            placeholder="Province"
                            value="<?= old('province') !== null ? old('province') : (isset($profile_data['province']) ? esc($profile_data['province']) : 'Camarines Sur') ?>"
                            readonly
                                    class="input input-bordered w-full   p-2 border rounded <?= session('validation_address') && session('validation_address')->hasError('province') ? 'border-red-500' : '' ?>"
                        >
                        <?php if (session('validation_address') && session('validation_address')->hasError('province')): ?>
                            <p class="text-red-500 text-xs"><?= session('validation_address')->getError('province') ?></p>
                        <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-medium">Municipality <span class="text-red-500">*</span></h4>
                        <input  
                            type="text"
                            name="municipality"
                            placeholder="Municipality"
                            value="<?= old('municipality') !== null ? old('municipality') : (isset($profile_data['municipality']) ? esc($profile_data['municipality']) : 'Iriga City') ?>"
                            readonly
                                    class="input input-bordered w-full   p-2 border rounded <?= session('validation_address') && session('validation_address')->hasError('municipality') ? 'border-red-500' : '' ?>"
                        >
                        <?php if (session('validation_address') && session('validation_address')->hasError('municipality')): ?>
                            <p class="text-red-500 text-xs"><?= session('validation_address')->getError('municipality') ?></p>
                        <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-medium">Barangay <span class="text-red-500">*</span></h4>
                        <select name="barangay"
                                class="input input-bordered w-full   p-2 border rounded <?= session('validation_address') && session('validation_address')->hasError('barangay') ? 'border-red-500' : '' ?>"
                            >
                            <option value="">Select Barangay</option>
                            <?php $barangay_val = old('barangay') !== null ? old('barangay') : (isset($profile_data['barangay']) ? $profile_data['barangay'] : ''); ?>
                            <option value="1" <?= $barangay_val == '1' ? 'selected' : '' ?>>Antipolo</option>
                            <option value="2" <?= $barangay_val == '2' ? 'selected' : '' ?>>Cristo Rey</option>
                            <option value="3" <?= $barangay_val == '3' ? 'selected' : '' ?>>Del Rosario (Banao)</option>
                            <option value="4" <?= $barangay_val == '4' ? 'selected' : '' ?>>Francia</option>
                            <option value="5" <?= $barangay_val == '5' ? 'selected' : '' ?>>La Anunciacion</option>
                            <option value="6" <?= $barangay_val == '6' ? 'selected' : '' ?>>La Medalla</option>
                            <option value="7" <?= $barangay_val == '7' ? 'selected' : '' ?>>La Purisima</option>
                            <option value="8" <?= $barangay_val == '8' ? 'selected' : '' ?>>La Trinidad</option>
                            <option value="9" <?= $barangay_val == '9' ? 'selected' : '' ?>>Niño Jesus</option>
                            <option value="10" <?= $barangay_val == '10' ? 'selected' : '' ?>>Perpetual Help</option>
                            <option value="11" <?= $barangay_val == '11' ? 'selected' : '' ?>>Sagrada</option>
                            <option value="12" <?= $barangay_val == '12' ? 'selected' : '' ?>>Salvacion</option>
                            <option value="13" <?= $barangay_val == '13' ? 'selected' : '' ?>>San Agustin</option>
                            <option value="14" <?= $barangay_val == '14' ? 'selected' : '' ?>>San Andres</option>
                            <option value="15" <?= $barangay_val == '15' ? 'selected' : '' ?>>San Antonio</option>
                            <option value="16" <?= $barangay_val == '16' ? 'selected' : '' ?>>San Francisco</option>
                            <option value="17" <?= $barangay_val == '17' ? 'selected' : '' ?>>San Isidro</option>
                            <option value="18" <?= $barangay_val == '18' ? 'selected' : '' ?>>San Jose</option>
                            <option value="19" <?= $barangay_val == '19' ? 'selected' : '' ?>>San Juan</option>
                            <option value="20" <?= $barangay_val == '20' ? 'selected' : '' ?>>San Miguel</option>
                            <option value="21" <?= $barangay_val == '21' ? 'selected' : '' ?>>San Nicolas</option>
                            <option value="22" <?= $barangay_val == '22' ? 'selected' : '' ?>>San Pedro</option>
                            <option value="23" <?= $barangay_val == '23' ? 'selected' : '' ?>>San Rafael</option>
                            <option value="24" <?= $barangay_val == '24' ? 'selected' : '' ?>>San Ramon</option>
                            <option value="25" <?= $barangay_val == '25' ? 'selected' : '' ?>>San Roque</option>
                            <option value="26" <?= $barangay_val == '26' ? 'selected' : '' ?>>Santiago</option>
                            <option value="27" <?= $barangay_val == '27' ? 'selected' : '' ?>>San Vicente Norte</option>
                            <option value="28" <?= $barangay_val == '28' ? 'selected' : '' ?>>San Vicente Sur</option>
                            <option value="29" <?= $barangay_val == '29' ? 'selected' : '' ?>>Santa Cruz Norte</option>
                            <option value="30" <?= $barangay_val == '30' ? 'selected' : '' ?>>Santa Cruz Sur</option>
                            <option value="31" <?= $barangay_val == '31' ? 'selected' : '' ?>>Santa Elena</option>
                            <option value="32" <?= $barangay_val == '32' ? 'selected' : '' ?>>Santa Isabel</option>
                            <option value="33" <?= $barangay_val == '33' ? 'selected' : '' ?>>Santa Maria</option>
                            <option value="34" <?= $barangay_val == '34' ? 'selected' : '' ?>>Santa Teresita</option>
                            <option value="35" <?= $barangay_val == '35' ? 'selected' : '' ?>>Santo Domingo</option>
                            <option value="36" <?= $barangay_val == '36' ? 'selected' : '' ?>>Santo Niño</option>
                        </select>
                        <?php if (session('validation_address') && session('validation_address')->hasError('barangay')): ?>
                            <p class="text-red-500 text-xs"><?= session('validation_address')->getError('barangay') ?></p>
                        <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="font-medium">Zone/Purok <span class="text-red-500">*</span></h4>
                        <input  
                            type="number"
                            name="zone_purok"
                            placeholder="Zone/Purok"
                            value="<?= old('zone_purok') !== null ? old('zone_purok') : (isset($profile_data['zone_purok']) ? esc($profile_data['zone_purok']) : '') ?>"
                                    class="input input-bordered w-full   p-2 border rounded <?= session('validation_address') && session('validation_address')->hasError('zone_purok') ? 'border-red-500' : '' ?>"
                        >
                        <?php if (session('validation_address') && session('validation_address')->hasError('zone_purok')): ?>
                            <p class="text-red-500 text-xs"><?= session('validation_address')->getError('zone_purok') ?></p>
                        <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="otherInfo-container grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1 ">Sex <span class="text-red-500">*</span></h4>
                        <select name="sex" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('sex') ? 'border-red-500' : 'border-gray-300' ?>">
                            <?php $sex_val = old('sex') !== null ? old('sex') : (isset($profile_data['sex']) ? $profile_data['sex'] : ''); ?>
                            <option value="">Select Sex...</option>
                            <option value="1" <?= $sex_val == '1' ? 'selected' : '' ?>>Male</option>
                            <option value="2" <?= $sex_val == '2' ? 'selected' : '' ?>>Female</option>
                        </select>
                        <?php if (session('validation_user') && session('validation_user')->hasError('sex')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation_user')->getError('sex') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">Birthday <span class="text-red-500">*</span></h4>
                        <input type="date" name="birthdate" placeholder="Birthday" value="<?= old('birthdate') !== null ? old('birthdate') : (isset($profile_data['birthdate']) ? esc($profile_data['birthdate']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?php if ((session('validation_user') && session('validation_user')->hasError('birthdate')) || session('age_error')) { echo 'border-red-500'; } else { echo 'border-gray-300'; } ?>">
                        <?php if (session('validation_user') && session('validation_user')->hasError('birthdate')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation_user')->getError('birthdate') ?></p>
                        <?php endif; ?>
                        <?php if (session('age_error')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('age_error') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">E-mail Address <span class="text-red-500">*</span></h4>
                        <input type="email" name="email" placeholder="E-mail Address" value="<?= old('email') !== null ? old('email') : (isset($profile_data['email']) ? esc($profile_data['email']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('email') ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (session('validation_user') && session('validation_user')->hasError('email')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation_user')->getError('email') ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">Phone Number <span class="text-red-500">*</span></h4>
                        <input type="tel" name="phone_number" placeholder="Phone Number" value="<?= old('phone_number') !== null ? old('phone_number') : (isset($profile_data['phone_number']) ? esc($profile_data['phone_number']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation_user') && session('validation_user')->hasError('phone_number') ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (session('validation_user') && session('validation_user')->hasError('phone_number')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation_user')->getError('phone_number') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="submit" formaction="<?= base_url('profiling/backToStep1') ?>" formmethod="post" class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-500 transition duration-200">Back</button>
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Continue</button>
                </div>
            </form>
        </div>
        
        <br>
        <!-- Step 3: Demographic Form -->
        <div class="demographic_container" id="part2" style="<?= $step == 3 ? '' : 'display:none;' ?>">
            <h2 class="text-xl font-semibold mb-2">II. DEMOGRAPHIC CHARACTERISTICS</h2>
            <p class="text-sm text-gray-500 mb-4">Please put a check mark next to the word or phrase that matches your response</p>
            <form action="<?= base_url('profiling/step2') ?>" method="post" class="space-y-6" id="step2Form" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Civil Status -->
                    <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('civil_status') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm">
                        <h4 class="font-medium mb-2">1. Civil Status: <span class="text-red-500">*</span></h4>
                        <select name="civil_status" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation') && session('validation')->hasError('civil_status') ? 'border-red-500' : 'border-gray-300' ?>">
                            <?php $civil_status_val = old('civil_status') !== null ? old('civil_status') : (isset($demographic_data['civil_status']) ? $demographic_data['civil_status'] : ''); ?>
                            <option value="">Select Civil Status...</option>
                            <option value="1" <?= $civil_status_val == '1' ? 'selected' : '' ?>>Single</option>
                            <option value="2" <?= $civil_status_val == '2' ? 'selected' : '' ?>>Married</option>
                            <option value="3" <?= $civil_status_val == '3' ? 'selected' : '' ?>>Widowed</option>
                            <option value="4" <?= $civil_status_val == '4' ? 'selected' : '' ?>>Divorced</option>
                            <option value="5" <?= $civil_status_val == '5' ? 'selected' : '' ?>>Separated</option>
                            <option value="6" <?= $civil_status_val == '6' ? 'selected' : '' ?>>Annulled</option>
                            <option value="7" <?= $civil_status_val == '7' ? 'selected' : '' ?>>Live-in</option>
                            <option value="8" <?= $civil_status_val == '8' ? 'selected' : '' ?>>Unknown</option>
                        </select>
                        <?php if (session('validation') && session('validation')->hasError('civil_status')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('civil_status') ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Youth Classification -->
                    <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('youth_classification') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm">
                        <h4 class="font-medium mb-2">2. Youth Classification: <span class="text-red-500">*</span></h4>
                        <?php $youth_classification_val = old('youth_classification') !== null ? old('youth_classification') : (isset($demographic_data['youth_classification']) ? $demographic_data['youth_classification'] : ''); ?>
                        <select name="youth_classification" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation') && session('validation')->hasError('youth_classification') ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">Select Youth Classification...</option>
                            <option value="1" <?= $youth_classification_val == '1' ? 'selected' : '' ?>>In School Youth</option>
                            <option value="2" <?= $youth_classification_val == '2' ? 'selected' : '' ?>>Out-of-School Youth</option>
                            <option value="3" <?= $youth_classification_val == '3' ? 'selected' : '' ?>>Working Youth</option>
                            <option value="4" <?= $youth_classification_val == '4' ? 'selected' : '' ?>>Youth with Specific Needs</option>
                            <option value="5" <?= $youth_classification_val == '5' ? 'selected' : '' ?>>Person with Disability</option>
                            <option value="6" <?= $youth_classification_val == '6' ? 'selected' : '' ?>>Children in Conflict with the Law</option>
                            <option value="7" <?= $youth_classification_val == '7' ? 'selected' : '' ?>>Indigenous People</option>
                        </select>
                        <?php if (session('validation') && session('validation')->hasError('youth_classification')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('youth_classification') ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Age Group -->
                    <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('age_group') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm">
                        <h4 class="font-medium mb-2">3. Youth Age Group: <span class="text-red-500">*</span></h4>
                        <?php $age_group_val = old('age_group') !== null ? old('age_group') : (isset($profile_data['age_group']) ? $profile_data['age_group'] : (isset($demographic_data['age_group']) ? $demographic_data['age_group'] : '')); ?>
                        <select name="age_group" id="age_group_select" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation') && session('validation')->hasError('age_group') ? 'border-red-500' : 'border-gray-300' ?>" disabled>
                            <option value="">Select Age Group...</option>
                            <option value="1" <?= $age_group_val == '1' ? 'selected' : '' ?>>Child Youth (15-17 years old)</option>
                            <option value="2" <?= $age_group_val == '2' ? 'selected' : '' ?>>Young Adult (18-24 years old)</option>
                            <option value="3" <?= $age_group_val == '3' ? 'selected' : '' ?>>Adult (25-30 years old)</option>
                        </select>
                        <input type="hidden" name="age_group" value="<?= esc($age_group_val) ?>">
                        <?php if (session('validation') && session('validation')->hasError('age_group')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('age_group') ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Work Status -->
                    <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('work_status') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm">
                        <h4 class="font-medium mb-2">4. Work Status: <span class="text-red-500">*</span></h4>
                        <?php $work_status_val = old('work_status') !== null ? old('work_status') : (isset($demographic_data['work_status']) ? $demographic_data['work_status'] : ''); ?>
                        <select name="work_status" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation') && session('validation')->hasError('work_status') ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">Select Work Status...</option>
                            <option value="1" <?= $work_status_val == '1' ? 'selected' : '' ?>>Employed</option>
                            <option value="2" <?= $work_status_val == '2' ? 'selected' : '' ?>>Unemployed</option>
                            <option value="3" <?= $work_status_val == '3' ? 'selected' : '' ?>>Currently looking for a Job</option>
                            <option value="4" <?= $work_status_val == '4' ? 'selected' : '' ?>>Not Interested in finding a job</option>
                        </select>
                        <?php if (session('validation') && session('validation')->hasError('work_status')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('work_status') ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Educational Background -->
                    <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('educational_background') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm md:col-span-2">
                        <h4 class="font-medium mb-2">5. Educational Background: <span class="text-red-500">*</span></h4>
                        <?php $educational_background_val = old('educational_background') !== null ? old('educational_background') : (isset($demographic_data['educational_background']) ? $demographic_data['educational_background'] : ''); ?>
                        <select name="educational_background" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= session('validation') && session('validation')->hasError('educational_background') ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">Select Educational Background...</option>
                            <option value="1" <?= $educational_background_val == '1' ? 'selected' : '' ?>>Elementary Level</option>
                            <option value="2" <?= $educational_background_val == '2' ? 'selected' : '' ?>>Elementary Graduate</option>
                            <option value="3" <?= $educational_background_val == '3' ? 'selected' : '' ?>>High School Level</option>
                            <option value="4" <?= $educational_background_val == '4' ? 'selected' : '' ?>>High School Graduate</option>
                            <option value="5" <?= $educational_background_val == '5' ? 'selected' : '' ?>>Vocational Level</option>
                            <option value="6" <?= $educational_background_val == '6' ? 'selected' : '' ?>>College Level</option>
                            <option value="7" <?= $educational_background_val == '7' ? 'selected' : '' ?>>College Graduate</option>
                            <option value="8" <?= $educational_background_val == '8' ? 'selected' : '' ?>>Master Level</option>
                            <option value="9" <?= $educational_background_val == '9' ? 'selected' : '' ?>>Master Graduate</option>
                            <option value="10" <?= $educational_background_val == '10' ? 'selected' : '' ?>>Doctorate Level</option>
                            <option value="11" <?= $educational_background_val == '11' ? 'selected' : '' ?>>Doctorate Graduate</option>
                        </select>
                        <?php if (session('validation') && session('validation')->hasError('educational_background')): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('educational_background') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Voters Info and Assembly -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="flex flex-col gap-6">
                        <!-- 6. Registered SK Voter? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('sk_voter') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">6. Registered SK Voter? <span class="text-red-500">*</span></h4>
                            <div class="flex gap-4">
                                <?php $sk_voter_val = old('sk_voter') !== null ? old('sk_voter') : (isset($demographic_data['sk_voter']) ? $demographic_data['sk_voter'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="sk_voter" value="1" <?= $sk_voter_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="sk_voter" value="0" <?= $sk_voter_val === '0' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('sk_voter')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('sk_voter') ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- 7. Did you vote last SK election? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('sk_election') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">7. Did you vote last SK election? <span class="text-red-500">*</span></h4>
                            <div class="flex gap-4">
                                <?php $sk_election_val = old('sk_election') !== null ? old('sk_election') : (isset($demographic_data['sk_election']) ? $demographic_data['sk_election'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="sk_election" value="1" <?= $sk_election_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="sk_election" value="0" <?= $sk_election_val === '0' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('sk_election')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('sk_election') ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- 8. Registered National Voter? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('national_voter') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">8. Registered National Voter? <span class="text-red-500">*</span></h4>
                            <div class="flex gap-4">
                                <?php $national_voter_val = old('national_voter') !== null ? old('national_voter') : (isset($demographic_data['national_voter']) ? $demographic_data['national_voter'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="national_voter" value="1" <?= $national_voter_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="national_voter" value="0" <?= $national_voter_val === '0' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('national_voter')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('national_voter') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6">
                        <!-- 9. Have you already attended a KK Assembly? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('kk_assembly') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">9. Have you already attended a KK Assembly? <span class="text-red-500">*</span></h4>
                            <div class="flex gap-4">
                                <?php $kk_assembly_val = old('kk_assembly') !== null ? old('kk_assembly') : (isset($demographic_data['kk_assembly']) ? $demographic_data['kk_assembly'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="kk_assembly" value="1" <?= $kk_assembly_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="kk_assembly" value="0" <?= $kk_assembly_val === '0' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('kk_assembly')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('kk_assembly') ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- 10. If Yes, How many times? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('how_many_times') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">10. If Yes, How many times?</h4>
                            <div class="flex gap-4">
                                <?php $how_many_times_val = old('how_many_times') !== null ? old('how_many_times') : (isset($demographic_data['how_many_times']) ? $demographic_data['how_many_times'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="how_many_times" value="1" <?= $how_many_times_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">1-2 times</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="how_many_times" value="2" <?= $how_many_times_val === '2' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">3-4 times</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="how_many_times" value="3" <?= $how_many_times_val === '3' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">5 or more times</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('how_many_times')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('how_many_times') ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- 11. If No, Why? -->
                        <div class="bg-gray-50 border <?= session('validation') && session('validation')->hasError('no_why') ? 'border-red-500' : 'border-gray-200' ?> rounded-lg p-4 shadow-sm flex flex-col gap-2">
                            <h4 class="font-medium mb-2">11. If No, Why?</h4>
                            <div class="flex gap-4 flex-wrap">
                                <?php $no_why_val = old('no_why') !== null ? old('no_why') : (isset($demographic_data['no_why']) ? $demographic_data['no_why'] : ''); ?>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="no_why" value="1" <?= $no_why_val === '1' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">There was no KK Assembly Meeting</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer hover:bg-blue-50 rounded px-2 py-1">
                                    <input type="radio" name="no_why" value="0" <?= $no_why_val === '0' ? 'checked' : '' ?> class="form-radio text-blue-600">
                                    <span class="ml-2">Not Interested to Attend</span>
                                </label>
                            </div>
                            <?php if (session('validation') && session('validation')->hasError('no_why')): ?>
                                <p class="text-red-500 text-xs mt-1"><?= session('validation')->getError('no_why') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Document Uploads -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm flex flex-col gap-2">
                        <h4 class="font-medium mb-2">Upload Birth Certificate <span class="text-red-500">*</span></h4>
                        <?php $birth_cert_file = old('birth_certificate') ?? ($demographic_data['birth_certificate'] ?? ''); ?>
                        <input type="file" name="birth_certificate" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <?php if ($birth_cert_file): ?>
                            <p class="text-xs text-green-700 mt-1">Old file: <a href="<?= base_url('uploads/certificate/' . $birth_cert_file) ?>" target="_blank" class="underline text-blue-700"><?= esc($birth_cert_file) ?></a></p>
                        <?php endif; ?>
                        <?php if (session('file_errors') && isset(session('file_errors')['birth_certificate'])): ?>
                            <p class="text-xs text-red-600 mt-1"><?= session('file_errors')['birth_certificate'] ?></p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF, WEBP, PDF. Maximum size: 5MB.</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm flex flex-col gap-2">
                        <h4 class="font-medium mb-2">Upload Valid ID <span class="text-red-500">*</span></h4>
                        <?php $upload_id_file = old('upload_id') ?? ($demographic_data['upload_id'] ?? ''); ?>
                        <input type="file" name="upload_id" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <?php if ($upload_id_file): ?>
                            <p class="text-xs text-green-700 mt-1">Old file: <a href="<?= base_url('uploads/id/' . $upload_id_file) ?>" target="_blank" class="underline text-blue-700"><?= esc($upload_id_file) ?></a></p>
                        <?php endif; ?>
                        <?php if (session('file_errors') && isset(session('file_errors')['upload_id'])): ?>
                            <p class="text-xs text-red-600 mt-1"><?= session('file_errors')['upload_id'] ?></p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF, WEBP, PDF. Maximum size: 5MB.</p>
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="submit" formaction="<?= base_url('profiling/backToStep2') ?>" formmethod="post" class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-500 transition duration-200">Back</button>
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Continue</button>
                </div>
            </form>
        </div>
        
        <!-- Step 4: Account Form -->
        <div class="account_container" id="part3" style="<?= $step == 4 ? '' : 'display:none;' ?>">
            <h2 class="text-xl font-semibold mb-2">III. ACCOUNT INFORMATION</h2>
            <form action="<?= base_url('profiling/step3') ?>" method="post" class="space-y-6" id="step3Form" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6">
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">Username <span class="text-red-500">*</span></h4>
                        <?php $validationAccountErrors = session('validation_account_errors') ?? []; ?>
                        <input type="text" name="username" placeholder="Username" value="<?= old('username') !== null ? old('username') : (isset($account_data['username']) ? esc($account_data['username']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= isset($validationAccountErrors['username']) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validationAccountErrors['username'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?= $validationAccountErrors['username'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">Password <span class="text-red-500">*</span></h4>
                        <?php $validationAccountErrors = session('validation_account_errors') ?? []; ?>
                        <input type="password" name="password" placeholder="Password" value="<?= old('password') !== null ? old('password') : (isset($account_data['password']) ? esc($account_data['password']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= isset($validationAccountErrors['password']) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validationAccountErrors['password'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?= $validationAccountErrors['password'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1">Confirm Password <span class="text-red-500">*</span></h4>
                        <?php $validationAccountErrors = session('validation_account_errors') ?? []; ?>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?= old('confirm_password') !== null ? old('confirm_password') : (isset($account_data['confirm_password']) ? esc($account_data['confirm_password']) : '') ?>" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= isset($validationAccountErrors['confirm_password']) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validationAccountErrors['confirm_password'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?= $validationAccountErrors['confirm_password'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="info-container mb-2 flex flex-col">
                        <h4 class="font-medium mb-1 flex items-center gap-2">1x1 Profile Picture (White Background) <span class="text-red-500">*</span>
                            <button type="button" id="showSamplePicBtn" class="ml-2 text-blue-600 underline text-xs hover:text-blue-800">Sample</button>
                        </h4>
                        <?php $profile_picture_file = old('profile_picture') ?? ($account_data['profile_picture'] ?? ''); ?>
                        <input type="file" name="profile_picture" accept=".jpg,.jpeg,.png,.webp" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 <?= (isset(session('file_errors')['profile_picture']) && session('file_errors')['profile_picture']) ? 'border-red-500' : 'border-gray-300' ?>" >
                        <?php if ($profile_picture_file): ?>
                            <p class="text-xs text-green-700 mt-1">Old file: <a href="<?= base_url('uploads/profile_pictures/' . $profile_picture_file) ?>" target="_blank" class="underline text-blue-700"><?= esc($profile_picture_file) ?></a></p>
                        <?php endif; ?>
                        <?php if (isset(session('file_errors')['profile_picture']) && session('file_errors')['profile_picture']): ?>
                            <p class="text-red-500 text-xs mt-1"><?= session('file_errors')['profile_picture'] ?></p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, WEBP. Maximum size: 5MB.</p>
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <button type="submit" formaction="<?= base_url('profiling/backToStep3') ?>" formmethod="post" class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-500 transition duration-200">Back</button>
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Continue</button>
                </div>
            </form>
        </div>
        <!-- Sample Profile Picture Modal -->
        <div id="samplePicModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
            <div class="bg-white border border-blue-400 text-blue-700 px-8 pt-6 pb-4 rounded-lg shadow-lg relative animate-fade-in max-w-sm w-full flex flex-col items-center z-20">
                <span class="block text-lg font-semibold mb-2">Sample 1x1 Picture</span>
                <div style="width: 15rem; height: 15rem; overflow: hidden; border: 1px solid #d1d5db; border-radius: 0.375rem; background: white; margin-bottom: 0.5rem; margin-top: 0;">
                    <img src="https://i.pinimg.com/736x/d4/5e/77/d45e7768a551280b6597d3cb5caa589b.jpg" alt="Sample 1x1" style="width: 100%; height: 120%; object-fit: cover; object-position: center top; position: relative; top: -20px;">
                </div>
                <span class="text-xs text-gray-500 mb-2">White background, clear face, 1x1 ratio</span>
                <button id="closeSamplePicModal" class="absolute top-2 right-2 text-blue-700 hover:text-blue-900 text-xl font-bold">&times;</button>
            </div>
            <div id="samplePicModalBg" class="fixed inset-0 bg-black opacity-30 z-10"></div>
        </div>
        
        <!-- Step 5: Preview Information -->
        <div class="preview_container" id="part4" style="<?= $step == 5 ? '' : 'display:none;' ?>">
            <h2 class="text-xl font-semibold mb-4 text-center">Preview Your Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold mb-2 text-blue-700">Profile Information</h3>
                    <ul class="text-gray-700 text-sm space-y-1">
                        <li><strong>Last Name:</strong> <?= esc($profile_data['last_name'] ?? '') ?></li>
                        <li><strong>First Name:</strong> <?= esc($profile_data['first_name'] ?? '') ?></li>
                        <li><strong>Middle Name:</strong> <?= esc($profile_data['middle_name'] ?? '') ?></li>
                        <li><strong>Suffix:</strong> <?= esc($profile_data['suffix'] ?? '') ?></li>
                        <li><strong>Region:</strong> <?= esc($profile_data['region'] ?? '') ?></li>
                        <li><strong>Province:</strong> <?= esc($profile_data['province'] ?? '') ?></li>
                        <li><strong>Municipality:</strong> <?= esc($profile_data['municipality'] ?? '') ?></li>
                        <li><strong>Barangay:</strong> <?= esc($profile_data['barangay'] ?? '') ?></li>
                        <li><strong>Zone/Purok:</strong> <?= esc($profile_data['zone_purok'] ?? '') ?></li>
                        <li><strong>Sex:</strong> <?= isset($profile_data['sex']) ? ($profile_data['sex'] == '1' ? 'Male' : ($profile_data['sex'] == '2' ? 'Female' : '')) : '' ?></li>
                        <li><strong>Birthday:</strong> <?= esc($profile_data['birthdate'] ?? '') ?></li>
                        <li><strong>Email:</strong> <?= esc($profile_data['email'] ?? '') ?></li>
                        <li><strong>Phone Number:</strong> <?= esc($profile_data['phone_number'] ?? '') ?></li>
                        <li><strong>Username:</strong> <?= esc($account_data['username'] ?? '') ?></li>
                        <li><strong>Password:</strong> <?= isset($account_data['password']) && $account_data['password'] !== '' ? str_repeat('•', max(8, strlen($account_data['password']))) : '' ?></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-2 text-blue-700">Demographic Information</h3>
                    <ul class="text-gray-700 text-sm space-y-1">
                        <li><strong>Civil Status:</strong> <?= esc($demographic_data['civil_status'] ?? '') ?></li>
                        <li><strong>Youth Classification:</strong> <?= esc($demographic_data['youth_classification'] ?? '') ?></li>
                        <li><strong>Age Group:</strong> <?= esc($demographic_data['age_group'] ?? '') ?></li>
                        <li><strong>Work Status:</strong> <?= esc($demographic_data['work_status'] ?? '') ?></li>
                        <li><strong>Educational Background:</strong> <?= esc($demographic_data['educational_background'] ?? '') ?></li>
                        <li><strong>Registered SK Voter:</strong> <?= isset($demographic_data['sk_voter']) ? ($demographic_data['sk_voter'] == '1' ? 'Yes' : ($demographic_data['sk_voter'] == '0' ? 'No' : '')) : '' ?></li>
                        <li><strong>Voted Last SK Election:</strong> <?= isset($demographic_data['sk_election']) ? ($demographic_data['sk_election'] == '1' ? 'Yes' : ($demographic_data['sk_election'] == '0' ? 'No' : '')) : '' ?></li>
                        <li><strong>Registered National Voter:</strong> <?= isset($demographic_data['national_voter']) ? ($demographic_data['national_voter'] == '1' ? 'Yes' : ($demographic_data['national_voter'] == '0' ? 'No' : '')) : '' ?></li>
                        <li><strong>Attended KK Assembly:</strong> <?= isset($demographic_data['kk_assembly']) ? ($demographic_data['kk_assembly'] == '1' ? 'Yes' : ($demographic_data['kk_assembly'] == '0' ? 'No' : '')) : '' ?></li>
                        <li><strong>How Many Times:</strong> <?= esc($demographic_data['how_many_times'] ?? '') ?></li>
                        <li><strong>If No, Why:</strong> <?= esc($demographic_data['no_why'] ?? '') ?></li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-between mt-8">
                <form action="<?= base_url('profiling/backToStep4') ?>" method="post" style="display:inline;">
                    <button type="submit" class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-500 transition duration-200">Back</button>
                </form>
                <form action="<?= base_url('profiling/submit') ?>" method="post" style="display:inline;">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Confirm & Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div id="file-size-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white border border-red-400 text-red-700 px-8 py-6 rounded-lg shadow-lg relative animate-fade-in max-w-sm w-full z-10">
            <span class="block text-lg font-semibold mb-2">File Size Error</span>
            <span id="file-size-modal-message"></span>
            <button id="file-size-modal-close" class="absolute top-2 right-2 text-red-700 hover:text-red-900 text-xl font-bold">&times;</button>
        </div>
        <div id="file-size-modal-bg" class="fixed inset-0 bg-black opacity-30 z-0"></div>
    </div>
    <script>
        // Add this script before the closing </body> tag
document.addEventListener('DOMContentLoaded', function() {
    const birthdateInput = document.querySelector('input[name="birthdate"]');
    const ageGroupSelect = document.querySelector('#age_group_select');
    
    function calculateAge(birthdate) {
        const today = new Date();
        const birthDate = new Date(birthdate);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        return age;
    }
    
    function updateAgeGroup() {
        const birthdate = birthdateInput.value;
        if (!birthdate) {
            ageGroupSelect.value = '';
            return;
        }
        
        const age = calculateAge(birthdate);
        
        // Determine age group based on age
        if (age >= 15 && age <= 17) {
            ageGroupSelect.value = '1'; // Child Youth (15-17 years old)
        } else if (age >= 18 && age <= 24) {
            ageGroupSelect.value = '2'; // Young Adult (18-24 years old)
        } else if (age >= 25 && age <= 30) {
            ageGroupSelect.value = '3'; // Adult (25-30 years old)
        } else {
            ageGroupSelect.value = ''; // Outside youth age range
        }
    }
    
    // Update age group when birthdate changes
    birthdateInput.addEventListener('change', updateAgeGroup);
    
    // Update age group on page load if birthdate already has a value
    if (birthdateInput.value) {
        updateAgeGroup();
    }

    // --- No. 6 and No. 8 logic ---
    const skVoterRadios = document.querySelectorAll('input[name="sk_voter"]');
    const nationalVoterRadios = document.querySelectorAll('input[name="national_voter"]');
    function updateNationalVoter() {
        const skVoter = document.querySelector('input[name="sk_voter"]:checked');
        const form = document.querySelector('form#step2Form');
        let hiddenInput = form.querySelector('input[name="national_voter"][type="hidden"]');
        if (skVoter && skVoter.value === '0') {
            // Set National Voter to No and disable
            nationalVoterRadios.forEach(radio => {
                if (radio.value === '0') {
                    radio.checked = true;
                }
                radio.disabled = true;
            });
            // Add hidden input if not present
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'national_voter';
                hiddenInput.value = '0';
                form.appendChild(hiddenInput);
            }
        } else {
            // Enable National Voter
            nationalVoterRadios.forEach(radio => {
                radio.disabled = false;
            });
            // Remove hidden input if present
            if (hiddenInput) {
                hiddenInput.remove();
            }
        }
    }
    skVoterRadios.forEach(radio => {
        radio.addEventListener('change', updateNationalVoter);
    });
    // Run on page load
    updateNationalVoter();

    // --- No. 9, 10, 11 logic ---
    const kkAssemblyRadios = document.querySelectorAll('input[name="kk_assembly"]');
    const howManyTimesRadios = document.querySelectorAll('input[name="how_many_times"]');
    const noWhyRadios = document.querySelectorAll('input[name="no_why"]');
    function updateKKAssemblyRelated() {
        const kkAssembly = document.querySelector('input[name="kk_assembly"]:checked');
        if (kkAssembly && kkAssembly.value === '0') {
            // If No, disable How many times, enable No Why
            howManyTimesRadios.forEach(radio => {
                radio.checked = false;
                radio.disabled = true;
            });
            noWhyRadios.forEach(radio => {
                radio.disabled = false;
            });
        } else if (kkAssembly && kkAssembly.value === '1') {
            // If Yes, enable How many times, disable No Why
            howManyTimesRadios.forEach(radio => {
                radio.disabled = false;
            });
            noWhyRadios.forEach(radio => {
                radio.checked = false;
                radio.disabled = true;
            });
        } else {
            // If not selected, enable both
            howManyTimesRadios.forEach(radio => {
                radio.disabled = false;
            });
            noWhyRadios.forEach(radio => {
                radio.disabled = false;
            });
        }
    }
    kkAssemblyRadios.forEach(radio => {
        radio.addEventListener('change', updateKKAssemblyRelated);
    });
    // Run on page load
    updateKKAssemblyRelated();

    // --- File size validation popup ---
    const birthCertInput = document.querySelector('input[name="birth_certificate"]');
    const uploadIdInput = document.querySelector('input[name="upload_id"]');
    const profilePictureInput = document.querySelector('input[name="profile_picture"]');
    const form = document.querySelector('form#step2Form');
    const form3 = document.querySelector('form#step3Form');
    const MAX_SIZE = 5 * 1024 * 1024; // 5MB
    const modal = document.getElementById('file-size-modal');
    const modalMsg = document.getElementById('file-size-modal-message');
    const modalClose = document.getElementById('file-size-modal-close');
    const modalBg = document.getElementById('file-size-modal-bg');
    if (form) {
        form.addEventListener('submit', function(e) {
            let errorMsg = '';
            
            // Birth Certificate validation
            if (birthCertInput && birthCertInput.files[0]) {
                const file = birthCertInput.files[0];
                const fileName = file.name;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];
                
                if (!allowedTypes.includes(file.type)) {
                    errorMsg += `Invalid file type for Birth Certificate '${fileName}'. Allowed formats: JPG, PNG, GIF, WEBP, PDF.<br>`;
                } else if (file.size > MAX_SIZE) {
                    errorMsg += `Birth Certificate file '${fileName}' is too large (${fileSizeMB} MB). Maximum allowed size is 5MB.<br>`;
                }
            }
            
            // Valid ID validation
            if (uploadIdInput && uploadIdInput.files[0]) {
                const file = uploadIdInput.files[0];
                const fileName = file.name;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];
                
                if (!allowedTypes.includes(file.type)) {
                    errorMsg += `Invalid file type for Valid ID '${fileName}'. Allowed formats: JPG, PNG, GIF, WEBP, PDF.<br>`;
                } else if (file.size > MAX_SIZE) {
                    errorMsg += `Valid ID file '${fileName}' is too large (${fileSizeMB} MB). Maximum allowed size is 5MB.<br>`;
                }
            }
            
            // Profile Picture validation
            if (profilePictureInput && profilePictureInput.files[0]) {
                const file = profilePictureInput.files[0];
                const fileName = file.name;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                
                if (!allowedTypes.includes(file.type)) {
                    errorMsg += `Invalid file type for Profile Picture '${fileName}'. Allowed formats: JPG, PNG, WEBP.<br>`;
                } else if (file.size > MAX_SIZE) {
                    errorMsg += `Profile Picture file '${fileName}' is too large (${fileSizeMB} MB). Maximum allowed size is 5MB.<br>`;
                }
            }
            
            if (errorMsg) {
                e.preventDefault();
                modalMsg.innerHTML = errorMsg;
                modal.classList.remove('hidden');
            }
        });
    }
    
    // Validation for step 3 form (profile picture)
    if (form3) {
        form3.addEventListener('submit', function(e) {
            let errorMsg = '';
            
            // Profile Picture validation
            if (profilePictureInput && profilePictureInput.files[0]) {
                const file = profilePictureInput.files[0];
                const fileName = file.name;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                
                if (!allowedTypes.includes(file.type)) {
                    errorMsg += `Invalid file type for Profile Picture '${fileName}'. Allowed formats: JPG, PNG, WEBP.<br>`;
                } else if (file.size > MAX_SIZE) {
                    errorMsg += `Profile Picture file '${fileName}' is too large (${fileSizeMB} MB). Maximum allowed size is 5MB.<br>`;
                }
            }
            
            if (errorMsg) {
                e.preventDefault();
                modalMsg.innerHTML = errorMsg;
                modal.classList.remove('hidden');
            }
        });
    }
    if (modalClose) {
        modalClose.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    }
    if (modalBg) {
        modalBg.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    }

    // --- Sample Profile Picture Modal ---
    const showSamplePicBtn = document.getElementById('showSamplePicBtn');
    const samplePicModal = document.getElementById('samplePicModal');
    const closeSamplePicModal = document.getElementById('closeSamplePicModal');
    const samplePicModalBg = document.getElementById('samplePicModalBg');
    if (showSamplePicBtn && samplePicModal && closeSamplePicModal && samplePicModalBg) {
        showSamplePicBtn.addEventListener('click', function() {
            samplePicModal.classList.remove('hidden');
        });
        closeSamplePicModal.addEventListener('click', function() {
            samplePicModal.classList.add('hidden');
        });
        samplePicModalBg.addEventListener('click', function() {
            samplePicModal.classList.add('hidden');
        });
    }
});
    </script>
</body>
</html>
