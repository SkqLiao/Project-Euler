<?php

/**
 * 发起请求数据，返回json
 */

require 'Meting.php';

use Metowolf\Meting;

/************ ↓↓↓↓↓ 如果网易云音乐歌曲获取失效，请将你的 COOKIE 放到这儿 ↓↓↓↓↓ ***************/
$netease_cookie = 'osver=%E7%89%88%E6%9C%AC%2010.13.3%EF%BC%88%E7%89%88%E5%8F%B7%2017D47%EF%BC%89; os=osx; appver=1.5.9; MUSIC_U=*****; channel=netease;';
/************ ↑↑↑↑↑ 如果网易云音乐歌曲获取失效，请将你的 COOKIE 放到这儿 ↑↑↑↑↑ ***************/
/**
 * cookie 获取及使用方法见
 * https://github.com/mengkunsoft/MKOnlineMusicPlayer/wiki/%E7%BD%91%E6%98%93%E4%BA%91%E9%9F%B3%E4%B9%90%E9%97%AE%E9%A2%98
 *
 * 如果还有问题，可以联系主题作者
 **/


if ($_SERVER["REQUEST_METHOD"] == "GET"){

    if (!empty($_GET['id']) && !empty($_GET['type']) && !empty($_GET['media'])){
        $id = $_GET['id'];
        $type = $_GET['type'];
        $media = $_GET['media'];
        echo getMusicInfo($media,$type,$id);
    }


}elseif ($_SERVER["REQUEST_METHOD"] == "POST"){


    if (!empty($_POST['size']) && !empty($_POST['data'])){
        $size = $_POST['size'];
        $url = $_POST['data'];
        if (!empty($_POST['autoplay'])){
            if ($_POST['autoplay'] === "false"){
                $autoplay = false;
            }else{
                $autoplay = true;
            }
        }else{
            $autoplay = false;
        }
        parseMusicUrl($url,$size,$autoplay);
    }

}

/**
 * 从分享文字中解析出链接
 * @param $text
 * @return string
 */
function parseMusicShareText($text){

    return "";
}

/**
 * @param $url
 * @param string $size
 * @param $autoplay 是否自动播放
 * @return void 返回是的歌单解析信息的数组
 */
function parseMusicUrl($url,$size="large",$autoplay){
    
    $url=trim($url);
    //echo $url;
    //如果输入的地址为空，则返回空
    if(empty($url))return;
    $media='netease';$id='';$type='';
    if ($autoplay){
        $audoplayHtml = 'auto="true"';
    }else{
        $audoplayHtml = 'auto="false"';
    }
    if(strpos($url,'163.com')!==false){
        $media='netease';
        if(preg_match('/playlist\?id=(\d+)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/toplist\?id=(\d+)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/album\?id=(\d+)/i',$url,$id))list($id,$type)=array($id[1],'album');
        elseif(preg_match('/song\?id=(\d+)/i',$url,$id))list($id,$type)=array($id[1],'song');
        elseif(preg_match('/artist\?id=(\d+)/i',$url,$id))list($id,$type)=array($id[1],'artist');
    }
    elseif(strpos($url,'qq.com')!==false){
        $media='tencent';
        if(preg_match('/playlist\/([^\.]*)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/album\/([^\.]*)/i',$url,$id))list($id,$type)=array($id[1],'album');
        elseif(preg_match('/song\/([^\.]*)/i',$url,$id))list($id,$type)=array($id[1],'song');
        elseif(preg_match('/singer\/([^\.]*)/i',$url,$id))list($id,$type)=array($id[1],'artist');
    }
    elseif(strpos($url,'xiami.com')!==false){
        $media='xiami';
        if(preg_match('/collect\/(\w+)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/album\/(\w+)/i',$url,$id))list($id,$type)=array($id[1],'album');
        elseif(preg_match('/[\/.]\w+\/[songdem]+\/(\w+)/i',$url,$id))list($id,$type)=array($id[1],'song');
        elseif(preg_match('/artist\/(\w+)/i',$url,$id))list($id,$type)=array($id[1],'artist');
        if(!preg_match('/^\d*$/i',$id,$t)){
            $data=curl($url);
            preg_match('/'.$type.'\/(\d+)/i',$data,$id);
            $id=$id[1];
        }
    }
    elseif(strpos($url,'kugou.com')!==false){
        $media='kugou';
        if(preg_match('/special\/single\/(\d+)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/#hash\=(\w+)/i',$url,$id))list($id,$type)=array($id[1],'song');
        elseif(preg_match('/album\/[single\/]*(\d+)/i',$url,$id))list($id,$type)=array($id[1],'album');
        elseif(preg_match('/singer\/[home\/]*(\d+)/i',$url,$id))list($id,$type)=array($id[1],'artist');
    }
    elseif(strpos($url,'baidu.com')!==false){
        $media='baidu';
        if(preg_match('/songlist\/(\d+)/i',$url,$id))list($id,$type)=array($id[1],'playlist');
        elseif(preg_match('/album\/(\d+)/i',$url,$id))list($id,$type)=array($id[1],'album');
        elseif(preg_match('/song\/(\d+)/i',$url,$id))list($id,$type)=array($id[1],'song');
        elseif(preg_match('/artist\/(\d+)/i',$url,$id))list($id,$type)=array($id[1],'artist');
    }
    else{//输入的地址不能匹配到上述的第三方音乐平台
        $url = preg_replace('/\//','\\/',$url);
        echo "[hplayer title=\"歌曲名\" author=\"歌手\" url=\"{$url}\" size=\"{$size}\" $audoplayHtml /]\n";
        return;
    }
    echo "[hplayer media=\"{$media}\" id=\"{$id}\" type=\"{$type}\" size=\"{$size}\" $audoplayHtml /]\n";
}

function curl($url){
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curl,CURLOPT_TIMEOUT,10);
    curl_setopt($curl,CURLOPT_REFERER,$url);
    $result=curl_exec($curl);
    curl_close($curl);
    return $result;
}

function getMusicInfo($media = 'netease', $type = 'song', $id = ''){
    $api = new Meting($media);
    global $netease_cookie;
    if ($media == 'netease'){
        $api->cookie($netease_cookie);
    }

    $info = array();
    switch ($type){
        case 'song':
            $datas = $api->format(true)->song($id);
            $datas = json_decode($datas,true);
            $data = $datas[0];
            $cover = json_decode($api->format(true)->pic($data['pic_id']),true)['url'];
            $url = json_decode($api->format(true)->url($data['id']),true)['url'];
            /**
             * 修复网易云音乐防止盗链
             */
            if ($media == 'netease'){
                $url = str_replace("http://m7c","http://m7",$url);
                $url = str_replace("http://m8c","http://m8",$url);
            }
            if ($media == "tencent"){
                $url = str_ireplace("ws.stream.qqmusic.qq.com","dl.stream.qqmusic.qq.com",$url);
            }
            $url = str_replace("http://","https://", $url);
            $info = array(
                'name' => $data['name'],
                'url' => $url,
                'song_id' => $data['id'],
                'cover' => $cover,
                'author' => $data['artist'][0]
            );
            break;
        case 'collect':
            $datas = $api->format(true)->playlist($id);
            $datas = json_decode($datas,true);
            foreach ( $datas as $keys => $data){

                $cover = json_decode($api->format(true)->pic($data['pic_id']),true)['url'];

                $info[$keys] = array(
                    'name' => $data['name'],
                    'url' => '',
                    'song_id' => $data['id'],
                    'cover' => $cover,
                    'author' => $data['artist'][0]
                );
            }


            break;
        default:
            $data = "";break;

    }

    return json_encode($info,true);
}




