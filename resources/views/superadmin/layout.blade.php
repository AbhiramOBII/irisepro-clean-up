<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#FF8A3D',
                        'primary-dark': '#E67E35',
                        'primary-light': '#FFB380',
                        'secondary': '#FFF1E6',
                        'accent': '#FFC107',
                        'accent-dark': '#FFA000',
                        'success': '#4CAF50',
                        'info': '#2196F3',
                        'card-bg': '#FFFFFF',
                    },
                    fontFamily: {
                        'sans': ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-secondary min-h-screen font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-primary shadow-lg flex flex-col min-h-screen">
            <div class="p-6 border-b border-primary-dark border-opacity-30">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">Super Admin</h2>
                </div>
            </div>
            <nav class="mt-2 flex-1">
                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Main</p>
                    <a href="{{ route('superadmin.dashboard') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary-dark' : '' }}">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">User Management</p>
                    <a href="{{ route('students.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('students.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <span>Manage Students</span>
                    </a>
                    
                    <a href="{{ route('yashodarshis.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('yashodarshis.*') ? 'bg-primary-dark' : '' }}">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span>Manage Yashodarshis</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Content Management</p>
                    <a href="{{ route('superadmin.tasks.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.tasks.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span>Manage Tasks</span>
                    </a>
                    
                    <a href="{{ route('challenges.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('challenges.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <span>Manage Challenges</span>
                    </a>
                    
                    <a href="{{ route('batches.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('batches.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span>Manage Batches</span>
                    </a>
                    
                    <a href="{{ route('habits.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('habits.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span>Manage Habits</span>
                    </a>
                    
                    <a href="{{ route('achievements.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('achievements.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <span>Manage Achievements</span>
                    </a>
                    
                    <a href="{{ route('superadmin.enrollments.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.enrollments.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <span>Manage Enrollments</span>
                    </a>
                    
                    <a href="{{ route('superadmin.support-requests.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.support-requests.*') ? 'bg-primary-dark' : '' }}">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span>Support Requests</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">System</p>
                    <a href="{{ route('superadmin.settings') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.settings*') ? 'bg-primary-dark' : '' }}">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span>Settings</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Reports</p>
                    <a href="{{ route('superadmin.reports.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 mb-1 {{ request()->routeIs('superadmin.reports.*') ? 'bg-primary-dark' : '' }}">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span>Reports</span>
                    </a>
                </div>
                
                <div class="mt-auto px-6 py-4 border-t border-primary-dark border-opacity-30">
                    <a href="{{ route('superadmin.logout') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-red-600 rounded-lg transition duration-200">
                        <div class="p-1.5 bg-white bg-opacity-10 rounded mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>

        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="w-[90%] mx-auto px-4 sm:px-6 ">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Welcome, {{ Auth::guard('superadmin')->user()->superadmin_fullname }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 bg-secondary">
                <div class="w-[90%] mx-auto py-6 sm:px-6 lg:px-8">
                    <div class="px-4 py-6 sm:px-0">
                        @if(session('success'))
                            <div class="bg-success text-white px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-600 text-white px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor for task description
    if (document.querySelector('#task_description')) {
        ClassicEditor
            .create(document.querySelector('#task_description'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'link', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
            })
            .catch(error => {
                console.error('Error initializing CKEditor for task description:', error);
            });
    }

    // Initialize CKEditor for task instructions
    if (document.querySelector('#task_instructions')) {
        ClassicEditor
            .create(document.querySelector('#task_instructions'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'link', 'blockQuote', '|',
                    'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
            })
            .catch(error => {
                console.error('Error initializing CKEditor for task instructions:', error);
            });
    }

    // Initialize CKEditor for challenge description
    if (document.querySelector('#description')) {
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'link', 'blockQuote', '|',
                        'undo', 'redo'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => {
                console.error('Error initializing CKEditor for challenge description:', error);
            });
    }

    // Initialize CKEditor for challenge features
    if (document.querySelector('#features')) {
        ClassicEditor
            .create(document.querySelector('#features'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'link', 'blockQuote', '|',
                        'undo', 'redo'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => {
                console.error('Error initializing CKEditor for challenge features:', error);
            });
    }

    // Existing totals calculation script
    const inputs = document.querySelectorAll('input[type="number"][data-category]');
    
    function updateTotals() {
        const categories = ['aptitude', 'attitude', 'communication', 'execution'];
        let grandTotal = 0;
        
        categories.forEach(category => {
            const categoryInputs = document.querySelectorAll(`input[data-category="${category}"]`);
            let categoryTotal = 0;
            
            categoryInputs.forEach(input => {
                categoryTotal += parseInt(input.value) || 0;
            });
            
            const categoryTotalElement = document.querySelector(`.category-total[data-category="${category}"]`);
            if (categoryTotalElement) {
                categoryTotalElement.textContent = categoryTotal;
            }
            
            grandTotal += categoryTotal;
        });
        
        const grandTotalElement = document.getElementById('grand-total');
        if (grandTotalElement) {
            grandTotalElement.textContent = grandTotal;
        }
    }
    
    inputs.forEach(input => {
        input.addEventListener('input', updateTotals);
    });
    
    // Initial calculation
    updateTotals();
});
</script>
</html>
