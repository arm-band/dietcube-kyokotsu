<?php

namespace DietcubeKyokotsu\Service;

use Dietcube\Components\LoggerAwareTrait;

/**
 * SetArrayService : 画面出力(レンダリング)に使用するパラメータの配列を返却する
 *
 */
class SetArrayService
{
    use LoggerAwareTrait;

    /**
     * setFinishArray                   : 正常完了時の配列をセットする
     *
     * @param  {Object} $cryear_service : CRYearService のインスタンス
     *
     * @return {array}                  : 以下4つの値を持つ配列。 ページタイトル、説明文、コピーライト文字列の年数、トップへ戻るボタンのパス
     *
     */
    public function setFinishArray($cryear_service)
    {
        return [
            'pagetitle'   => '処理完了',
            'description' => 'Process Finished',
            'cryear'      => $cryear_service->year(),
            'rootpath'    => $_ENV['ROOT_PATH'],
        ];
    }
    /**
     * setFinishArray                   : 異常時の配列をセットする
     *
     * @param  {int}    $code           : HTTP ステータスコード
     * @param  {string} $phrase         : HTTP ステータスコード に対応するフレーズ
     * @param  {array}} $errors         : バリデーション結果のエラー文の配列
     * @param  {Object} $cryear_service : CRYearService のインスタンス
     *
     * @return {array}                  : 以下5つの値を持つ配列。 ページタイトル、説明文、バリデーション結果のエラー文の配列、コピーライト文字列の年数、トップへ戻るボタンのパス
     *
     */
    public function setErrorArray($code, $phrase, $errors, $cryear_service)
    {
        return [
            'pagetitle'   => $code,
            'description' => $phrase,
            'errors'      => $errors,
            'cryear'      => $cryear_service->year(),
            'rootpath'    => $_ENV['ROOT_PATH'],
        ];
    }
}
