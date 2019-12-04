<?php

use App\Client\KebaberClient;
use App\Container\SimpleContainer;
use App\Container\SmartContainer;
use App\DataProvider\MeatProvider;
use App\VeryHardClass;

//$container = new SimpleContainer();
$container = new SmartContainer();
$container
    ->set('BASE_URL', 'http://kebab.er')
    ->set('PORT', 8000)
    ->set(
        VeryHardClass::class,
        function () {
            return new VeryHardClass();
        }
    )
    ->set(
        KebaberClient::class,
        function (SmartContainer $container) {
            return new KebaberClient(
                $container->get('BASE_URL'),
                $container->get('PORT')
            );
        }
    )
    ->set(
        MeatProvider::class,
        function (SmartContainer $container) {
            return new MeatProvider(
                $container->get(KebaberClient::class)
            );
        }
    )
;


return $container;
