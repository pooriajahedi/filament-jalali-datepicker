<?php

namespace Pooriajahedi\JalaliDatePicker\Columns;

use Filament\Tables\Columns\TextColumn;
use Morilog\Jalali\Jalalian;

class JalaliDatePickerColumn extends TextColumn
{
    public function getState(): string
    {
        $value = parent::getState();

        if (!$value) {
            return '-';
        }

        try {
            return Jalalian::fromDateTime($value)->format('Y/m/d');
        } catch (\Exception $e) {
            return $value;
        }
    }

    public static function make(string $name): static
    {
        return parent::make($name)->label('تاریخ شمسی')->alignRight()->sortable();
    }
}