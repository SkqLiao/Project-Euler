<?php
$GLOBALS['isLogin'] = $this->user->hasLogin();

$GLOBALS['max_read_id'] = Typecho_Cookie::get('user_read_id');
function threadedComments($comments, $options) {
    if ($comments->coid > $GLOBALS['max_read_id']){
        $GLOBALS['max_read_id'] = $comments->coid;
    }
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    }
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
    ?>

    <!--自定义评论代码结构-->
    <div id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->_levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt('comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?>">


        <a class="pull-left thumb-sm avatar m-l-n-md">
            <?php echo Utils::avatarHtml($comments); ?>
        </a>

        <div class="time-machine m-l-lg panel box-shadow-wrap-normal">
            <div class="panel-heading pos-rlt b-b b-light">
                <span class="arrow left"></span>
                <?php $comments->author(); ?>
                <span class="text-muted m-l-sm pull-right" datetime="<?php $comments->date('c'); ?>"><?php echo Utils::formatDate($comments,$comments->created, $options->dateFormat); ?>
                </span>
            </div>
            <div class="panel-body">
                <?php  echo Content::postCommentContent(Content::timeMachineCommentContent($comments->content),$GLOBALS['isLogin'] ,"","","",true); ?>
            </div>
            <div class="panel-footer">
                <div class="say_footer">
<!--                评论，可能会写，但是没想好样式    <a href="" class="text-muted m-xs"><i class="iconfont icon-redo"></i></a>-->
                    <a data-coid="<?php echo $comments->coid; ?>" class="text-muted star_talk"><i class="glyphicon <?php
                        $stars = Typecho_Cookie::get('extend_say_stars');
                        if(empty($stars)){
                            $stars = array();
                        }else{
                            $stars = explode(',', $stars);
                        }

                        if(!in_array($comments->coid,$stars)){
                            echo 'glyphicon-heart-empty';
                        }else{
                            echo 'glyphicon-heart';
                        }
                        ?>"></i>&nbsp;<span class="star_count"><?php
                            $db = Typecho_Db::get();
                            $prefix = $db->getPrefix();
                            $coid = $comments->coid;
                            if (!array_key_exists('stars', $db->fetchRow($db->select()->from('table.comments')))){
                                echo "0";
                                $db->query('ALTER TABLE `' . $prefix . 'comments` ADD `stars` INT(10) DEFAULT 0;');
                            }else{
                                $row = $db->fetchRow($db->select('stars')->from('table.comments')->where('coid = ?',$coid));
                                echo $row['stars'];
                            }
                            ?></span></a>
                    <span class="text-muted">
                        <?php
                        $ua = new UA($comments->agent);
                        ?>
                        <span class="ua-icons"><i data-feather='<?php echo $ua->returnTimeUa()['icon'] ?>'></i></span>
                        <?php
                        echo "发自".$ua->returnTimeUa()['title'];
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <!-- 单条评论者信息及内容 -->
    </div><!--匹配`自定义评论的代码结构`下面的div标签-->
<?php } ?>

