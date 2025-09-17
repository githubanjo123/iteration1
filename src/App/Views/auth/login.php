<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Examination System</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: {
							50: '#eff6ff',
							100: '#dbeafe',
							200: '#bfdbfe',
							300: '#93c5fd',
							400: '#60a5fa',
							500: '#3b82f6',
							600: '#2563eb',
							700: '#1d4ed8',
							800: '#1e40af',
							900: '#1e3a8a'
						},
						grey: {
							50: '#f9fafb',
							100: '#f3f4f6',
							200: '#e5e7eb',
							300: '#d1d5db',
							400: '#9ca3af',
							500: '#6b7280',
							600: '#4b5563',
							700: '#374151',
							800: '#1f2937',
							900: '#111827'
						}
					},
					fontFamily: {
						sans: ["ui-sans-serif","system-ui","-apple-system","Segoe UI","Roboto","Ubuntu","Cantarell","Noto Sans","Helvetica Neue","Arial","sans-serif"]
					}
				}
			}
		}
	</script>
</head>
<body class="min-h-screen bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center text-[17px]">
	<div class="w-full max-w-md px-4">
		<div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-8">
			<div class="text-center mb-6">
				<h1 class="text-2xl font-bold text-grey-800">Examination System</h1>
				<p class="text-grey-500">Please sign in to continue</p>
			</div>

			<?php if (isset($error)): ?>
				<div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
					<i class="fas fa-exclamation-triangle mr-2"></i><?= htmlspecialchars($error) ?>
				</div>
			<?php endif; ?>

			<form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/api/auth/login" method="POST" class="space-y-4">
				<div>
					<label for="school_id" class="block text-sm font-medium text-grey-700 mb-1">School ID</label>
					<input type="text" id="school_id" name="school_id" required class="w-full px-4 py-2 border border-grey-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
				</div>
				<div>
					<label for="password" class="block text-sm font-medium text-grey-700 mb-1">Password</label>
					<div class="relative">
						<input type="password" id="password" name="password" required class="w-full pr-12 px-4 py-2 border border-grey-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
						<button type="button" aria-label="Toggle password visibility" class="absolute inset-y-0 right-0 px-3 flex items-center text-grey-500 hover:text-grey-700" onclick="togglePasswordVisibility()">
							<i id="passwordEye" class="fas fa-eye"></i>
						</button>
					</div>
				</div>
				<button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-lg shadow transition">Sign In</button>
			</form>
		</div>
	</div>

	<script>
		function togglePasswordVisibility() {
			var input = document.getElementById('password');
			var eye = document.getElementById('passwordEye');
			if (input.type === 'password') {
				input.type = 'text';
				eye.classList.remove('fa-eye');
				eye.classList.add('fa-eye-slash');
			} else {
				input.type = 'password';
				eye.classList.remove('fa-eye-slash');
				eye.classList.add('fa-eye');
			}
		}
	</script>
</body>
</html>