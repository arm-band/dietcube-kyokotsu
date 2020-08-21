<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

class NozarashiService
{
    use LoggerAwareTrait;

    public function kusouzu($ua)
    {
        if(strstr($ua, 'Trident') || strstr($ua, 'MSIE')) {
            return false;
        }
        else {
            return true;
        }
    }
}
