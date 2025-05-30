<?php

namespace App\Models;

class Job
{
    //
    public static function all()
    {
        return [
            ['title' => 'software Engineer', 'salary' => '$2000'],
            ['title' => 'Graphic Designer', 'salary' => '$1000'],
        ];
    }
}
