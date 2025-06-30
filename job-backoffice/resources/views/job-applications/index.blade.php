<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">

            📁Job Applications{{ request()->input('archived')==true?'(Archived)':'' }}
            </h2>
            <div>
                
            @if (request()->input('archived')==true)
                <a href="{{ route('job-applications.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-gray-700 transition">
                    Active Applications
                </a> 
            @else
                <a href="{{ route('job-applications.index',['archived'=>true]) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
                    Archived  Applications
                </a>
            @endif
        
            </div>
            
        </div>
    </x-slot>

        {{-- Success Message --}}
        <x-toast-notification/>


              
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-indigo-500 to-blue-500 text-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Applicant Name</th>
                         <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Position (Job Vacancy)</th> 
                         @if (auth()->user()->role=='admin')
                            <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Company </th>
                         @endif
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobApplications as $jobApplication)
                        <tr class="border-b hover:bg-gray-50 transition">
                            
                            <td class="px-6 py-4 text-gray-800 font-medium">
{{--  @TODO => when We can show the applicant account
                                 @if (request()->input('archived')==true) --}}

                                    <span class="text-gray-800">{{ $jobApplication->user->name }}</span>

                                {{--   @else
                                    <a class="text-blue-500 hover:text-blue-700 underline"  href="{{ route('job-vacancies.show',$job->id) }}">{{ $job->title }}</a>
                                @endif 
                                --}}
                            </td>
                            
                              <td class="px-6 py-4 text-gray-800 font-medium">
                                @if ($jobApplication->jobVacancy->title)
                                      <a target="_blank" href="{{ route('job-vacancies.show',$jobApplication->jobVacancy->id)}}">{{$jobApplication->jobVacancy->title }}</a>
                                @else
                                     <span class="text-gray-500 italic">N/A</span>
                                @endif
                            </td>

                            @if (auth()->user()->role=='admin')
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                @if ($jobApplication->jobVacancy->company->name)
                                      <a target="_blank" href="{{ route('companies.show',$jobApplication->jobVacancy->company->id)}}">{{$jobApplication->jobVacancy->company->name }}</a>
                                @else
                                     <span class="text-gray-500 italic">N/A</span>
                                @endif
                            </td>
                            @endif
                        @php
                         $statusColor = match($jobApplication->status) {
                            'Pending' => 'bg-yellow-100 text-yellow-800',
                            'Accepted' => 'bg-green-100 text-green-800',
                            'Rejected' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800'
                             };
                        @endphp

                        
                            <td class="px-4 py-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ $jobApplication->status }}
                                </span>
                            </td>
                        
                            <td class="px-6 py-4 space-x-2">
                                @if (request()->input('archived')==true)

                                   <form method="POST" action="{{ route('job-applications.restore', $jobApplication->id) }}" class="inline-block">
                                    @csrf
                                    @method('put')
                                    <button type="submit" onclick="return confirm('Are you sure you want to restore this  Job application?')" class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                        🔄 Restore
                                    </button>

                                @else
                                <a href="{{ route('job-applications.show', $jobApplication->id) }}" class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                    🧐 Show
                                    </a>

                                    <a href="{{ route('job-applications.edit', $jobApplication->id) }}" class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-yellow-200 transition">
                                    ✍️ Edit
                                    </a>

                                     <form method="POST" action="{{ route('job-applications.destroy', $jobApplication->id) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to archive this category?')" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-red-200 transition">
                                        🗃️ Archive
                                    </button>
                                </form>

                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 py-6">No Applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 px-4">
                {{ $jobApplications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
