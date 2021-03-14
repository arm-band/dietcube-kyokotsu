<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Exception\DCException;
use Dietcube\Components\LoggerAwareTrait;

/**
 * TokenService : ワンタイムトークンを発行する
 *
 */
class TokenService
{
    use LoggerAwareTrait;

    const HASH_ALGO = 'sha256';

    /**
     * genToken         : トークン生成
     *
     * @return {string} : トークン
     *
     */
    public static function genToken() {
        if (session_status() === PHP_SESSION_NONE) {
            throw new DCException('Error: Session isn\'t active.');
        }
        return hash(self::HASH_ALGO, session_id());
    }
}
