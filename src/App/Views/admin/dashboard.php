<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Examination System</title>
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
                            900: '#1e3a8a',
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
                            900: '#111827',
                        }
                    }
                }
            }
        }
    </script>
    <script>
        // Defensive showTab: ensures tab buttons work even if a later script fails with a syntax error.
        // This will be overwritten by the full implementation later in the file if it loads successfully.
        if (typeof window.showTab !== 'function') {
            window.showTab = function(tabName) {
                try {
                    // Hide all tab contents
                    document.querySelectorAll('.tab-content').forEach(function(tab) {
                        tab.classList.add('hidden');
                        tab.classList.remove('active');
                    });

                    // Reset tab buttons
                    document.querySelectorAll('[id$="-tab"]').forEach(function(tab) {
                        tab.classList.remove('bg-white', 'text-primary-600', 'border-primary-600');
                        tab.classList.add('text-grey-600');
                    });

                    // Show selected content
                    var content = document.getElementById(tabName);
                    if (content) {
                        content.classList.remove('hidden');
                        content.classList.add('active');
                    }

                    // Activate the corresponding tab button
                    var activeTab = document.getElementById(tabName + '-tab');
                    if (activeTab) {
                        activeTab.classList.remove('text-grey-600');
                        activeTab.classList.add('bg-white', 'text-primary-600', 'border-primary-600');
                    }

                    try { localStorage.setItem('adminCurrentTab', tabName); } catch (e) {}
                } catch (e) {
                    // Fail silently to avoid breaking page load
                    console.error('showTab (defensive) error:', e);
                }
            };
        }
    </script>
</head>
<body class="bg-grey-50 text-[17px]">
    <!-- Sticky Header Section -->
    <div class="sticky top-0 z-40 backdrop-blur bg-gradient-to-r from-primary-600/95 to-primary-800/95 text-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-3xl font-bold leading-tight">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Admin Dashboard
                    </h1>
                    <p class="text-base opacity-90">Welcome Admin</p>
                </div>
                <div>
                    <button type="button" onclick="openLogoutModal()" class="bg-white/10 border border-white/30 text-white px-6 py-2 rounded-full hover:bg-white hover:text-primary-700 transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </div>
            </div>
            <!-- Aligned Sticky Navigation Tabs -->
            <div class="border-b border-white/20">
                <div class="flex space-x-1">
                    <button class="bg-white text-primary-700 font-semibold px-6 py-3 rounded-t-lg border-b-2 border-primary-600 hover:bg-grey-50 transition-all duration-300" id="users-tab" onclick="showTab('users')">
                        <i class="fas fa-users mr-2"></i>
                        Manage Users
                    </button>
                    <button class="text-white/90 font-semibold px-6 py-3 rounded-t-lg hover:bg-white/10 transition-all duration-300" id="subjects-tab" onclick="showTab('subjects')">
                        <i class="fas fa-book mr-2"></i>
                        Manage Subjects
                    </button>
                    <button class="text-white/90 font-semibold px-6 py-3 rounded-t-lg hover:bg-white/10 transition-all duration-300" id="assignments-tab" onclick="showTab('assignments')">
                        <i class="fas fa-link mr-2"></i>
                        Subject Assignments
                    </button>
                    <button class="text-white/90 font-semibold px-6 py-3 rounded-t-lg hover:bg-white/10 transition-all duration-300" id="reports-tab" onclick="showTab('reports')">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Reports
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4">
        <!-- Session Messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                </div>
                <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                </div>
                <button type="button" class="text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <!-- Tab Content -->
        <div class="bg-white rounded-lg p-8 shadow-lg -mt-4">
            <!-- Tab 1: Manage Users -->
            <div id="users" class="tab-content active">
                <?php include 'manage-users.php'; ?>
            </div>

            <!-- Tab 2: Manage Subjects -->
            <div id="subjects" class="tab-content hidden">
                <?php include 'manage-subjects.php'; ?>
            </div>

            <!-- Tab 3: Subject Assignments -->
            <div id="assignments" class="tab-content hidden">
                <?php include 'manage-assignments.php'; ?>
            </div>

            <!-- Tab 4: Reports -->
            <div id="reports" class="tab-content hidden">
                <div class="text-center py-12">
                    <i class="fas fa-chart-bar text-6xl text-grey-400 mb-4"></i>
                    <h4 class="text-xl font-semibold text-grey-700 mb-2">Reports & Analytics</h4>
                    <p class="text-grey-500">Reporting functionality coming soon...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 hidden z-50">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <div class="px-6 py-4 border-b border-grey-200">
                    <h3 class="text-lg font-semibold text-grey-800">Confirm Logout</h3>
                </div>
                <div class="p-6">
                    <p class="text-grey-700 mb-6">Are you sure you want to logout from the admin panel?</p>
                    <div class="flex justify-end space-x-3">
                        <button class="px-5 py-2 rounded-lg bg-grey-100 text-grey-700 hover:bg-grey-200" onclick="closeLogoutModal()">Cancel</button>
                        <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/admin/logout?confirm=true" class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab Switching
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('[id$="-tab"]').forEach(tab => {
                tab.classList.remove('bg-white', 'text-primary-600', 'border-primary-600');
                tab.classList.add('text-grey-600');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.remove('hidden');
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to selected tab
            const activeTab = document.getElementById(tabName + '-tab');
            activeTab.classList.remove('text-grey-600');
            activeTab.classList.add('bg-white', 'text-primary-600', 'border-primary-600');
            
            // Save current tab to localStorage
            localStorage.setItem('adminCurrentTab', tabName);
        }

        // Year-Section Tab Switching
        document.addEventListener('DOMContentLoaded', function() {
            const yearSectionTabs = document.querySelectorAll('.year-section-tab');
            const studentSections = document.querySelectorAll('.student-section');

            yearSectionTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetSection = this.getAttribute('data-section');
                    
                    // Update active tab
                    yearSectionTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show/hide sections
                    studentSections.forEach(section => {
                        if (section.id === targetSection) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                });
            });

            // Show first section by default
            if (yearSectionTabs.length > 0) {
                yearSectionTabs[0].click();
            }
            
            // Restore saved tab if available
            const savedTab = localStorage.getItem('adminCurrentTab');
            if (savedTab && document.getElementById(savedTab + '-tab')) {
                showTab(savedTab);
            }
        });

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
</body>
</html>