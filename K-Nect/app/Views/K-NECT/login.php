<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Security headers to prevent caching -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form id="loginForm" action="<?= base_url('loginProcess') ?>" method="post" class="space-y-4">
            <div>
                <label for="login" class="block text-gray-700">Email or Username</label>
                <input type="text" id="login" name="login" placeholder="Enter your email or username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">Login</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="popupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
            <h3 id="popupTitle" class="text-xl font-bold mb-2"></h3>
            <p id="popupMessage" class="mb-2"></p>
            <p id="popupReason" class="mb-4 text-red-500"></p>
            <div id="reuploadBtnContainer" class="mb-2 hidden">
                <button id="reuploadBtn" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Reupload</button>
            </div>
            <button id="closeModalBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Close</button>
        </div>
    </div>

    <script>
    let rejectedUserId = null;
    
    // Check for success parameters and show popup
    window.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const reuploadSuccess = urlParams.get('reupload_success');
        const registrationSuccess = urlParams.get('registration_success');
        
        if (reuploadSuccess === '1') {
            showSuccessPopup('Profile Updated Successfully!', 'Your profile has been successfully updated and resubmitted for review.', 5);
        } else if (registrationSuccess === '1') {
            showSuccessPopup('Registration Successful!', 'Your account has been successfully created and is pending approval.', 5);
        }
    });
    
    function showSuccessPopup(title, message, seconds) {
        // Clear profiling-related URL parameters to prevent back button access
        const newUrl = window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
        
        // Create success popup HTML
        const successPopup = document.createElement('div');
        successPopup.innerHTML = `
            <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                    <div class="text-green-500 text-4xl mb-2">✓</div>
                    <h3 class="text-xl font-bold mb-2 text-green-600">${title}</h3>
                    <p class="mb-4 text-gray-700">${message}</p>
                    <p class="text-sm text-gray-500">Auto-closing in <span id="countdown">${seconds}</span> seconds...</p>
                    <div class="mt-3">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div id="progressBar" class="bg-green-500 h-2 rounded-full transition-all duration-1000" style="width: 0%"></div>
                        </div>
                    </div>
                    <button onclick="closeSuccessPopup()" class="mt-3 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">OK</button>
                </div>
            </div>
        `;
        document.body.appendChild(successPopup);
        
        let countdown = seconds;
        const countdownElement = document.getElementById('countdown');
        const progressBar = document.getElementById('progressBar');
        
        window.closeSuccessPopup = function() {
            clearInterval(window.successTimer);
            document.getElementById('successModal').remove();
            // Clear browser history to prevent unauthorized access back to profiling
            window.history.replaceState(null, null, window.location.pathname);
        };
        
        window.successTimer = setInterval(() => {
            countdown--;
            if (countdownElement) countdownElement.textContent = countdown;
            if (progressBar) progressBar.style.width = `${((seconds - countdown) / seconds) * 100}%`;
            
            if (countdown <= 0) {
                clearInterval(window.successTimer);
                closeSuccessPopup();
            }
        }, 1000);
        
        // Prevent browser back button during success display
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, location.href);
        });
    }
    
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                let title = '';
                let message = data.message || 'Login failed.';
                let reason = '';
                rejectedUserId = null;
                if (data.type === 'pending') {
                    title = 'Account Pending Approval';
                    document.getElementById('reuploadBtnContainer').classList.add('hidden');
                } else if (data.type === 'rejected') {
                    title = 'Account Rejected';
                    reason = data.reason || '';
                    rejectedUserId = data.user_id || null;
                    document.getElementById('reuploadBtnContainer').classList.remove('hidden');
                } else {
                    title = 'Login Error';
                    document.getElementById('reuploadBtnContainer').classList.add('hidden');
                }
                document.getElementById('popupTitle').textContent = title;
                document.getElementById('popupMessage').textContent = message;
                document.getElementById('popupReason').textContent = (data.type === 'rejected') ? reason : '';
                document.getElementById('popupModal').classList.remove('hidden');
            }
        })
        .catch(async (err) => {
            let reason = '';
            document.getElementById('reuploadBtnContainer').classList.add('hidden');
            document.getElementById('popupTitle').textContent = 'Error';
            document.getElementById('popupMessage').textContent = 'An error occurred. Please try again.';
            document.getElementById('popupReason').textContent = reason;
            document.getElementById('popupModal').classList.remove('hidden');
        });
    });
    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('popupModal').classList.add('hidden');
    });
    document.getElementById('reuploadBtn').addEventListener('click', function() {
        if (rejectedUserId) {
            window.location.href = '/profiling/reupload/' + rejectedUserId;
        }
    });
    </script>
</body>
</html>