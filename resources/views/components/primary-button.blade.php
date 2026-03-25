@props(['disabled' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold text-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300/50 transition-all duration-300 hover:-translate-y-0.5 rounded-xl w-full']) }}>
    {{ $slot }}
</button>
