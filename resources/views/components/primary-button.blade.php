<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-800 dark:bg-lime-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-lime-800 uppercase tracking-widest hover:bg-lime-700 dark:hover:bg-white focus:bg-lime-700 dark:focus:bg-white active:bg-lime-900 dark:active:bg-lime-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-lime-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
