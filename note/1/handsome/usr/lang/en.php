<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * en.php
 * Author     : hewro
 * Date       : 2017/04/30
 * Version    :
 * Description:
 */
class Usr_Lang_en extends Lang_en {

    /**
     * @return array 返回包含翻译文本的数组
     */
    public function translated() {
        return array(
            //添加翻译的词汇,每两组之间，用英文逗号隔开
        );
    }

    public function dateFormat() {
        return "F j, Y";
    }

}
