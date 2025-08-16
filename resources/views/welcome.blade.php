<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My.SPC Sign In</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md text-center">

        <!-- Logo -->
        <img src="/images/spc-logo.png" alt="SPC Logo" class="mx-auto mb-4 w-24 h-24">

        <!-- Title -->
        <h2 class="text-xl font-bold">
            <span class="text-green-700">My.SPC</span> <span class="text-black">» Sign In</span>
        </h2>

        <!-- Username -->
        <form action="#" method="POST" class="mt-6 text-left">
            <label class="block mb-2 text-sm font-medium">Username</label>
            <input type="text" name="username" placeholder="Username" 
                class="w-full border rounded-lg px-3 py-2 mb-4 shadow-sm focus:ring-2 focus:ring-green-600">

            <!-- Password -->
            <label class="block mb-2 text-sm font-medium">Password</label>
            <input type="password" name="password" placeholder="Password" 
                class="w-full border rounded-lg px-3 py-2 mb-6 shadow-sm focus:ring-2 focus:ring-green-600">

            <!-- Sign In Button -->
            <button type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="border-t my-6"></div>

        <!-- Links -->
        <p class="text-sm">
            No account yet? 
            <a href="#" class="text-blue-600 hover:underline">Sign Up here.</a>
        </p>
        <p class="text-sm mt-2">
            Forgot Password? Email 
            <a href="mailto:spcportal@spc.edu.ph" class="text-blue-600 hover:underline">spcportal@spc.edu.ph</a>
        </p>

    </div>
</div>

<!-- Footer -->
<footer class="mt-6 text-center text-sm">
    <a href="#" class="text-green-700 hover:underline">My.SPC</a> · 
    <a href="#" class="text-green-700 hover:underline">St. Peter’s College, Inc.</a>
</footer>

</body>
</html>
