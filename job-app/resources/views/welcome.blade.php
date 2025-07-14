<x-main-layout title="Shaghalni - Find your dream job">
    <!-- Tag: Shaghalni -->
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
        <div class="inline-flex items-center mb-8 x-cloak"
             x-show="show"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <x-application-logo class="w-20 h-auto fill-current text-gray-800" />
            
        </div>
    </div>

    <!-- Heading -->
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
        <div x-cloak x-show="show"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0">
            <h1 class="text-4xl sm:text-6xl md:text-8xl font-extrabold leading-tight tracking-tight text-white mb-6">
                Find your <br />
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 via-cyan-400 to-blue-500 font-serif italic drop-shadow-lg">
                    Dream Job
                </span>
            </h1>
        </div>
    </div>

    <!-- Subheading -->
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 700)">
        <div x-cloak x-show="show"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0">
            <p class="text-white/70 text-lg mb-8 max-w-xl">
                Connect with top employers, explore opportunities, and build your future.
            </p>
        </div>
    </div>

    <!-- Call to Action Buttons -->
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 900)">
            <div x-cloak x-show="show"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full max-w-md mx-auto">
                 
                <a href="{{ route('login') }}"
                   class="w-full sm:w-auto px-8 py-3.5 text-white font-semibold rounded-xl bg-gradient-to-r from-blue-500 to-teal-400 shadow-lg hover:from-blue-600 hover:to-teal-500 transition-all duration-300 transform hover:scale-105 hover:shadow-blue-500/30 text-center flex items-center justify-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                       <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                   </svg>
                   Login
                </a>

                <a href="{{ route('register') }}"
                   class="w-full sm:w-auto px-8 py-3.5 text-white font-semibold rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 shadow-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 hover:shadow-purple-500/30 text-center flex items-center justify-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                       <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                   </svg>
                   Create Account
                </a>
            </div>
        </div>

</x-main-layout>
