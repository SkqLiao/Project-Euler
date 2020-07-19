<?php
/**
 * 文章归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('component/header.php');
?>

<!-- aside -->
<?php
$this->need('component/aside.php');
$stat = Typecho_Widget::widget('Widget_Stat');
?>
<!-- / aside -->

<!-- <div id="content" class="app-content"> -->
<a class="off-screen-toggle hide"></a>
<main class="app-content-body <?php echo Content::returnPageAnimateClass($this); ?>">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="col center-part">
            <header class="bg-light lter wrapper-md">
                <h1 class="entry-title m-n font-thin text-black l-h">文章归档</h1>
                <small class="text-muted letterspacing indexWords"><?php echo sprintf(_mt("好! 目前共计 %d 篇日志。 继续努力。"), $stat->publishedPostsNum); ?></small>
            </header>
            <div class="wrapper-md">
                <ul class="timeline">
                    <?php
                    Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=' . $stat->publishedPostsNum)->to($archives);
                    $color = array("light", "info", "dark", "success", "black", "warning", "primary", "danger");
                    $year = 0;
                    $mon = 0;
                    $i = 0;
                    $j = 0;
                    $output = '';
                    $x = 0;
                    $num = 0;
                    while ($archives->next()) {
                        $year_tmp = date('Y', $archives->created);
                        $mon_tmp = date('m', $archives->created);
                        $y = $year;
                        $m = $mon;
                        if ($year > $year_tmp || $mon > $mon_tmp) {
                            $output .= '';
                        }
                        if ($year != $year_tmp || $mon != $mon_tmp) {
                            if ($x != 0) {
                                $output .= '</div>';//.tl-body
                            }
                            $year = $year_tmp;
                            $mon = $mon_tmp;
                            $x++;
                            if ($x >= 8) $x = 1;
                            $colorsec = $color[$x];
                            $output .= '<li 
class="tl-header"><h2 class="btn btn-sm btn-' . $colorsec . ' btn-rounded m-t-none">' . date('Y年m月', $archives->created) . '</h2></li><div 
class="tl-body" >';//输出月份
                        }
                        $output .= '<li class="tl-item"><div class="tl-wrap b-' . $colorsec . '"><span class="tl-date">' . date('d日', $archives->created) . '</span><h3 class="tl-content panel padder h5 l-h bg-' . $colorsec . '"><span class="arrow arrow-'
                            . $colorsec . ' left pull-up" aria-hidden="true"></span><a href="' . $archives->permalink . '" class="text-lt">' . $archives->title . '</a></h3></div></li>'; //输出文章
                    }
                    echo $output;
                    ?>
                    <li class="tl-header">
                        <div class="btn btn-sm btn-default btn-rounded">开始</div>
                    </li>
                </ul>

            </div>
        </div>
        <!--首页右侧栏-->
        <?php $this->need('component/sidebar.php') ?>
    </div>

</main>


<!-- footer -->
<?php $this->need('component/footer.php'); ?>
<!-- / footer -->