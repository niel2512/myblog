{{-- Memasukkan style css ke layout app hanya untuk update menggunakan push --}}
@push('style')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- tambahkan enctype untuk upload file --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6", enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        {{-- Upload profile picture --}}
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-white" for="avatar">Upload file</label>
            <input class="@error('avatar') border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 @enderror block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="avatar" aria-describedby="avatar" id="avatar" type="file" accept="image/png, image/jpg, image/jpeg"> {{-- nambahin validasi dari html yaitu accept--}}
            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="avatar">.jpg, .png, .jpeg</div>
            @error('avatar') 
                <p class="mt-2 text-xs text-red-600">
                    {{$message}}
                </p> 
            @enderror
        </div>
        <div>
            <img class="w-20 h-20 rounded-full" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/user-avatar.png') }}" alt="{{ $user->name }}" id="avatar-preview">
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
{{-- Memasukkan script js ke layout app hanya untuk update menggunakan push --}}
@push('script')
    {{-- Sintaks js untuk preview gambar sebelum di save --}}
    <script>
    const input = document.getElementById('avatar');
    const previewPhoto = () => {
    const file = input.files;
    if (file) {
      const fileReader = new FileReader();
      const preview = document.getElementById('avatar-preview');
      fileReader.onload = function(event) {
        preview.setAttribute('src', event.target.result);
      }
      fileReader.readAsDataURL(file[0]);
    }
  }
  input.addEventListener("change", previewPhoto);   
    </script>
    {{-- Script filepond --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>  
    <script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('#avatar'); //ambil input file diatas dengan nama avatar

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    </script>
@endpush