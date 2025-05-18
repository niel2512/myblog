<x-layout :title="$title">
<main class="pt-8 pb-16 lg:pt-8 lg:pb-16 bg-white dark:bg-gray-900 antialiased">
  <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
      <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="my-4 lg:mb-6 not-format">
              <address class="flex items-center mb-6 not-italic">
                  <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                      <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt={{ $post->author->name }}>
                      <div>
                        <a href="/posts?author={{ $post->author->username }}" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->author->name }}
                        </a>
                        <a href="/posts?category={{ $post->category->slug }}" class="block">
                          <span class="{{ $post->category->color }} text-gray-600 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            {{ $post->category->name }}
                          </span>
                        </a>
                          <p class="text-base text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                      </div>
                  </div>
              </address>
              <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $post['title'] }}</h1>
          </header>
      <p class="lead">{{$post['body']}}</p>
      <a href="/posts" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 no-underline hover:underline">&laquo; Back to all blog</a>
      </article>
  </div>
</main>
{{-- @foreach ($post as $p)
<aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
  <div class="px-4 mx-auto max-w-screen-xl">
      <h2 class="mb-8 text-2xl font-bold text-gray-500 dark:text-white"><span class="text-gray-800">Read Other Article by</span> {{ $post->author->name }}</h2>
      <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
          <article class="max-w-xs rounded-lg border bg-white border-gray-200 shadow-md">
              <a href="#">
                  <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png" class="mb-5 rounded-lg" alt="Image 1">
              </a>
              <div class="mb-2 text-sm font-bold items-center leading-tight text-gray-900 dark:text-white">
                  <a href="#">{{ $post['title']}}</a>
                  <a href="/categories/{{ $post->category->slug }}"><p class="text-sm mt-0.5 text-gray-400 dark:text-gray-400">{{ $post->category->name }}</p></a>
                </div>
              <p class="mb-4 text-gray-500 dark:text-gray-400">{{ $post->body }}</p>
              <a href="/posts/{{ $post['slug'] }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                  Read more &raquo;
              </a>
          </article>
      </div>
  </div>
</aside>
@endforeach --}}
</x-layout>