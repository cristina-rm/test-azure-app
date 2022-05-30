<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-md shadow-sm border border-transparent bg-primary text-base rounded-md text-white uppercase tracking-widest hover:bg-gray-700 active:bg-primary focus:outline-none focus:border-gray-900 focus:outline-none focus:ring-gray-100 disabled:opacity-25 transition ml-4']) }}>
    {{ $slot }}
</button>