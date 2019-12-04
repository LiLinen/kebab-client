<?php declare(strict_types = 1);

namespace App\Container;

use App\Client\KebaberClient;
use App\DataProvider\MeatProvider;

class StaticContainer
{
    public function getMeatProvider()
    {
        return new MeatProvider(
            $this->getKebaberClient()
        );
    }

    public function getKebaberClient(): KebaberClient
    {
        return new KebaberClient(
            $this->getBaseUrl(),
            $this->getPort()
        );
    }

    public function getBaseUrl(): string
    {
        return 'http://kebab.er';
    }

    public function getPort(): int
    {
        return 8000;
    }
}
