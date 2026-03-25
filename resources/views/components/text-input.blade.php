@props(['disabled' => false])

<input {{ $attributes->merge(['class' => 'block w-full rounded-xl border-2 border-gray-200 shadow-sm py-3 px-4 font-medium transition-all duration-300 bg-white hover:bg-gray-50 hover:border-blue-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 focus:outline-none hover:shadow-md focus:shadow-lg']) }} @disabled($disabled) />
