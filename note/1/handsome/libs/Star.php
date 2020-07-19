<?php
/**
 * Created by PhpStorm.
 * User: hewro
 * Date: 2018/6/27
 * Time: 17:15
 * Description: 点赞请求
 */
require_once("Utils.php");


if ($_SERVER["REQUEST_METHOD"] == "GET"){//请求赞的数目
    if (!empty($_GET['coid'])){
        $coid = $_GET['coid'];
        $db     = Typecho_Db::get();
        $prefix = $db->getPrefix();
        firstOperate($db,$prefix);

        $row = $db->fetchRow($db->select('stars')->from('table.comments')->where('coid = ?', $coid));

        echo $row['stars'];

    }

}else if ($_SERVER["REQUEST_METHOD"] == "POST"){//POST请求
    //获取请求参数
    if(!empty($_POST['type']) && !empty($_POST['coid'])){
        $coid = $_POST['coid'];
        $type = $_POST['type'];//type 分为add和minus
        $db     = Typecho_Db::get();
        $prefix = $db->getPrefix();
        firstOperate($db,$prefix);

        $row = $db->fetchRow($db->select('stars')->from('table.comments')->where('coid = ?', $coid));
        if ($type == 'add'){//点赞
            $cookieCoid = Typecho_Cookie::get('extend_comment_cookie_coid');//cookie记录是否已经点赞了
            if (empty($cookieStar) || $cookieCoid!==$coid){//没有点赞过

            }else {//已经点赞了，不能重复点赞
                $db->query($db->update('table.comments')->rows(array('stars' => (int) $row['stars'] + 1))->where('coid = ?', $coid));
            }
        }else if ($type == 'minus'){//取消赞，暂时不打算写取消赞，赞了还想取消，不存在的，哼😕

        }
    }
}


function firstOperate($db,$prefix){
    //首次启动点赞功能，第一个点赞会触发更新表的字段增加功能
    if (!array_key_exists('stars', $db->fetchRow($db->select()->from('table.comments')))) {//没有该字段，需要初始化字段
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `stars` INT(10) DEFAULT 0;');
    }
}