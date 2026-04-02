<?php

namespace App\Helpers\Interfaces;

interface RequestInterface{
    public function getPost(string $key): ?string;
}