@if (session('success'))
        <div 
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            x-transition
            class="max-w-2xl mx-auto mt-6 bg-indigo-600 border border-indigo-300 text-white px-4 py-3 rounded-md shadow"
        >
            ✅ {{ session('success') }}
        </div>
@endif