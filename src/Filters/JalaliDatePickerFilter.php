<?php

namespace Pooriajahedi\JalaliDatePicker\Filters;

use Filament\Tables\Filters\Filter;
use Pooriajahedi\JalaliDatePicker\JalaliDatePicker;

class JalaliDatePickerFilter
{
    public static function make(string $name): Filter
    {
        $field = JalaliDatePicker::make($name);

        $filter = Filter::make($name)
            ->form([$field])
            ->query(function ($query, array $data) use ($name) {
                $value = data_get($data, $name);
                if (is_array($value)) {
                    if (!empty($value['from']) && !empty($value['to'])) {
                        return $query->whereBetween($name, [$value['from'], $value['to']]);
                    }
                    if (!empty($value['from'])) {
                        return $query->whereDate($name, '>=', $value['from']);
                    }
                    if (!empty($value['to'])) {
                        return $query->whereDate($name, '<=', $value['to']);
                    }
                    return $query;
                }
                if (!empty($value)) {
                    return $query->whereDate($name, $value);
                }
                return $query;
            })
            ->indicateUsing(function (array $data) use ($name) {
                $value = data_get($data, $name);
                if (is_array($value)) {
                    if (!empty($value['from']) && !empty($value['to'])) {
                        return 'از ' . $value['from'] . ' تا ' . $value['to'];
                    }
                    if (!empty($value['from'])) {
                        return 'از ' . $value['from'];
                    }
                    if (!empty($value['to'])) {
                        return 'تا ' . $value['to'];
                    }
                    return null;
                }
                if (!empty($value)) {
                    return 'در تاریخ ' . $value;
                }
                return null;
            });

        return $filter;
    }
}