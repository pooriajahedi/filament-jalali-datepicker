<?php

namespace Pooriajahedi\JalaliDatePicker\Filters;

use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;
use Pooriajahedi\JalaliDatePicker\JalaliDatePicker;

class JalaliDatePickerFilterFluent
{
    protected string $name;
    protected ?string $label = null;
    protected array $config = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    public function config(array $config): static
    {
        $this->config = $config;
        return $this;
    }

    public function get(): Filter
    {
        $field = JalaliDatePicker::make($this->name)
            ->label($this->label ?? $this->name)
            ->config($this->config);

        return Filter::make($this->name)
            ->label($this->label ?? $this->name)
            ->form([$field])
            ->query(function ($query, array $data) {
                $value = data_get($data, $this->name);
                if (is_array($value)) {
                    if (!empty($value['from']) && !empty($value['to'])) {
                        return $query->whereBetween($this->name, [$value['from'], $value['to']]);
                    }
                    if (!empty($value['from'])) {
                        return $query->whereDate($this->name, '>=', $value['from']);
                    }
                    if (!empty($value['to'])) {
                        return $query->whereDate($this->name, '<=', $value['to']);
                    }
                    return $query;
                }

                if (!empty($value)) {
                    return $query->whereDate($this->name, $value);
                }

                return $query;
            })
            ->indicateUsing(function (array $data) {
                $value = data_get($data, $this->name);

                if (is_array($value)) {
                    if (!empty($value['from']) && !empty($value['to'])) {
                        return 'از ' . Jalalian::fromDateTime($value['from'])->format('Y/m/d') .
                            ' تا ' . Jalalian::fromDateTime($value['to'])->format('Y/m/d');
                    }

                    if (!empty($value['from'])) {
                        return 'از ' . Jalalian::fromDateTime($value['from'])->format('Y/m/d');
                    }

                    if (!empty($value['to'])) {
                        return 'تا ' . Jalalian::fromDateTime($value['to'])->format('Y/m/d');
                    }

                    return null;
                }

                if (!empty($value)) {
                    return 'در تاریخ ' . Jalalian::fromDateTime($value)->format('Y/m/d');
                }
            });
    }
}