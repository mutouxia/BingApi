<?php
$day = $_GET['day'];
$size = $_GET['size'];
$type = $_GET['type'];
$resolution = $_GET['resolution'];
#echo $day;
$url = 'https://www.bing.com/HPImageArchive.aspx?format=js&idx='.$day.'&n=1';
$json=file_get_contents($url); 
//echo $json;
$json = json_decode($json,true);

switch ($type)
{
case 'text':
    $copyright = $json['images'][0]['copyright'];
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
    global $json,$size,$resolution;
    $urlbase = $json['images'][0]['urlbase'];
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
?>