<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

class CRYearService
{
    use LoggerAwareTrait;

    protected $filepath;

    public function __construct()
    {
        $this->filepath = __DIR__ . '/../config/config.php';
    }

    public function year()
    {
        if(file_exists($this->filepath)) {
            $config = include($this->filepath);
        }
        else {
            throw new \Dietcube\Exception\HttpNotFoundException();
        }
        $nowyear = date('Y');
        if ((int)$nowyear > (int)$config['appconfig']['year']) {
            return $config['appconfig']['year'] . '-' . $nowyear;
        }

        return $nowyear;
    }
}
