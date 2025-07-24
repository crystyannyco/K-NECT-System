<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 text-center mt-10">
        <h2 class="text-2xl font-bold mb-4">Welcome!</h2>
        <p class="mb-2">Your KK ID: <span class="font-mono text-blue-600"><?= esc($user_id) ?></span></p>
        <p>Your Username: <span class="font-mono text-green-600"><?= esc($username) ?></span></p>
        <form action="/logout" method="post" class="mt-6">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
        </form>
    </div>

</body>
</html>