<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Logout - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: {50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a'}, grey: {50:'#f9fafb',100:'#f3f4f6',200:'#e5e7eb',300:'#d1d5db',400:'#9ca3af',500:'#6b7280',600:'#4b5563',700:'#374151',800:'#1f2937',900:'#111827'} } } } };
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center text-[17px]">
    <div class="w-full max-w-lg px-4">
        <div class="bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-6">
                <i class="fas fa-sign-out-alt text-4xl text-yellow-500 mb-3"></i>
                <h1 class="text-2xl font-bold text-grey-800">Confirm Logout</h1>
                <p class="text-grey-500">Are you sure you want to logout from the admin panel?</p>
            </div>
            <div class="flex justify-center gap-3">
                <a href="<?= $logoutUrl ?>" class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"><i class="fas fa-check mr-2"></i>Yes, Logout</a>
                <a href="<?= $dashboardUrl ?>" class="px-5 py-2 rounded-lg bg-grey-600 text-white hover:bg-grey-700"><i class="fas fa-times mr-2"></i>Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>