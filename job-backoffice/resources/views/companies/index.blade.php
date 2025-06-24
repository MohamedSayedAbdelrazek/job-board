<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">

            📁Companies{{ request()->input('archived')==true?'(Archived)':'' }}
            </h2>
            <div>
                
            @if (request()->input('archived')==true)
                <a href="{{ route('companies.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-gray-700 transition">
                    Active Companies
                </a> 
            @else
                <a href="{{ route('companies.index',['archived'=>true]) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
                    Archived Companies
                </a>
            @endif
            
           
            
            <a href="{{ route('companies.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
                ➕ Add New Company
            </a>

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
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Company Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Address</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Indusry</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Website</th>
                         <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Owner</th> 
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $company)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-800 font-medium"><a class="text-blue-500 hover:text-blue-700 underline"  href="{{ route('companies.show',$company->id) }}">{{ $company->name }}</a></td>
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $company->address }}</td>
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $company->industry }}</td>
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                @if ($company->website )
                                      <a target="_blank" href="{{ $company->website }}">{{ $company->website }}</a>
                                @else
                                     <span class="text-gray-500 italic">N/A</span>
                                @endif
                              
                            </td>
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $company->owner->name }}</td>
                            <td class="px-6 py-4 space-x-2">
                                @if (request()->input('archived')==true)

                                   <form method="POST" action="{{ route('companies.restore', $company->id) }}" class="inline-block">
                                    @csrf
                                    @method('put')
                                    <button type="submit" onclick="return confirm('Are you sure you want to restore this category?')" class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                        🔄 Restore
                                    </button>

                                @else
                                <a href="{{ route('companies.show', $company->id) }}" class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                    🧐 Show
                                    </a>

                                    <a href="{{ route('companies.edit', $company->id) }}" class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-yellow-200 transition">
                                    ✍️ Edit
                                    </a>

                                     <form method="POST" action="{{ route('companies.destroy', $company->id) }}" class="inline-block">
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
                            <td colspan="2" class="text-center text-gray-500 py-6">No Companies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 px-4">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</x-app-layout>