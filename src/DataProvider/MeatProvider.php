<?php declare(strict_types = 1);

namespace App\DataProvider;

use App\Client\KebaberClient;
use App\DataTransfer\Meat;

class MeatProvider
{
    private $client;

    /**
     * @param KebaberClient $client
     */
    public function __construct(KebaberClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return Meat[]
     */
    public function provideMeat(): array
    {
        $responseData = $this->client->getMeat();

        $resultMeats = [];
        foreach ($responseData as $datum) {
            $meatDataTransfer = $this->mapDataToMeat($datum);

            $resultMeats[] = $meatDataTransfer;
        }

        return $resultMeats;
    }

    /**
     * @param array $data
     *
     * @return Meat
     */
    protected function mapDataToMeat(array $data): Meat
    {
        $meat = new Meat();
        $meat->setName($data['name']);
        $meat->setDescription($data['description']);

        return $meat;
    }
}
