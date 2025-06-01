<x-layout :title="$title">
  <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
      {{ $posts->links() }}
      <div class="mb-4 mt-4 grid gap-8 lg:grid-cols-3 sm:grid-cols-1">
        @forelse ($posts as $post)
        <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
          <div class="flex justify-between items-center mb-5 text-gray-500">
            <a href="/posts?category={{ $post->category->slug }}">
              <span class="{{ $post->category->color }} text-gray-600 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                {{ $post->category->name }}
              </span>
            </a>
            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
          </div>
          <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="/posts/{{ $post['slug'] }}">{{ $post->title }}</a></h2>
          <div class="mb-5 font-light text-gray-500 dark:text-gray-400">{!! Str::limit($post->body,100) !!}</div>
          <div class="flex justify-between items-center">
            <a href="/posts?author={{ $post->author->username }}">
              <div class="flex items-center space-x-4">
                <img class="w-7 h-7 rounded-full" src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/user-avatar.png') }}" alt={{ $post->author->name }} />
                <span class="font-medium text-sm dark:text-white">
                  {{ $post->author->name }}
                </span>
              </div>
            </a>
            <a href="/posts/{{ $post['slug'] }}" class="inline-flex items-center font-medium text-sm text-primary-600 dark:text-primary-500 hover:underline">
              Read more
              <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
          </div>
        </article>
        {{-- menambah empty agar menampilkan isi jika tidak terdapat blog yang dicari --}}
        @empty
        {{-- kekurangan nya harus membuat 2 div karena masi didalam looping pada class ini lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 --}}

        {{-- ini div 1 --}}
        <div class="flex items-center justify-center m-auto p-auto border">
        </div>

        {{-- ini div 2 --}}
        <div class="flex items-center justify-center m-auto p-auto">
          <div class="w-full p-10 mx-auto text-center ">
            <img src="{{ asset('img/error-page.png') }}">
            <p class="font-semibold text-xl">Oops...Article Not Found!</p>
            <p class="font-light mb-2">Please click button bellow to return</p>
            <a href="/posts" class="block text-white">
              <div class="px-4 py-2 bg-blue-700 border border-transparent rounded-md inline-flex items-center hover:bg-blue-800 transition ease-in-out duration-150">
              Back to all blog
              </div>
            </a>
          </div>
        </div>
        @endforelse
        </div>  
        {{-- {{ $posts->links() }} --}}
  </div>

</x-layout>