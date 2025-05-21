<!-- Create modal -->
        <div class="relative p-4 bg-gray-50 rounded-lg border">
            <!-- Modal header -->
            <div class="flex justify-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                <h3 class="text-2xl font-semibold text-gray-900">Edit Blog</h3>
            </div>
            <form action="/dashboard/{{ $post->slug }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        {{-- Menambah @error agar menampilkan pesan eror apabila filed blm diisi --}}
                        <input type="text" name="title" id="title" class="@error('title') border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type blog title" value="{{ old('title') ?? $post->title}}"> 
                        @error('title') 
                        <p class="mt-2 text-xs text-red-600">
                            {{$message}}
                        </p> 
                        @enderror
                    </div>
                    <div>
                     <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                     <select name="category_id" id="category" class="@error('category_id') border-red-500 text-red-700 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                      <option selected="" value="">Select category</option>
                      @foreach (App\Models\Category::get() as $category)
                      <option value="{{$category->id}}" @selected((old('category_id') ?? $post->category->id)==$category->id)>{{$category->name}}</option> {{-- @selected untuk menjaga inputan agar tidak reset lagi kalau ada eror --}}
                      @endforeach
                     </select>
                     @error('category_id') 
                        <p class="mt-2 text-xs text-red-600">
                            {{$message}}
                        </p> 
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="body" id="body" rows="4" class="@error('body') bg-red-100 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Write description blog here">{{ old('body') ?? $post->body }}</textarea>
                        @error('body') 
                        <p class="mt-2 text-xs text-red-600">
                            {{$message}}
                        </p> 
                        @enderror                
                    </div>
                </div>
                <div class="flex gap-2">
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update blog
                </button>
                <a href="/dashboard" class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Back
                </a>
               </div>
            </form>
        </div>