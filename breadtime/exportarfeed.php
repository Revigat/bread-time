<?php
  require('_app/Config.inc.php');
  $read = new Read;
  $read->ExeRead('ws_posts', " where post_status=1 order by post_id desc", "");
  //print_r($read->getResult());

header('Content-Type: application/json;charset=utf-8');

echo  "{\n";
echo  "\"Feed\": [\n";

$virg = "";
if ($read->getRowCount() > 1) {
  $virg=",";
}

$json_filt = array('"',chr(13),"\n");
$json_char = array("''","","");
$numItems = count($read->getResult());
$i = 0;

foreach ($read->getResult() as $post) {
  extract($post);
  Check::Image('../uploads/' . $post_cover, $post_title, 120, 70);
  $i++;

  if($i == $numItems) {
//  echo  "{\n\"id\":\"".$post_id."\",\n\"title\":\"".$post_title."\",\n\"conteudo\":\"".str_replace($json_filt,$json_char,$post_content)."\",\n\"miniatura\":\"".$post_cover."\"\n}\n";
    echo  "{\n\"id\":\"".$post_id."\",\n\"title\":\"".$post_title."\",\n\"date\":\"".date('d/m/Y', strtotime($post_date))."\",\n\"categoria\":\"".$post_category."\",\n\"autor\":\"".$post_author."\",
              \n\"conteudo\":\"".str_replace($json_filt,$json_char,$post_content)."\",\n\"views\":\"".$post_views."\",\n\"miniatura\":\"http://breadtimeup.esy.es/breadtime/uploads/".$post_cover."\"\n}\n";
  }

  else {
//  echo  "{\n\"id\":\"".$post_id."\",\n\"title\":\"".$post_title."\",\n\"conteudo\":\"".str_replace($json_filt,$json_char,$post_content)."\",\n\"miniatura\":\"".$post_cover."\"\n}\n,\n";
    echo  "{\n\"id\":\"".$post_id."\",\n\"title\":\"".$post_title."\",\n\"date\":\"".date('d/m/Y', strtotime($post_date))."\",\n\"categoria\":\"".$post_category."\",\n\"autor\":\"".$post_author."\",
              \n\"conteudo\":\"".str_replace($json_filt,$json_char,$post_content)."\",\n\"views\":\"".$post_views."\",\n\"miniatura\":\"http://breadtimeup.esy.es/breadtime/uploads/".$post_cover."\"\n}\n,\n";
  }
  
}

echo  "]\n";
echo  "}\n";

?>
