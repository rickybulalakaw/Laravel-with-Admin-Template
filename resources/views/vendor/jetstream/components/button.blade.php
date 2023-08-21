<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-slate-300  hover:bg-slate-700  hover:bg-slate-500  hover:text-white dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-slate-200 dark:hover:text-slate-700   whitespace-nowrap']) }}>
    {{ $slot }}
</button>
