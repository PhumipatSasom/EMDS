<?php
function file_get_contents_curl($url) // ฟังก์ชั่นเริ่มต้น กำหนดค่า และสั่งทำงาน curl
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$html = file_get_contents_curl("http://www.emworkgroup.com/career.html"); //โหลดข้อมูล html จากเว็บไซต์ทั่วไป
$doc = new DOMDocument(); 
@$doc->loadHTML($html); // ข้อมูลที่ได้จะเป็น html ใช้คำสั่ง loadHTML เพื่อแปลงให้อยู่ในรูปแบบ xml
$nodes = $doc->getElementsByTagName('title');
$title = $nodes->item(0)->nodeValue;
$body = $doc->getElementsByTagName('body')->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
$imgs = $doc->getElementsByTagName('img');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}
for ($i = 0; $i < $imgs->length; $i++)
{
    $img = $imgs->item($i)->getAttribute('alt');
    
}

echo "Title: $title". '<br/><br/>';
echo "Bodys: $body". '<br/><br/>';
for ($i = 0; $i < $imgs->length; $i++)
{
    $img = $imgs->item($i)->getAttribute('src');
    echo "Imgs: $img". '<br/><br/>';
}

echo "Description: $description". '<br/><br/>';
echo "Keywords: $keywords";
?>