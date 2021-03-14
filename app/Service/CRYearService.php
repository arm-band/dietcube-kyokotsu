<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

/**
 * CRYearService : コピーライトに年を出力する
 *
 */
class CRYearService
{
    use LoggerAwareTrait;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * year : コピーライトに年を出力する。 config の year を参照し、現在時刻の年より過去ならば「-」繋ぎで出力(例: 2020-2021)、そうでなければ年数をそのまま出力 (例: 2021)
     *
     * @return {string}
     *
     */
    public function year()
    {
        $nowyear = date('Y');
        if ((int)$nowyear > (int)$this->config['appconfig']['year']) {
            return $this->config['appconfig']['year'] . '-' . $nowyear;
        }

        return $nowyear;
    }
}
