@if (session('success'))
        <div 
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            x-transition
            class="max-w-2xl mx-auto mt-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md shadow"
        >
            ✅ {{ session('success') }}
        </div>
@endif