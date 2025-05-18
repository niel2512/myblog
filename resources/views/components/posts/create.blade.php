<!-- Create modal -->
        <div class="relative p-4 bg-gray-50 rounded-lg border">
            <!-- Modal header -->
            <div class="flex justify-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                <h3 class="text-2xl font-semibold text-gray-900">Add Blog</h3>
            </div>
            <!-- Modal body -->
            <form action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        <input type="text" name="title" id="title" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type blog title" required>
                    </div>
                    <div>
                     <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                     <select name="category_id" id="category" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                      <option selected="">Select category</option>
                      @foreach (App\Models\Category::get() as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                     </select>
                    </div>
                    <div class="sm:col-span-2">
                     <label for="body" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                     <textarea id="body" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Write description blog here">
                     </textarea>
                    </div>
                </div>
                <div class="flex gap-2">
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add new blog
                </button>
                <a href="/dashboard" class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Back
                </a>
               </div>
            </form>
        </div>