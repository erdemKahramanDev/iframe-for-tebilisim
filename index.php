<style>
.panel {
  background-color: #fafbfc;
  border: 1px solid #e6edf2;
  margin: 0;
  padding: 10px;
}

.panel-title {
  border: 1px solid #17a2b8;
  display: inline-block;
  padding: 5px 10px;
  background-color: #17a2b8;
  color: #fff;
  text-align: center;
}

.media {
  background-color: #fff;
  border: 1px solid #e6edf2;
  margin: 0;
  padding: 10px;
  display: flex;
  align-items: center;
}

.media-object {
  border-radius: 50%;
}

.media-body {
  margin-left: 10px;
}

.media-body a {
  color: #000;
  text-decoration: none;
}

.text-muted {
  color: #999;
  font-size: 12px;
}

.text-muted a {
  color: #999;
}

.text-muted a:hover {
  text-decoration: underline;
}
</style>

<?php
$forum_json = file_get_contents('datas.json');
$forum = json_decode($forum_json, true);

if ($forum) {
?>
<div class="panel sayfalar mb-20">
 
  <div class="panel-body p-0">
    <?php foreach ($forum as $k => $v){ ?>
    <div class="media">
      <div class="media-left media-middle">
        <a href="<?=$v['user']['profile']?>" target="_blank">
          <img class="media-object img-circle" width="35" src="<?=$v['user']['avatar']?>" alt="<?=$v['user']['name']?>">
        </a>
      </div>
      <div class="media-body">
        <b class="clearfix"> <a href="<?=$v['post']['link']?>" target="_blank"><?=$v['post']['title']?></a> </b>
        <small class="text-muted">Son: <?=$v['user']['name']?> - <?=$v['time']?></small>
        <p><a href="<?=$v['subject']['link']?>" target="_blank"><?=$v['subject']['title']?></a></p>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php } ?>
