@props(['href', 'current' => false, 'ariaCurrent' => false])
@php
    if($current){
        $classes = 'bg-gray-900 text-white';
        $ariaCurrent = 'page';
    }else{
        $classes = 'text-gray-300 hover:bg-gray-700 hover:text-white';
    }
@endphp
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'rounded-md px-3 py-2 text-sm font-medium ' . $classes, 'aria-current' => $ariaCurrent])}}>
    {{ $slot }}
</a>