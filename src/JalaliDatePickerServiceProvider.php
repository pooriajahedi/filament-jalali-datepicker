<?php

namespace Pooriajahedi\JalaliDatePicker;

use Filament\Support\Assets\Css;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Assets\Js;

class JalaliDatePickerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jalali-date-picker');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/pooriajahedi/jalali-date-picker'),
        ], 'jalali-datepicker-assets');

        FilamentAsset::register([
            Js::make('jalali-date-picker', asset('vendor/jalali-date-picker/assets/picker.js')),
            Css::make('jalali-date-picker-css', asset('vendor/jalali-date-picker/assets/picker.css')),
        ]);

        FilamentView::registerRenderHook(
            'scripts.end',
            fn () => '<script src="' . asset('vendor/jalali-date-picker/assets/picker.js') . '"></script>'
        );
    }
}