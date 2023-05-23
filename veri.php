<?php
ini_set('display_errors',1);
error_reporting(0);
ini_set('memory_limit',-1);

header('X-Robots-Tag: noindex, nofollow');
$APP_CACHE_FILE = "datas.json";
$cachetime = 5;


if (file_exists($APP_CACHE_FILE) && (filemtime($APP_CACHE_FILE) > (time() - 60 * $cachetime ))) {
  $result = file_get_contents($APP_CACHE_FILE);
} else {
  include 'simple_html_dom.php';
  $forum_url = "https://forum.stendustri.com.tr";
  $html = file_get_html($forum_url.'/index.php');

  $result = [];
  foreach($html->find('div.block[data-widget-definition="new_posts"] ul.block-body li') as $element) {
        if($element->find('div.contentRow-main>a', 0)->plaintext) {
           $result[] = [
              'post' => [
                'title' => $element->find('div.contentRow-main>a', 0)->plaintext,
                'link' => $forum_url.$element->find('div.contentRow-main>a', 0)->href
              ],
              'subject' => [
                'title' => $element->find('div.contentRow-main div.contentRow-minor>a', 0)->plaintext,
                'link' => $forum_url.$element->find('div.contentRow-main div.contentRow-minor>a', 0)->href
              ],
              'user' => [
                'name' => $element->find('div.contentRow-figure img', 0)->alt,
                'profile' => $forum_url.$element->find('div.contentRow-figure a', 0)->href,
                'avatar' => $forum_url.$element->find('div.contentRow-figure img', 0)->src
              ],
              'time' => $element->find('ul.listInline li time', 0)->plaintext
            ];
        }
  }
  $result = json_encode($result);
  file_put_contents($APP_CACHE_FILE, $result, LOCK_EX);
}
echo ($result);
