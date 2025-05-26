<?php

namespace Pooriajahedi\JalaliDatePicker\Columns;

use Filament\Tables\Columns\TextColumn;
use Morilog\Jalali\Jalalian;

class JalaliDatePickerColumn
{
    public static function make(string $name, string $format = 'Y/m/d H:i'): TextColumn
    {
        return TextColumn::make($name)
            ->label(__('تاریخ'))
            ->getStateUsing(function ($record) use ($name, $format) {
                $value = data_get($record, $name);
                return $value ? Jalalian::fromDateTime($value)->format($format) : '-';
            })
            ->html()
            ->sortable();
    }
}
