button {{ $attributes->merge(['class' => 'px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:scale-105 active:scale-95 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all inline-flex items-center']) }}>
    {{ $slot }}
</button>
