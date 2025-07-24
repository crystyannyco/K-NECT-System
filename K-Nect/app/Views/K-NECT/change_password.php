<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Change Password Required</h2>
            <p class="text-gray-600 mt-2">Welcome, <span class="font-semibold text-blue-600"><?= esc($username) ?></span>!</p>
            <p class="text-sm text-gray-500 mt-1">
                <?php if ($user_type === 'sk'): ?>
                    As an SK Official, you must change your password before accessing the dashboard.
                <?php else: ?>
                    As a Pederasyon Officer, you must change your password before accessing the dashboard.
                <?php endif; ?>
            </p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form id="changePasswordForm" action="<?= base_url('change-password-process') ?>" method="post" class="space-y-4">
            <div>
                <label for="new_password" class="block text-gray-700 font-medium">New Password</label>
                <input type="password" id="new_password" name="new_password" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required minlength="6" placeholder="Enter your new password">
                <p class="text-xs text-gray-500 mt-1">Password must be at least 6 characters long.</p>
            </div>
            
            <div>
                <label for="confirm_password" class="block text-gray-700 font-medium">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required minlength="6" placeholder="Confirm your new password">
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                Change Password & Continue
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="<?= base_url('login') ?>" class="text-sm text-gray-500 hover:text-gray-700">
                Back to Login
            </a>
        </div>
    </div>

    <!-- Loading Modal -->
    <div id="loadingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto mb-4"></div>
            <p>Changing password...</p>
        </div>
    </div>

    <!-- Message Modal -->
    <div id="messageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
            <h3 id="messageTitle" class="text-xl font-bold mb-2"></h3>
            <p id="messageText" class="mb-4"></p>
            <button id="closeMessageBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">OK</button>
        </div>
    </div>

    <script>
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        // Client-side validation
        if (newPassword !== confirmPassword) {
            showMessage('Error', 'Passwords do not match.');
            return;
        }
        
        if (newPassword.length < 6) {
            showMessage('Error', 'Password must be at least 6 characters long.');
            return;
        }
        
        // Show loading
        document.getElementById('loadingModal').classList.remove('hidden');
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingModal').classList.add('hidden');
            
            if (data.success) {
                showMessage('Success', data.message, () => {
                    window.location.href = data.redirect;
                });
            } else {
                showMessage('Error', data.message);
            }
        })
        .catch(error => {
            document.getElementById('loadingModal').classList.add('hidden');
            showMessage('Error', 'An error occurred. Please try again.');
            console.error('Error:', error);
        });
    });
    
    function showMessage(title, message, callback) {
        document.getElementById('messageTitle').textContent = title;
        document.getElementById('messageText').textContent = message;
        document.getElementById('messageModal').classList.remove('hidden');
        
        document.getElementById('closeMessageBtn').onclick = function() {
            document.getElementById('messageModal').classList.add('hidden');
            if (callback) callback();
        };
    }
    
    // Password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = this.value;
        
        if (confirmPassword && newPassword !== confirmPassword) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
    </script>
</body>
</html>
