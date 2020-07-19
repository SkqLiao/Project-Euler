<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!DOCTYPE HTML>
<?php
    $options = Typecho_Widget::widget('Widget_Options');
?>
<?php

require_once("libs/Settings.php");
require_once("libs/I18n.php");
require_once("libs/Handsome.php");
require_once("libs/Lang.php");
require_once("libs/Content.php");
require_once("libs/Utils.php");
require_once("libs/Config.php");

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

if (!defined('THEME_URL')){//主题目录的绝对地址
    define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/').'/');
}

if (strlen(trim($options->LocalResourceSrc)) > 0){//主题静态资源的绝对地址
    @define('STATIC_PATH',$options->LocalResourceSrc);
}else{
    @define('STATIC_PATH',THEME_URL.'assets/');
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
    <script src="<?php echo $PUBLIC_CDN_ARRAY['js']['jquery'] ?>"></script>

    <!--网站统计代码-->
    <script type="text/javascript">
        <?php $this->options->analysis(); ?>
    </script>

</head>

<body>
<div class="app app-header-fixed ">


<div class="container w-xxl w-auto-xs">
  <div class="text-center m-b-lg">
    <h1 class="text-shadow text-white">404</h1>
  </div>
  <div class="list-group bg-info auto m-b-sm m-b-lg">
    <a href="<?php $this->options->rootUrl(); ?>" class="list-group-item">
      <i class="fontello fontello-chevron-right text-muted"></i>
      <i class="fontello fontello-fw fontello-home m-r-xs"></i>&nbsp;<?php _me("首页") ?>
    </a>
      <?php if (!@in_array('hideLogin',$this->options->featuresetup)): ?>
      <a href="<?php $this->options->rootUrl(); ?>/admin/login.php" class="list-group-item">
      <i class="fontello fontello-chevron-right text-muted"></i>
      <i class="fontello fontello-fw fontello-sign-in m-r-xs"></i>&nbsp;<?php _me("登录") ?>
    </a>
    <a href="<?php $this->options->rootUrl(); ?>/admin/register.php"  class="list-group-item">
      <i class="fontello fontello-chevron-right text-muted"></i>
      <i class="fontello fontello-fw fontello-unlock-alt m-r-xs"></i>&nbsp;<?php _me("注册") ?>
    </a>
      <?php endif; ?>
  </div>
  <div class="text-center">
    <p>
  <small class="text-muted letterspacing"><?php $this->options->Indexwords(); ?><br>&copy; <?php echo date("Y");?></small>
</p>
  </div>
</div>


</div>

</body>
