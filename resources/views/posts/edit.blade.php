<x-layout :title="$pageTitle">
    
       <form method="POST" action="{{ route('posts.update',$post->id) }}">
        @method('put')
        @csrf
        <input type="hidden" name="id" value="{{$post->id}}">
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <div class="sm:col-span-3">
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <div class="mt-2">
            <input value="{{ old('title',$post->title)}}"type="text" name="title" id="title" autocomplete="given-name" class=" {{ $errors->has('title')?'outline-red-500':'outline-gray-300'   }} block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
          @error('title')
             <div class="text-red-700 px-4 py-2 rounded">{{ $message }}</div>
          @enderror
        </div>

        <div class="sm:col-span-3">
          <label for="author" class="block text-sm/6 font-medium text-gray-900">Author</label>
          <div class="mt-2">
            <input value="{{ old('author',$post->author) }}" type="text" name="author" id="author" autocomplete="author" class="{{ $errors->has('author')?'outline-red-500':'outline-gray-300'   }} block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
           @error('author')
              <div class="text-red-700 px-4 py-2 rounded">{{ $message }}</div>
          @enderror
        </div>

        </div>

        <div class="col-span-full">
          <label for="body" class="block text-sm/6 font-medium text-gray-900">Content</label>
          <div class="mt-2">
            <textarea name="body" id="body" rows="3" class=" {{ $errors->has('body')? 'outline-red-500':'outline-gray-300'   }} block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{old('body',$post->body)}}</textarea>
          </div>
          @error('body')
              <div class="text-red-700 px-4 py-2 rounded">{{ $message }}</div>
          @enderror
          <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the atricle.</p>
        </div>

         <div class="flex gap-3">
              <div class="flex h-6 shrink-0 items-center">
                <div class="group grid size-4 grid-cols-1">
                  <input id="comments" aria-describedby="comments-description" name="published" type="checkbox" {{$post->published==null?"":"checked"}} class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                  <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                    <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
              <div class="text-sm/6">
                <label for="published" class="font-medium text-gray-900">published?</label>
                <p id="published" class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
              </div>
            </div>
      </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('posts.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
   
    <input type="submit" value="Save" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
  </div>
</form>

</x-layout>