<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (strtoupper(Handsome_Config::PHP_ERROR_DISPLAY) == 'ON'){
    ini_set("display_errors", "On");
    error_reporting(E_ALL | E_STRICT);
}else{
    error_reporting(E_ALL &~E_NOTICE &~E_DEPRECATED &~E_WARNING &~ E_STRICT);
    ini_set("display_errors", "Off");

}

if (strtoupper(Handsome_Config::HANDSOME_DEBUG_DISPLAY) == 'ON'){
    if (!defined('__TYPECHO_DEBUG__')){
        @define('__TYPECHO_DEBUG__', true);
    }
}else{
    @define('__TYPECHO_DEBUG__', null);
}
?>
<!DOCTYPE HTML>
<?php echo Content::exportHtmlTag($this->options->indexsetup)?> lang="<?php _me("zh-cmn-Hans") ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta charset="<?php $this->options->charset(); ?>">
    <!--IE 8浏览器的页面渲染方式-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <!--默认使用极速内核：针对国内浏览器产商-->
    <meta name="renderer" content="webkit">
    <!--chrome Android 地址栏颜色-->
    <?php if($this->options->ChromeThemeColor): ?>
    <meta name="theme-color" content="<?php $this->options->ChromeThemeColor() ?>" />
    <?php endif; ?>

    <?php echo Content::exportDNSPrefetch(); ?>

    <title><?php Content::echoTitle($this,$this->options->title,$this->_currentPage); ?></title>
    <?php if($this->options->favicon != ""): ?>
        <link rel="icon" type="image/ico" href="<?php $this->options->favicon() ?>">
    <?php else: ?>
        <link rel="icon" type="image/ico" href="/favicon.ico">
    <?php endif; ?>
    <?php $this->header(Content::exportGeneratorRules($this)); ?>

    <?php if (@in_array('mathJax',$this->options->featuresetup)): ?>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({messageStyle: "none",tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <?php endif; ?>
    <!-- 第三方CDN加载CSS -->
    <?php $PUBLIC_CDN_ARRAY = unserialize(PUBLIC_CDN); ?>
    <link href="<?php echo PUBLIC_CDN_PREFIX.$PUBLIC_CDN_ARRAY['css']['bootstrap'] ?>" rel="stylesheet">


    <!-- 本地css静态资源 -->
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/function.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/handsome.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />



    <!--主题组件css文件加载-->
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/features/jquery.fancybox.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />
    <?php if ($this->options->codeStyle!=""){
        $code = $this->options->codeStyle;
    }else{
        $code = "vs";
    }
    ?>
    <?php if ($this->options->themetype == 0 || $this->options->themetype == 2 || $this->options->themetype == 4 || $this->options->themetype == 7 || $this->options->themetype == 11): ?><link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/features/newblack.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/features/code/<?php echo $code ?>.min.css?v=<?php echo Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />
    <?php if(@in_array("opacityMode",$this->options->indexsetup)): ?>
        <link rel="stylesheet" href="<?php echo STATIC_PATH; ?>css/features/coolopacity.min.css?v=<?php echo
            Handsome::$version.Handsome_Config::$versionTag ?>" type="text/css" />

        <?php if (@in_array("opacityMode",$this->options->indexsetup)): ?>
        <style>
            .cool-transparent .app:before {
                background-color: <?php if($this->options->opcityColor == "") echo "rgba(0, 0, 0, 0.3)"; else
                    $this->options->opcityColor();
                    ?>!important;
                filter: blur(20px);
            }
        </style>
        <?php endif; ?>
    <?php endif; ?>

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
    <?php $this->options->analysis(); ?>

    <script src="<?php echo STATIC_PATH ?>js/features/fancyMorph.min.js"></script>


</head>

<body id="body" class="fix-padding">

