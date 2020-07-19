<?php if (COMMENT_SYSTEM == 0) : ?>

    <?php if (strlen($this->options->commentBackground) > 0): ?>
        <style>
            textarea#comment{
                background-image: url('<?php echo $this->options->commentBackground; ?>');
                background-color: #ffffff;
                transition: all 0.25s ease-in-out 0s;
            }
            textarea#comment:focus {
                background-position-y: 105px;
                transition: all 0.25s ease-in-out 0s;
            }
        </style>
    <?php endif; ?>

    <?php
    $GLOBALS['isLogin'] = $this->user->hasLogin();
    $GLOBALS['rememberEmail'] = $this->remember('mail',true);


    function threadedComments($comments, $options) {
        $commentClass = '';
        $Identity = '';
        if ($comments->authorId) {
            if ($comments->authorId == $comments->ownerId) {
                $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
                $Identity = '<label class="label bg-dark m-l-xs">'._mt("作者").'</label>';
            } else {
                $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
                //$Identity = '<label class="label bg-dark m-l-xs">'._mt("用户").'</label>';
            }
        }else{
            $Identity = '';
        }
        $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级

        $depth = $comments->levels +1; //添加的一句
        if ($comments->url) {
            $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
        } else {
            $author = $comments->author;
        }

        ?>

        <!--自定义评论代码结构-->

        <li id="<?php $comments->theId(); ?>" class="comment-body<?php
        if ($depth > 1 && $depth < 3) {
            echo ' comment-child ';
            $comments->levelsAlt('comment-level-odd', ' comment-level-even');
        } else if ($depth > 2){
            echo ' comment-child2';
            $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
        } else {
            echo ' comment-parent';
        }
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
            <div id="div-<?php $comments->theId(); ?>" class="comment-body">

                <a class="pull-left thumb-sm" rel="nofollow">
                    <?php echo Utils::avatarHtml($comments); ?>
                </a>
                <div class="m-b m-l-xxl">
                    <div class="comment-meta">
            <span class="comment-author vcard">
              <b class="fn"><?php echo $author; ?></b><?php echo $Identity; ?>
              </span>
                        <div class="comment-metadata">
                            <time class="format_time text-muted text-xs block m-t-xs" pubdate="pubdate" datetime="<?php $comments->date('c'); ?>"><?php echo Utils::formatDate($comments,$comments->created, $options->dateFormat); ?></time>
                        </div>
                    </div>
                    <!--回复内容-->
                    <div class="comment-content m-t-sm">
                        <span class="comment-author-at"><b><?php $parentMail = get_comment_at($comments->coid)?></b></span><span class="comment-content-true">
                            <?php
                                echo Content::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail);
                            ?>
                        </span>
                    </div>
                    <!--回复按钮-->
                    <div class="comment-reply m-t-sm">
                        <?php $comments->reply(_mt('回复')); ?>
                    </div>
                </div>

            </div>
            <!-- 单条评论者信息及内容 -->
            <?php if ($comments->children) { ?> <!-- 是否嵌套评论判断开始 -->
                <div class="comment-children list-unstyled m-l-xxl">
                    <?php $comments->threadedComments($options); ?> <!-- 嵌套评论所有内容-->
                </div>
            <?php } ?> <!-- 是否嵌套评论判断结束 -->
        </li><!--匹配`自定义评论的代码结构`下面的li标签-->
    <?php } ?>

    <div id="comments">
        <?php $this->comments()->to($comments); ?>

        <?php if ($this->options->commentPosition == 'bottom' || $this->options->commentPosition ==  ""): ?>
            <!--评论列表-->
            <?php Content::returnCommentList($this,$comments) ?>
        <?php endif; ?>

        <!--如果允许评论，会出现评论框和个人信息的填写-->
        <?php if($this->allow('comment')): ?>
            <div id="<?php $this->respondId(); ?>" class="respond comment-respond no-borders">

                <h4 id="reply-title" class="comment-reply-title m-t-lg m-b"><?php _me("发表评论") ?>
                    <small><i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="<?php
                        $tip = $this->options->commentTips;
                        if (trim($tip) == ""){
                            $tip = _mt("使用cookie技术保留您的个人信息以便您下次快速评论，继续评论表示您已同意该条款");
                        }
                        echo $tip;
                        ?>"></i>
                    </small>
                    <small class="cancel-comment-reply">
                        <?php $comments->cancelReply(_mt('取消回复')); ?>
                    </small>
                </h4>
                <form id="comment_form" method="post" action="<?php $this->commentUrl() ?>"  class="comment-form" role="form">
                    <div class="comment-form-comment form-group">
                        <label class="padder-v-sm" for="comment"><?php _me("评论") ?>
                            <span class="required text-danger">*</span></label>
                        <textarea id="comment" class="textarea form-control OwO-textarea" name="text" rows="5" placeholder="<?php _me("说点什么吧……") ?>" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"><?php $this->remember('text'); ?></textarea>
                        <div class="OwO padder-v-sm"></div>
                        <div class="secret_comment" id="secret_comment" data-toggle="tooltip"
                        data-original-title="<?php _me("开启该功能，您的评论仅作者和评论双方可见") ?>">
                            <label class="secret_comment_label control-label"><?php _me("私密评论") ?></label>
                            <div class="secret_comment_check">
                                <label class="i-switch i-switch-sm bg-dark m-b-ss m-r">
                                    <input type="checkbox" id="secret_comment_checkbox">
                                    <i></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--判断是否登录-->
                    <?php if($this->user->hasLogin()): ?>
                        <p id="welcomeInfo"><?php _me("欢迎") ?>&nbsp;<a data-no-intant target="_blank" href="<?php
                            $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>&nbsp;<?php _me("归来") ?>！&nbsp;<a href="<?php $this->options->logoutUrl(); ?>" id="logoutIn" title="Logout"><?php _me("退出") ?>&raquo;</a></p>
                    <?php else : ?>
                    <?php if($this->remember('author',true) != "" && $this->remember('mail',true) != "") : ?>
                    <p><?php _me("欢迎") ?>&nbsp;<a class="show_hide_div" style="color: #333!important;" data-toggle="tooltip" title="点击修改信息"><?php $this->remember('author'); ?></a>&nbsp;<?php _me("归来") ?>！</p>
                    <div id="author_info" class="hide">
                        <?php else : ?>
                        <div id="author_info" class="row row-sm">
                            <?php endif; ?>
                            <div class="comment-form-author form-group col-sm-6 col-md-4">
                                <label for="author"><?php _me("名称") ?>
                                    <span class="required text-danger">*</span></label>
                                <div>
                                    <?php //echo $this->remember('mail',true); ?>
                                    <img class="author-avatar" src="<?php echo Utils::getAvator($this->remember('mail',true),65) ?>" nogallery/>
                                <input id="author" class="form-control" name="author" type="text" value="<?php $this->remember('author'); ?>" maxlength="245" placeholder="<?php _me("姓名或昵称") ?>">
                                </div>
                            </div>

                            <div class="comment-form-email form-group col-sm-6 col-md-4">
                                <label for="email"><?php _me("邮箱") ?>
                                    <span class="required text-danger">*</span>
                                </label>
                                <input type="text" name="mail" id="mail" class="form-control" placeholder="<?php _me("邮箱 (必填,将保密)") ?>" value="<?php $this->remember('mail'); ?>" />
                                <input type="hidden" name="receiveMail" id="receiveMail" value="yes" />
                            </div>

                            <div class="comment-form-url form-group col-sm-12 col-md-4">
                                <label for="url"><?php _me("地址") ?></label>
                                <input id="url" class="form-control" name="url" type="url" value="<?php $this->remember('url'); ?>" maxlength="200" placeholder="<?php _me("网站或博客") ?>"></div>
                        </div>
                        <?php endif; ?>
                        <!--提交按钮-->
                        <div class="form-group">
                            <button type="submit" name="submit" id="submit" class="submit btn-rounded box-shadow-wrap-lg btn-gd-primary padder-lg">
                                <span><?php _me("发表评论") ?></span>
                                <span class="text-active"><?php _me("提交中") ?>...</span>
                            </button>
                            <i class="animate-spin fontello fontello-spinner hide" id="spin"></i>
                            <input type="hidden" name="comment_post_ID" id="comment_post_ID">
                            <input type="hidden" name="comment_parent" id="comment_parent">
                        </div>
                </form>
            </div>
        <?php else: ?>
            <p class="commentClose panel"><?php _me("此处评论已关闭") ?></p>
        <?php endif; ?>

        <?php if ($this->options->commentPosition == 'top'): ?>
            <!--评论列表-->
            <?php Content::returnCommentList($this,$comments) ?>
        <?php endif; ?>
    </div>

<?php elseif (COMMENT_SYSTEM == 1): ?>
    <div id="comments_changyan">
        <div id="changyan_wait">
            <i class="animate-spin fontello fontello-spinner hide" id="spin_comment_changyan"></i>
        </div>
        <div id="SOHUCS" sid="<?php echo $this->cid;?>" >
        </div>
    </div>
<?php else : ?>

    <?php $this->need('usr/third_party_comments.php') ?>
<?php endif; ?>

