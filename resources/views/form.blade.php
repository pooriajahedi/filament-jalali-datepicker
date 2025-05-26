<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
         $config = $getFlatpickrConfig();
         $config['name'] = (string) $getStatePath();
         $config['getId'] = (string) $getId();
         $state = $getState();
         $value = is_array($state)
        ? implode(' to ', array_filter([$state['from'] ?? null, $state['to'] ?? null]))
        : $state;
    @endphp

    <div x-data="{}" x-init="window.initJalaliFlatpickr($refs.input, {{ json_encode($config) }})" class="relative">
        <input
                type="text"
                value="{{ $value }}"
                id="{{ $getId() }}"
                x-ref="input"
                wire:ignore
                class="block w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-400 ps-10"
                placeholder="بازه زمانی را انتخاب کنید"
        />
        <span class="absolute right-3 top-2.5 text-gray-400 pointer-events-none" style="left: 9px;top: 9px;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </span>
    </div>
</x-dynamic-component>