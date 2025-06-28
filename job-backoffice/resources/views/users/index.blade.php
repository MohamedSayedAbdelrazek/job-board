<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">

            Users{{ request()->input('archived')==true?'(Archived)':'' }}
            </h2>
            <div>
                
            @if (request()->input('archived')==true)
                <a href="{{ route('users.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-gray-700 transition">
                    Active Users
                </a> 
            @else
                <a href="{{ route('users.index',['archived'=>true]) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
                    Archived  Users
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
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Name</th>
                         <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Email</th> 
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-50 transition">
                            
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                    <span class="text-gray-800">{{ $user->name }}</span>
                            </td>
                            
                              <td class="px-6 py-4 text-gray-800 font-medium">
                               <span class="text-gray-800">{{ $user->email }}</span>
                            </td>


                            <td class="px-6 py-4 text-gray-800 font-medium">
                                <span class="text-gray-800">{{ $user->role }}</span>
                            </td>
                    
                        
                            <td class="px-6 py-4 space-x-2">
                                @if (request()->input('archived')==true)
                                   <form method="POST" action="{{ route('users.restore', $user->id) }}" class="inline-block">
                                    @csrf
                                    @method('put')
                                    <button type="submit" onclick="return confirm('Are you sure you want to restore this user?')" class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                        🔄 Restore
                                    </button>

                                @else
                                <!--If admin don't allow edit or delete-->
                                    @if ($user->role!='admin')
                                        <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-yellow-200 transition">
                                        ✍️ Edit
                                        </a>

                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to archive this user?')" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-red-200 transition">
                                            🗃️ Archive
                                        </button>
                                    @endif                    
                                    
                                    </form>

                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 py-6">No Users Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 px-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
