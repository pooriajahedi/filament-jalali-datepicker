<?php

namespace Pooriajahedi\JalaliDateRangePicker\Forms;

use Pooriajahedi\JalaliDatePicker\JalaliDatePicker;

class JalaliDatePickerFormField
{
    public static function make(string $name): JalaliDatePicker
    {
        return JalaliDatePicker::make($name);
    }
}