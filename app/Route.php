<?php

namespace DietcubeKyokotsu;

use Dietcube\RouteInterface;
use Pimple\Container;

class Route implements RouteInterface
{
    /**
     * {@inheritDoc}
     */
    public function definition(Container $container)
    {
        return [
            ['GET', $_ENV['ROOT_PATH'], 'Top::index'],
            ['POST', $_ENV['ROOT_PATH'] . 'sample', 'Sample::sample'],
            [['GET', 'POST'], $_ENV['ROOT_PATH'] . $_ENV['IE_PATH'], 'Top::errorie'],
        ];
    }
}
