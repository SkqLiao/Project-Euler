<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * en.php
 * Author     : hran,hewro
 * Date       : 2017/04/30
 * Version    :
 * Description:
 */
class Lang_Settings_en extends Lang {

    /**
     * @return string 返回语言名称
     */
    public function name() {
        return "English";
    }

    /**
     * @return array 返回包含翻译文本的数组
     */
    public function translated() {
        return array(

        );
    }

    /**
     * @return string 返回日期的格式化字符串
     */
    public function dateFormat() {
        return "F j, Y";
    }
}
