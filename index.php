<?php
$cache_path = 'bing_cache';
$time_file = $cache_path.'/time.txt';
$url_file = $cache_path.'/url.txt';
$copyright_file = $cache_path.'/copyright.txt';
$day = $_GET['day'];
$size = $_GET['size'];
$type = $_GET['type'];
$resolution = $_GET['resolution'];
$url = 'https://www.bing.com/HPImageArchive.aspx?format=js&idx='.$day.'&n=1';

# 文件/夹不存在就创建
if(!is_dir($cache_path)){
    mkdir($cache_path,0755);
}
if(!is_file($time_file)){
    touch($time_file);
}
if(!is_file($url_file)){
    touch($url_file);
}
if(!is_file($copyright_file)){
    touch($copyright_file);
}

# 从'time.txt'读取时间戳，判断和上一次访问的间隔在60秒内就直接从本地'url.txt'读取图片url
$old_time = intval(file_get_contents($time_file));
if (time()-$old_time>60){
    $time_file_open = fopen($time_file,'w+');
    fwrite($time_file_open,time());
    fclose($time_file_open);
    $urlbase = get_data(false)[0];
    $copyright = get_data(false)[1];
}else{
    $urlbase = get_data(true)[0];
    $copyright = get_data(true)[1];
}

switch ($type){
    # 从$type判断类型，返回
    case 'text':
        global $copyright;
        echo $copyright;
        break;
    case 'url':
        echo get_url('url');
        break;
    default:
        header("status: 302");
        header("Location: ".get_url('pic'));
}

function get_url($type){
    # 从$size或$resolution判断图片的分辨率
    global $urlbase,$size,$resolution;
    if ($resolution){
        $urlsize = '_'.$resolution.'.jpg';
    }else{
        switch ($size)
        {
        case '2k':
        case '1440':
        case '2560':
            $urlsize = '_UHD.jpg';
            break;
        case 1920:
            $urlsize = '_1920x1080.jpg';
            break;
        case 1080:
            $urlsize = '_1080x1920.jpg';
            break;
        default:
            $urlsize = '_1920x1080.jpg';
        }
    }
    $imgurl = 'https://www.bing.com'.$urlbase.$urlsize;
    return $imgurl;
}

function get_data($islocal){
    # $islocal为true时从本地读取，否则从bing的api请求获得
    global $time_file,$url_file,$copyright_file,$url;
    if ($islocal){
        $urlbase = file_get_contents($url_file);
        $copyright = file_get_contents($copyright_file);
    }else{
        $json = json_decode(file_get_contents($url),true);
        $urlbase = $json['images'][0]['urlbase'];
        $copyright = $json['images'][0]['copyright'];
        $url_file_open = fopen($url_file,'w+');
        fwrite($url_file_open,$urlbase);
        fclose($url_file_open);
        
        $copyright_file_open = fopen($copyright_file,'w+');
        fwrite($copyright_file_open,$copyright);
        fclose($copyright_file_open);
    }
    return array($urlbase,$copyright);
}

?>