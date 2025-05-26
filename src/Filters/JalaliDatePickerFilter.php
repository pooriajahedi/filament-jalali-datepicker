<?php
namespace Pooriajahedi\JalaliDatePicker\Filters;

use Pooriajahedi\JalaliDatePicker\Filters\JalaliDatePickerFilterFluent;

class JalaliDatePickerFilter
{
    public static function make(string $name): JalaliDatePickerFilterFluent
    {
        return new JalaliDatePickerFilterFluent($name);
    }
}
