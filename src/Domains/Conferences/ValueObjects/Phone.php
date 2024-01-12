<?php

namespace Src\Domains\Conferences\ValueObjects;

class Phone
{
    public function __construct(private string $phone)
    {
    }

    public function raw(): string
    {
        return $this->phone;
    }

    public function clean(): string
    {
        return str($this->phone)
            ->replaceMatches('~\D~', '')
            ->replaceStart('8', '+7')
            ->value();
    }
}
