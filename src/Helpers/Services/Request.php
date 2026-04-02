<?php

namespace App\Helpers\Services;

use App\Helpers\Interfaces\RequestInterface;

class Request implements RequestInterface{
    public function getPost(string $key): ?string{
        return $_POST[$key] ?? null;
    }
}