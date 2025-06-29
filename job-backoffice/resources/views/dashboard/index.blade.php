<x-app-layout>
    <x-toast-notification />

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            📊 {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6 bg-gray-50 min-h-screen flex flex-col gap-4">
        <!-- Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Active Users -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-semibold text-gray-700">👥 Active Users</h3>
                    <p class="text-6xl font-bold text-indigo-600">{{$analytics['activeUsers']}}</p>
                    <span class="text-sm text-gray-500">Last 30 days</span>
                </div>
            </div>

            <!-- Total Jobs -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-semibold text-gray-700">💼 Total Jobs</h3>
                    <p class="text-6xl font-bold text-green-600">{{$analytics['totalJobs']}}</p>
                    <span class="text-sm text-gray-500">All time</span>
                </div>
            </div>

            <!-- Total Applications -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-semibold text-gray-700">📬 Total Applications</h3>
                    <p class="text-6xl font-bold text-rose-600">{{$analytics['totalApplications']}}</p>
                    <span class="text-sm text-gray-500">All time</span>
                </div>
            </div>
        </div>

        <!-- Most Applied Jobs -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <h3 class="text-lg font-semibold text-gray-700">🔥 Most Applied Jobs</h3>

            <div>
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left">
                            <th class="py-2 uppercase text-gray-500">📌 Job Title</th>
                            <th class="py-2 uppercase text-gray-500">🏢 Company</th>
                            <th class="py-2 uppercase text-gray-500">📈 Total Applications</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($mostAppliedJobs as $job )
                            <tr class="text-left">
                                <td class="py-4">{{$job->title}}</td>
                                <td class="py-4">{{$job->company->name}}</td>
                                <td class="py-4">{{$job->totalCount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Conversion Rates -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <h3 class="text-lg font-semibold text-gray-700">📊 Conversion Rates</h3>

            <div>
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left">
                            <th class="py-2 uppercase text-gray-500">📌 Job Title</th>
                            <th class="py-2 uppercase text-gray-500">👁️ Views</th>
                            <th class="py-2 uppercase text-gray-500">📬 Applications</th>
                            <th class="py-2 uppercase text-gray-500">⚙️ Conversion Rate</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($conversionRates as $conversionRate )
                            <tr class="text-left">
                                <td class="py-4">{{ $conversionRate->title }}</td>
                                <td class="py-4">{{ $conversionRate->view_count }}</td>
                                <td class="py-4">{{ $conversionRate->totalCount }}</td>
                                <td class="py-4">{{ $conversionRate->conversionRate }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
