<?php

namespace Pooriajahedi\JalaliDatePicker\Forms;

use Pooriajahedi\JalaliDatePicker\JalaliDatePicker;

class JalaliDatePickerFormField
{

    public static function make(string $name): JalaliDatePicker
    {
        return JalaliDatePicker::make($name);
    }
}