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
            ['GET', getEnv('ROOT_PATH'), 'Top::index'],
            ['POST', getEnv('ROOT_PATH') . 'sample', 'Sample::sample'],
        ];
    }
}