<div id="comments" class="timeMachine">
    <!--如果允许评论，会出现评论框和个人信息的填写-->
    <?php if($this->allow('comment')): ?>
        <!--判断是否登录，只有登陆者才有权利发表说说-->
        <?php if($this->user->hasLogin()): ?>
            <div id="<?php $this->respondId(); ?>" class="respond comment-respond no-borders border-radius-6">

                <div class="panel panel-default m-t-md pos-rlt m-b-lg no-borders border-radius-6">
                    <form id="comment_form" action="<?php $this->commentUrl() ?>" method="post" class="comment-form" role="form">
                        <textarea id="comment" class="border-radius-6-top textarea form-control no-border" name="text" rows="3" maxlength="65525" aria-required="true"><?php $this->remember('text'); ?></textarea>
                        <div class="secret_comment" id="secret_comment">
                            <label class="secret_comment_label control-label">私密</label>
                            <div class="secret_comment_check">
                                <label class="i-switch i-switch-sm bg-dark m-b-ss m-r">
                                    <input type="checkbox" id="secret_comment_checkbox">
                                    <i></i>
                                </label>
                            </div>
                        </div>
                        <!--提交按钮-->
                        <div class="panel-footer bg-light lter border-radius-6-bottom">
                            <button type="submit" name="submit" id="submit" class="submit btn btn-info pull-right btn-sm">
                                <span><?php _me("发表新鲜事") ?></span>
                                <span class="text-active"><?php _me("提交中") ?>...
            <i class="animate-spin fontello fontello-spinner hide" id="spin"></i>
          </span>
                            </button>
                            <ul class="nav nav-pills nav-sm">
                                <li><a id="image-insert" data-toggle="modal" data-target="#imageInsertModal"><i class="fontello fontello-picture text-muted"></i></a></li>
                                <li><a id="video-insert" data-toggle="modal" data-target="#videoInsertModal"><i class="fontello fontello-youtube-play text-muted"></i></a></li>
                                <li><a id="music-insert" data-toggle="modal" data-target="#musicInsertModal"><i class="fontello fontello-headphones text-muted"></i></a></li>
                            </ul>
                            <!--模态框-->
                            <?php
                            echo Content::returnCrossInsertModelHtml("imageInsertModal","imageInsertOk","插入图片","请在下方的输入框内输入要插入的远程图片地址","img");
                            echo Content::returnCrossInsertModelHtml("videoInsertModal","videoInsertOk","插入视频","请在下方的输入框内输入要插入的远程视频地址","video");
                            echo Content::returnCrossInsertModelHtml("musicInsertModal","musicInsertOk","插入音乐","请在下方的输入框内输入要插入的单曲地址或者远程音乐地址","music");
                            ?>

                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!--如果没有登录则什么操作按钮都不会显示-->
        <?php endif; ?>
    <?php else: ?>
        <h4><?php _me("此处评论已关闭") ?></h4>
    <?php endif; ?>
    <?php $this->comments()->to($comments);
    ?>
    <?php if ($comments->have()): ?>
        <div class="streamline b-l m-l-lg m-b padder-v">

            <h4 style="display: none" class="comments-title m-t-lg m-b">&nbsp;<?php $this->commentsNum(_mt('暂无评论'), _mt('1 条评论'), _mt(' %d 条评论')); ?></h4>
            <?php $comments->listComments();
            if ($GLOBALS['max_read_id']>Typecho_Cookie::get('latest_time_id')){//防止阅读ID错误，越界
                $GLOBALS['max_read_id'] = Typecho_Cookie::get('latest_time_id');
            }
            if ($GLOBALS['max_read_id'] > Typecho_Cookie::get('user_read_id')){//新的阅读ID大于之前的Id,再去修改这个值
                Typecho_Cookie::set('user_read_id', $GLOBALS['max_read_id']);
            }
            ?>
        </div>
        <nav class="text-center m-b-lg" role="navigation">
            <?php $comments->pageNav('<i class="fontello fontello-chevron-left"></i>', '<i class="fontello fontello-chevron-right"></i>'); ?>
        </nav>

    <?php else: ?>
        <!--一条说说都没有，则显示默认信息-->
        <div class="streamline b-l b-info m-l-lg m-b padder-v">
            <ol class="comment-list list-unstyled m-b-none">
                <div class="comment-body comment-parent comment-odd comment-by-author">

                    <a class="pull-left thumb-sm avatar m-l-n-md">
                        <img nogallery src="<?php $this->options->BlogPic(); ?>">
                    </a>

                    <div class="m-l-lg m-b-lg">
                        <div class="m-b-xs">
                            <a href="" class="h4"></a><a href="<?php $this->options->rootUrl(); ?>"><?php $this->user->screenName(); ?></a>
                            <span class="format_time text-muted m-l-sm pull-right"><?php echo date(_mt("Y 年 m 月 d 日 h 时 i 分 A"),time()+($this->options->timezone - idate("Z"))); ?></span>
                        </div>
                        <div class="m-b">
                            <div class="m-b"><p><?php _me("欢迎你来到「时光机」栏目。在这里你可以记录你的日常和心情。而且，首页的“闲言碎语”栏目会显示最新的三条动态!</br></br>这是默认的第一条说说，当你发布第一条说说，刷新页面后，该条动态会自动消失。") ?></p></div>
                        </div>
                    </div>
                </div>
            </ol>
        </div>

    <?php endif; ?>

</div>

<script>

    //更新未读提醒

    //点赞操作
    $('.star_talk').click(function () {
        var ele = $(this);
        $.get(LocalConst.BLOG_URL,{action:"star_talk", coid:$(this).data('coid')})
            .error(function(){
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("点赞失败，检查网络问题") ?>",
                    type:'warning'
                })
            }).success(function(data) {
            if (data === "1"){//成功点赞
                ele.children('i').attr("class","glyphicon glyphicon-heart");
                ele.children('.star_count').text(parseInt(ele.children('.star_count').text()) + 1);
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("点赞成功") ?>",
                    type:'success'
                });
            }else if (data === "2"){//重复点赞
                ele.children('i').css("color","red");
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("请勿重复点赞哦") ?>",
                    type:'info'
                });
            }else if (data === "-1"){//代码出错
                $.message({
                    title:LocalConst.OPERATION_NOTICE,
                    message:"<?php _me("点赞请求失败，请稍后重试") ?>",
                    type:'error'
                });
            }
        });
    });
</script>