<?php
/**
* 时光机
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('component/header.php');
function echoTimeMemoryItem($i,$month,$content){
    $color = array("b-light","b-info","b-dark","b-success","b-black","b-warning","b-primary","b-danger","");
    echo <<<EOF
<div class="sl-item {$color[($i -1) % 9 ]} b-l">
                                <div class="m-l">
                                    <div class="text-muted">{$month} 月前</div>
                                    <p>{$content}</p>
                                </div>
                            </div>
EOF;
}
?>


	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

  <!-- content -->
<!-- <div id="content" class="app-content"> -->
    <a class="off-screen-toggle hide"></a>
  	<main class="app-content-body <?php  Content::returnPageAnimateClass($this); ?>">
        <div class="hbox hbox-auto-xs hbox-auto-sm">
            <div class="col center-part">
                <div style="background:url(<?php $this->options->timepic(); ?>) center center; background-size:cover">
                    <div class="wrapper-lg bg-white-opacity">
                        <div class="row m-t">
                            <div class="col-sm-6">
                                <div class="clear m-b">
                                    <div class="m-b m-t-sm">
                                        <span class="h3 text-black"><?php $this->options->BlogName() ?></span>
                                        <small class="m-l"><?php $this->options->BlogJob() ?></small>
                                    </div>
                                    <p class="m-b">
                                        <?php
                                        $socialItemsOutput = '';
                                        $socialSingleItem = '';
                                        $json = '['.Utils::remove_last_comma(Typecho_Widget::widget('Widget_Options')->socialItems).']';
                                        $socialItems = json_decode($json);
                                        foreach ($socialItems as $socialItem){
                                            $itemName = $socialItem->name;
                                            @$itemStatus = $socialItem->status;
                                            @$itemLink = $socialItem->link;
                                            @$itemClass = $socialItem->class;
                                            if ($itemStatus == 'single'){
                                                $socialSingleItem .= '<a target="_blank" href="'.$itemLink.'" class="btn btn-sm btn-success btn-rounded">'.$itemName.'</a>';
                                            }else{
                                                $socialItemsOutput .= '<a target="_blank" title="'.$itemName.'" href="'.$itemLink.'" class="btn btn-sm btn-bg btn-rounded btn-default btn-icon"><i class="'.$itemClass.'"></i></a>';
                                            }
                                        }
                                        ?>
                                        <?php echo $socialItemsOutput; ?>
                                    </p>
                                    <?php echo $socialSingleItem; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
                                <div class="pull-right pull-none-xs text-center">
                                    <a class="m-b-md inline m">
                                        <span class="h3 block font-bold"><?php $stat->publishedCommentsNum() ?></span>
                                        <small><?php _me("评论") ?></small>
                                    </a>
                                    <a class="m-b-md inline m">
                                        <span class="h3 block font-bold"><?php $stat->publishedPostsNum() ?></span>
                                        <small><?php _me("文章") ?></small>
                                    </a>
                                    <a class="m-b-md inline m">
                                        <span class="h3 block font-bold"><?php $this->commentsNum(); ?></span>
                                        <small><?php _me("动态") ?></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper bg-white">
                    <ul class="nav nav-pills nav-sm" id="time-tabs">
                        <li class="active"><a href="#talk" role="tab" data-toggle="tab" aria-expanded="true"><?php _me("我的动态") ?></a></li>
                        <?php

                        $json = '['.Typecho_Widget::widget('Widget_Options')->rssItems.']';
                        $rssItems = json_decode($json);
                        $tabPanes = "";
                        foreach ($rssItems as $rssItem) {
                            $itemId = $rssItem->id;
                            $itemUrl = $rssItem->url;
                            $itemName = $rssItem->name;
                            @$itemType = $rssItem->type;
                            @$itemImg = $rssItem->img;
                            echo Content::returnTimeTab($itemId,$itemName,$itemUrl,$itemType,$itemImg);
                            $tabPanes .= Content::returnTimeTabPane($itemId);
                        }
                        ?>
                    </ul>
                </div>

                <div class="tab-content">
                    <div id="talk" class="padder tab-pane  fade in active">
                        <?php $this->need('component/say.php') ?>
                    </div><!--end of #pedder-->

                    <?php echo $tabPanes; ?>
                </div>
            </div><!--end of .center-part -->
            <div class="col w-lg bg-light lter bg-auto">
                <div class="wrapper">
                    <div class="padder-md">
                        <div class="m-b-xs text-md"><?php _me("联系方式") ?></div>
                        <ul class="list-group no-bg no-borders pull-in">
                            <?php
                            $contactItemsOutput = '';
                            $json = '['.Utils::remove_last_comma(Typecho_Widget::widget('Widget_Options')->contactItems).']';
                            $contactItems = json_decode($json);
                            foreach ($contactItems as $contactItem){
                                $itemName = $contactItem->name;
                                $itemImg = $contactItem->img;
                                $itemValue = $contactItem->value;
                                $itemLink = $contactItem->link;

                                $contactItemsOutput .= '<li class="list-group-item"><a target="_blank" href="'.$itemLink.'" class="pull-left thumb-sm avatar m-r"><img 
src="'.$itemImg.'" class="img-40px photo img-square normal-shadow"><i class="on b-white bottom"></i></a><div class="clear"><div><a target="_blank" href="'.$itemLink.'">'.$itemName.'</a></div><small class="text-muted">'.$itemValue.'</small></div></li>';
                            }
                            ?>
                            <?php echo $contactItemsOutput; ?>
                        </ul>
                    </div>

                    <div class="panel box-shadow-wrap-normal">
                        <h4 class="font-thin padder"><?php _me("关于我") ?></h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p><?php $this->options->about() ?></p>

                            </li>
                        </ul>
                    </div>

                    <?php if ($this->options->timeHistory == 1): ?>
                    <div class="padder-md">
                        <!-- streamline -->
                        <div class="m-b text-md">那年今日</div>
                        <div class="streamline b-l m-b">
                            <?php

                            function updateBigMemory($db,$options,$login){
                                $year = date("Y");
                                $month = date("m");
                                $day = date("d");

                                $tempYear = $year;
                                $tempMonth = $month;
                                $tempDay = $day;
                                $filePath = __DIR__.'/assets/cache/time.json';
                                $timeList = [];
                                for ($i = 1; $i <= 20; $i++) {
                                    $tempMonth = $tempMonth - 1;
                                    if ($tempMonth == 0) {
                                        $tempMonth = 12;
                                        $tempYear = $tempYear - 1;
                                    }

                                    $begin =  strtotime($tempYear . "-" . $tempMonth . "-" . $tempDay . " 00:00:00");
                                    $end =  strtotime($tempYear . "-" . $tempMonth . "-" . $tempDay . " 23:59:59");

                                    //查询数据
                                    $page = $db->fetchRow($db->select()->from('table.contents')
                                        ->where('table.contents.created < ?', $options->gmtTime)
                                        ->where('table.contents.slug = ?', "cross"));


                                    $comments = $db->fetchAll($db->select()->from('table.comments')
                                        ->where('table.comments.status = ?', 'approved')
                                        ->where('table.comments.created <= ?', $end)
                                        ->where('table.comments.created >= ?', $begin)
                                        ->where('table.comments.type = ?', 'comment')
                                        ->where('table.comments.cid = ?', $page['cid'])
                                        ->order('table.comments.created', Typecho_Db::SORT_DESC)
                                        ->limit(1));
                                            if (!empty($comments[0])){
                                                $content = Content::postCommentContent(Markdown::convert($comments[0]['text']),$login,"","","");
                                                $content = Content::returnExceptShortCodeContent(trim(strip_tags($content)));
                                                //写入文件
                                                $tempArray = [];
                                                $tempArray['content'] = $content;
                                                $tempArray['month'] = $i;
                                                array_push($timeList,$tempArray);
                                                //输出到页面
                                                echoTimeMemoryItem($i,$i,$content);
                                            }

                                    $data = fopen($filePath, "w");
                                    fwrite($data, json_encode(['time' => time(), 'data' => $timeList]));
                                    fclose($data);
                                }
                            }

                            //检测是否有缓存
                            $filePath = __DIR__.'/assets/cache/time.json';

                            $fp = fopen($filePath, 'r');
                            if ($fp && filesize($filePath) > 0) {

                                $contents = fread($fp, filesize($filePath));
                                fclose($fp);
                                $data = json_decode($contents);
                                $dataContent = $data->data;
                                if ($data!=null || (count($data->data) != 0)){
                                    $day = date("d",$data->time);
                                    $month = date("m",$data->time);
                                    $year = date("Y",$data->time);

                                    $currentDay = date("d");
                                    $currentMonth = date("m");
                                    $currentYear = date("Y");

                                    if ($day == $currentDay && $month == $currentMonth && $year == $currentYear){//日期匹配，调用缓存
                                        for ($i = 1; $i <= count($data->data);$i++){
                                            echoTimeMemoryItem($i,$data->data[$i-1]->month,$data->data[$i-1]->content);
                                        }

                                        if (count($data->data) == 0){
                                            echoTimeMemoryItem(2,"某",_mt("大家就当无事发生过"));
                                        }
                                    }else{
                                        updateBigMemory($this->db,$this->options,$this->user->hasLogin());
                                    }
                                }else{
                                    updateBigMemory($this->db,$this->options,$this->user->hasLogin());
                                }
                            }else{
                                updateBigMemory($this->db,$this->options,$this->user->hasLogin());
                            }
                            ?>
                        </div>
                        <!-- / streamline -->
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
	</main>

<script>
    var timeTemple = '<div class="m-l-n-md">\n' +
        '          <a class="pull-left thumb-sm avatar">\n' +
        '            <img src="{IMG_AVATAR}">\n' +
        '          </a>          \n' +
        '          <div class="time-machine m-l-xxl panel b-a">\n' +
        '            <div class="panel-heading pos-rlt">\n' +
        '              <span class="arrow left pull-up"></span>\n' +
        '              <span class="text-muted m-l-sm pull-right">\n' +
        '                {TIME}\n' +
        '              </span>\n' +
        '              {CONTENT}</div><div class="text-muted say_footer panel-footer">\n' +
        '                <a target="_blank" href="{LINK}" class="text-muted m-xs"><i class="iconfont icon-redo"></i>&nbsp;&nbsp;查看全文</a>\n' +
        '              </div>' +
        '          </div>' +
        '        </div>';

    $('#time-tabs').find('a').click(function (e) {
        var object = $(this);
        var rss = $(this).data("rss");
        var id = $(this).data("id");
        var flag = $(this).attr("data-status");
        var type = $(this).data("type");
        var img = $(this).data("img");
        // console.log(flag);
        // console.log(rss);
        if ('undefined' !== rss && 'undefined' !== id && flag === "false"){
            //动态加载内容
            $.getFeed({
                url: rss,
                success: function(feed){
                    $.each(feed.items,function(i,item){

                        var date = new Date(Date.parse(item.updated));
                        Y = date.getFullYear() + '-';
                        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
                        D = date.getDate() + ' ';
                        h = date.getHours() + ':';
                        m = date.getMinutes();
                        date=Y+M+D+h+m;
                        var itemContent="";
                        if (type!==""){
                            if (type === "title"){
                                itemContent = item.title;
                            }else if (type === "description"){
                                itemContent = item.description;
                            }else {
                                itemContent = item.description;
                            }
                        }else {
                            itemContent = item.description;
                        }
                        if (img ===""){
                            img = "<?php $this->options->BlogPic(); ?>";
                        }
                        if (date === "NaN-NaN-NaN NaN:NaN"){
                            date = "";
                        }
                        var content=timeTemple.
                        replace("{TIME}",date).
                        replace("{CONTENT}",itemContent).
                        replace("{LINK}",item.link).
                        replace("{IMG_AVATAR}",img);


                        $("#"+id).find(".comment-list").append(content);
                        $("#"+id).find(".streamline").removeClass("hide");
                        $("#"+id).find(".loading-nav").addClass("hide");
                        object.attr("data-status","true");
                        window['Page'].seFancyBox();

                    });
                },
                error: function (feed) {
                    $("#"+id).find(".loading-nav").addClass("hide");
                    $("#"+id).find(".error-nav").removeClass("hide");
                }
            });
        }
    });
    $("#time-upload").bind("click",function () {
        $("#time_file").trigger("click");

    });

    /*监听文件上传框*/
    $("#time_file").bind("change",function () {
        if (!$(this).val()) {
            $("#file-info").html("没有选择文件");
            return;
        }


        var input = $('#time_file');
        // 相当于： $input[0].files, $input.get(0).files
        var files = input.prop('files');
        // console.log(files);
        //判断文件类型
        if (files[0].type!=="image/jpeg" && files[0].type!=="image/png" && files[0].type!=="image/gif"){
            $("#file-info").val("错误的文件类型！" + files[0].type);
            return;
        }
        var suffix = "." + files[0].type.slice(6);
        // console.log(suffix);
        //开始上传文件
        var file = files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;//base64 加密后的图片数据
            var content = new FormData();
            content.append("action","upload_img");
            content.append("file",data);
            content.append("suffix",suffix);

            $.ajax({
                url: "?action=upload_img",
                type: 'post',
                data: content,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $("#time-upload").text("选择文件");
                    $("#time-upload").attr("disabled",false);
                    $("input[ name='imageInsertModal']").val(data.data);//插入返回的图片地址

                }, error: function (jqXHR, textStatus, errorThrown) {
                    $("#time-upload").attr("disabled",false);
                    $("#time-upload").text("选择文件");
                    $("#file-info").val($("#file-info").val() + "上传失败" + textStatus);
                }
            });
        };

        // data.append('data', "2333");
        $("#file-info").val(files[0].name);
        $("#time-upload").text("正在上传");
        $("#time-upload").attr("disabled",true);
        reader.readAsDataURL(file);
    })

</script>

    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->
