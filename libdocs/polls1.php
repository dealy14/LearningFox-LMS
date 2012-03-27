
<?PHP
global $wpdb;
$value1 = date("m/d/Y h:i:s a", time());
$value2 = $value1 + 8600;
$poll_questions = $wpdb->get_results($wpdb->prepare("SELECT pollq_id FROM `wp_pollsq` WHERE pollq_timestamp BETWEEN '$value1' AND '$value2'"));

$counter = 1;

foreach ( $poll_questions as $row ) 
{
  echo "<strong>Poll #" .$counter. ":</strong>";
  echo '[poll id=" ' .$row->pollq_id. ' "]';
  $counter++;
}

?>