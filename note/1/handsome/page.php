<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('component/header.php'); ?>

	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

<!-- <div id="content" class="app-content"> -->
   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body <?php echo Content::returnPageAnimateClass($this); ?>">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col center-part">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
		<?php  echo Content::exportPostPageHeader($this,$this->user->hasLogin()); ?>
      <div class="wrapper-md" id="post-panel">
		<!--正文顶部的部件，如“返回首页”-->
       <?php echo Content::BreadcrumbNavigation($this, $this->options->rootUrl); ?>
       <!--博客文章样式 begin with .blog-post-->
       <div id="postpage" class="blog-post">
        <article class="single-post panel">
        <!--文章页面的头图-->
            <?php echo Content::exportHeaderImg($this); ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
          <div class="entry-content l-h-2x">
              <?php echo Content::postContent($this,$this->user->hasLogin()); ?>
          </div>
             <?php Content::pageFooter($this->options) ?>
         </div>
        </article>
       </div>
       <!--评论-->
        <?php $this->need('component/comments.php') ?>
      </div>
     </div>
     <!--文章右侧边栏开始-->
    <?php $this->need('component/sidebar.php'); ?>
     <!--文章右侧边栏结束-->
    </div>
       <script>
           try {
               $("[data-morphing]").fancyMorph({
                   hash : 'morphing'
               });
           }catch (e){

           }
           <?php if ((@in_array('autoReadMode',$this->options->featuresetup))): ?>
                $("#morphing").click();
           <?php endif; ?>
       </script>
   </main>
<?php echo Content::returnReadModeContent($this,$this->user->hasLogin()); ?>

    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->
