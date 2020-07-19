<?php
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('component/header.php');
?>
<style type="text/css">

</style>

	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

<!-- <div id="content" class="app-content"> -->
    <main class="app-content-body <?php Content::returnPageAnimateClass($this); ?>">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="bg-light lter wrapper-md">
            <h1 class="entry-title m-n font-thin text-black l-h"><span class="title-icons"><i data-feather="link"></i></span><?php _me
                ("友情链接")
                ?></h1>
            <?php if (trim($this->fields->intro) !== ""): ?>
            <div class="entry-meta text-muted  m-b-none small post-head-icon"><?php echo $this->fields->intro; ?></div>
            <?php endif ?>
        </div>
        <div class="wrapper-md">
            <div class="tab-container post_tab">
                <ul class="nav no-padder b-b">
                    <li class="nav-item active"><a class="nav-link" href data-toggle="tab" data-target="#my-info"><?php
                            _me("申请友链")
                            ?></a></li>
                    <li class="nav-item"><a class="nav-link" href data-toggle="tab" data-target="#tab_2"><?php _me("内页链接") ?></a></li>
                    <li class="nav-item"><a class="nav-link" href data-toggle="tab" data-target="#tab_3"><?php _me("推荐链接") ?></a></li>
                    <li class="nav-item"><a class="nav-link" href data-toggle="tab" data-target="#tab_4"><?php _me("全站链接") ?></a></li>
                </ul>
                <div class="tab-content">
                    <!-- list -->
                    <div id="my-info" class="tab-pane fade in active">
                        <div class="wrapper ng-binding">
                            <?php echo Content::postContent($this,$this->user->hasLogin()); ?>
                            <!--评论-->
                            <div class="bg-white wrapper border-radius-6">
                                <?php $this->need('component/comments.php') ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tab_2">
                        <div class="list-group list-group-lg list-group-sp">
                            <?php
                            $mypattern = <<<eof
  <a href="{url}" target="_blank" class="list-group-item no-borders box-shadow-wrap-lg"> <span class="pull-left 
  thumb-sm avatar m-r"> <img 
  src={image} alt="Error" /> <i class="{color} right"></i> </span> <span class="clear"> <span>{name}</span> <small class="text-muted clear text-ellipsis">{title}</small> </span> </a>
eof;
                            Handsome_Plugin::output($mypattern, 0, "one");
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tab_3">
                        <div class="list-group list-group-lg list-group-sp">
                            <?php
                            $mypattern = <<<eof
                            
  <a href="{url}" target="_blank" class="list-group-item no-borders box-shadow-wrap-lg"> <span class="pull-left thumb-sm avatar m-r"> <img 
  src={image} alt="Error" /> <i class="{color} right"></i> </span> <span class="clear"> <span class="text-muted">{name}</span> <small class="text-muted clear text-ellipsis">{title}</small> </span> </a>
eof;
                            Handsome_Plugin::output($mypattern, 0, "good");
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="tab_4">
                        <div class="list-group list-group-lg list-group-sp">
                            <?php
                            $mypattern = <<<eof
                            
  <a href="{url}" target="_blank" class="list-group-item no-borders box-shadow-wrap-lg"> <span class="pull-left 
  thumb-sm avatar m-r"> <img src={image} alt="Error" /> <i class="{color} right"></i> </span> <span class="clear"> <span
   class="text-muted">{name}</span> <small class="text-muted clear text-ellipsis">{title}</small> </span> </a>
eof;
                            Handsome_Plugin::output($mypattern, 0, "ten");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--首页右侧栏-->
        <?php $this->need('component/sidebar.php') ?>
    </div>
    <!-- /content -->
</main>
    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->

