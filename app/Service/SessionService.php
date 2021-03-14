<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

/**
 * SessionService : セッションを開始する
 *
 */
class SessionService
{
    use LoggerAwareTrait;

    const HASH_ALGO = 'sha256';

    /**
     * startSession                    : セッションを開始する
     *
     * @param  {Object} $token_service : TokenService のインスタンス
     *
     * @return {string}                : セッションに保存されたトークン
     *
     */
    public static function startSession($token_service) {
        // セッション開始
        @session_start();
        if (!isset($_SESSION['dc_token'])) {
            $_SESSION['dc_token'] = $token_service->genToken();
        }
        return $_SESSION['dc_token'];
    }
    /**
     * endSession          : セッションを終了する
     *
     * @return {bool} true
     *
     */
    public static function endSession() {
        // セッション変数をクリーニング
        $_SESSION = [];
        // セッション用Cookieの破棄
        setcookie(session_name(), '', 1);
        // セッションファイルの破棄
        session_destroy();

        return true;
    }
}
