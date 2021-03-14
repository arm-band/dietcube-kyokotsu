<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

/**
 * NozarashiService : IEは野晒しにすべし
 *
 */
class NozarashiService
{
    use LoggerAwareTrait;

    /**
     * kusouzu              : 九相図。IEは朽ち果てるのみ。
     *
     * @param  {string} $ua : ユーザーエージェント文字列
     *
     * @return {bool}       : IE以外ならば true, IEならば false
     *
     */
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
