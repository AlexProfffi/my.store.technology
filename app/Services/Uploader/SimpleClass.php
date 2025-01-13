<?php

namespace App\Services\Uploader;

class SimpleClass
{
    // Оголошення властивості
    public string $var = 'Hello Nik!';

    // Оголошення методу
    public function display(): void {
        echo $this->var;
    }
}

$obj = new SimpleClass();

$obj->display();

