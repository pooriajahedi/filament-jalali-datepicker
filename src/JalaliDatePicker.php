<?php

namespace Pooriajahedi\JalaliDatePicker;

use Filament\Forms\Components\Field;
use Filament\Tables\Filters\BaseFilter;

class JalaliDatePicker extends Field
{

    protected string $view = 'jalali-date-picker::form';

    protected array $flatpickrConfig = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function ($component, $state) {
            $component->state($state);
        });

        $this->dehydrateStateUsing(fn($state) => $state);
    }

    public static function make(string $name): static
    {
        return parent::make($name);
    }

    public function config(array $config): static
    {
        $this->flatpickrConfig = $config;

        return $this;
    }

    public function getFlatpickrConfig(): array
    {
        return $this->flatpickrConfig;
    }
}