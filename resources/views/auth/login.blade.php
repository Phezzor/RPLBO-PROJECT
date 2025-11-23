<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sidewalk.Go</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 50%, #D84315 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8 animate-fadeIn">
            <div class="inline-block bg-white rounded-full p-6 shadow-2xl mb-4">
                <svg class="w-20 h-20 text-[#FF6B35]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M2 21h19v-3H2v3zM20 8H4V6h16v2zm0 4H4v-2h16v2zm-7 4h7v-2h-7v2z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Sidewalk.Go</h1>
            <p class="text-white/90 text-lg">Coffee Management System</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 animate-fadeIn">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Masuk ke Dashboard</h2>
            
            <!-- Error Message -->
            <div id="errorMessage" class="hidden mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <p class="text-sm"></p>
            </div>
            
            <!-- Login Form -->
            <form id="loginForm" class="space-y-6">
                @csrf
                
                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text"
                               id="username"
                               name="username"
                               required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent"
                               placeholder="Masukkan username">
                    </div>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent"
                               placeholder="Masukkan password">
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               class="h-4 w-4 text-[#FF6B35] focus:ring-[#FF6B35] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    
                    <a href="#" class="text-sm font-medium text-[#FF6B35] hover:text-[#D84315]">
                        Lupa password?
                    </a>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        id="loginButton"
                        class="w-full bg-gradient-to-r from-[#FF6B35] to-[#FF8C42] text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    <span id="buttonText">Masuk</span>
                    <span id="buttonSpinner" class="hidden">
                        <svg class="animate-spin h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>
            
            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    © 2025 Sidewalk.Go. All rights reserved.
                </p>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            const errorMessage = document.getElementById('errorMessage');
            
            // Show loading state
            button.disabled = true;
            buttonText.classList.add('hidden');
            buttonSpinner.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            
            const formData = new FormData(this);
            const data = {
                username: formData.get('username'),
                password: formData.get('password')
            };

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    // Login successful
                    window.location.href = '/dashboard';
                } else {
                    // Show error
                    errorMessage.querySelector('p').textContent = result.message || 'Login gagal. Periksa kembali email dan password Anda.';
                    errorMessage.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Login error:', error);
                errorMessage.querySelector('p').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorMessage.classList.remove('hidden');
            } finally {
                // Reset button state
                button.disabled = false;
                buttonText.classList.remove('hidden');
                buttonSpinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>

