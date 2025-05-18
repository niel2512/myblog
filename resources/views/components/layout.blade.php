<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="icon" href="{{ asset('img/favicon.png') }}">
 <title>{{ $title }}</title>
 @vite('resources/css/app.css')
 {{-- <link rel="icon" href="{{ asset('favicon.png') }}"/> --}}
 {{-- Link Tailwind css --}}
 <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
 {{-- Link Alpine.js --}}
 <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">
<div class="min-h-full">
  <x-navbar/>
  <x-header :title="$title"/> {{-- Passing Data to Components --}}
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
  {{ $slot }}
    </div>
  </main>
</div>
{{-- Menambah script js flowbite --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>