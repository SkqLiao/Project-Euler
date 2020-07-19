<?php
/**
 * Created by PhpStorm.
 * User: hewro
 * Date: 2018/9/10
 * Time: 13:19
 * 一个全站密码的页面
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php
$options = Typecho_Widget::widget('Widget_Options');
?>
<?php

require_once("Settings.php");
require_once("I18n.php");
require_once("Handsome.php");
require_once("Lang.php");
require_once("Content.php");
require_once("Utils.php");
require_once("Config.php");

if (!defined('THEME_URL')){//主题目录的绝对地址
    define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/').'/');
}

switch ($options->publicCDNSelcet){
    case 0:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$BOOT_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 1:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$BAIDU_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 2:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$SINA_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 3:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$QINIU_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 4:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$JSDELIVR_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 5:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$CAT_CDN));
        @define('PUBLIC_CDN_PREFIX',"");
        break;
    case 6:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$LOCAL_CDN));
        @define('PUBLIC_CDN_PREFIX',THEME_URL."assets/libs/");
        break;
    default:
        @define('PUBLIC_CDN',serialize(Handsome_Config::$LOCAL_CDN));
        @define('PUBLIC_CDN_PREFIX',THEME_URL."assets/libs/");
        break;
}


if (strlen(trim($options->LocalResourceSrc)) > 0){//主题静态资源的绝对地址
    @define('STATIC_PATH',$options->LocalResourceSrc);
}else{
    @define('STATIC_PATH',THEME_URL.'assets/');
}

if (!defined("BLOG_URL")){
    define("BLOG_URL",$options->rootUrl);
}


?>


<html class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta charset="<?php $this->options->charset(); ?>">
    <!--IE 8浏览器的页面渲染方式-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <!--默认使用极速内核：针对国内浏览器产商-->
    <meta name="renderer" content="webkit">
    <!--针对移动端的界面优化-->
    <?php if($this->options->ChromeThemeColor): ?>
        <meta name="theme-color" content="<?php $this->options->ChromeThemeColor() ?>" />
        <!--chrome Android 地址栏颜色-->
    <?php endif; ?>
    <?php echo Content::exportDNSPrefetch(); ?>
    <title><?php Content::echoTitle($this,$this->options->title,$this->_currentPage); ?></title>
    <?php if($this->options->favicon != ""): ?>
        <link rel="icon" type="image/ico" href="<?php $this->options->favicon() ?>">
    <?php else: ?>
        <link rel="icon" type="image/ico" href="/favicon.ico">
    <?php endif; ?>
    <?php $this->header(Content::exportGeneratorRules($this)); ?>


    <!-- 第三方CDN加载CSS -->
    <?php $PUBLIC_CDN_ARRAY = unserialize(PUBLIC_CDN); ?>
    <link href="<?php echo PUBLIC_CDN_PREFIX.$PUBLIC_CDN_ARRAY['css']['bootstrap'] ?>" rel="stylesheet">


    <!-- 本地css静态资源 -->
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/function.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/handsome.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />



    <!--引入英文字体文件-->
    <?php if (!empty($this->options->featuresetup) && in_array('laodthefont', $this->options->featuresetup)): ?>
        <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/font.min.css?v=<?php echo Handsome::$version
            .Handsome_Config::$versionTag ?>" type="text/css" />
    <?php endif; ?>

    <style type="text/css">
        <?php echo Content::exportCss($this) ?>
    </style>

    <!--全站jquery-->
    <script src="<?php echo PUBLIC_CDN_PREFIX.$PUBLIC_CDN_ARRAY['js']['jquery'] ?>"></script>

    <!--网站统计代码-->
    <script type="text/javascript">
        <?php $this->options->analysis(); ?>
    </script>

</head>


<body>

<div class="app app-header-fixed ">


    <div class="modal-over bg-black">
        <div class="modal-center animated fadeInUp text-center" style="width:200px;margin:-200px 0 0 -100px;">
            <div class="thumb-lg">
                <img src="<?php
                if (trim(@$_GET['data']['img'] == "")){
                    $options->BlogPic();
                }else{
                    echo $_GET['data']['img'];
                }
                ?>" class="img-circle normal-shadow">
            </div>
            <h4 class="m-t m-b"><?php echo $_GET['data']['title']; ?></h4>
            <small class="text-muted letterspacing indexWords m-b-sm">
                <?php
                _me("请输入");
                if ($_GET['data']['type'] == "index"){
                    echo "首页";
                }else{
                    echo "分类「".$_GET['data']['title']."」";
                }
                _me("访问密码：");
                ?>
            </small>
            <div class="input-group m-t-md">
                <input type="password" class="form-control text-sm btn-rounded no-border open_new_world_password" placeholder="输入密码打开新世界">
                <span class="input-group-btn">
        <a class="btn btn-success btn-rounded no-border wrapper-sm padder-md open_new_world"><i class="glyphicon
        glyphicon-arrow-right"></i></a>
      </span>
            </div>
        </div>
    </div>


</div>


<script>

    window['LocalConst'] = {
        OPERATION_NOTICE: '<?php _me("操作通知") ?>',
        BLOG_URL: '<?php echo BLOG_URL; ?>',
        MD5: '<?php echo $_GET['data']['md5']?>',
        TYPE: '<?php echo $_GET['data']['type'] ?>',
        CATEGORY: '<?php echo $_GET['data']['category'] ?>'

    };

    $('.open_new_world').click(function () {
        var ele = $(this);
        $.get(LocalConst.BLOG_URL,{action:"open_world", password:$('.open_new_world_password').val(), md5:LocalConst
                .MD5,type: LocalConst.TYPE, category: LocalConst.CATEGORY})
            .error(function(){
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("提交失败，检查网络问题") ?>",
                    type:'warning'
                })
            }).success(function(data) {
            if (data === "1"){//密码正确
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("密码正确，马上进入新世界") ?>",
                    type:'success'
                });

                setTimeout(function (){
                    location.reload();
                },2000);


            }else if (data === "-1"){//密码错误
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("密码错误") ?>",
                    type:'error'
                });
            }else if (data === "-2"){//密码为空
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("请输入密码，密码不能为空") ?>",
                    type:'info'
                });
            }
        });
    });

    function sleep(d) {
        var t = Date.now();
        while (Date.now - t <= d) {}
    }
</script>
<script src="<?php echo STATIC_PATH ?>js/function.min.js?v=<?php echo Handsome::$version.Handsome_Config::$versionTag
?>"></script>

</body>
</html><!--html end-->
