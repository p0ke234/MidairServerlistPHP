<?php
$cache = 'servers.json';
$cacheTime = 5;
if (file_exists($cache) && (filemtime($cache) > (time() - 60 * $cacheTime ))) {
   $json = file_get_contents($cache);
} else {
   $json = file_get_contents('https://api.bittah.com/servers');
   file_put_contents($cache, $json, LOCK_EX);
}
$array = json_decode($json, true);

echo "<html>";
echo "<LINK REL='StyleSheet' HREF='style.css' TYPE='text/css'>";
echo "<center>";
echo "<table class=\"Server\" border=1 cellpadding=5 cellspacing=0>";
echo "<tr><th colspan=3 align=center>MIDAIR Serverlist</th></tr>";
echo "<tr><th align=left>Name</th><th align=left>Map</th><th align=left>Players</th></tr>";
foreach($array as $value) { 
    if ($value['players'] >= 1)
    {
    	echo "<tr>";
    	echo " <td align=left>".$value['name']."</td>";
    	echo " <td width=300 align=left>".$value['map']."</td>";
    	echo " <td width=100 align=left>".$value['players']." / ".$value['max_players']."</td>";
    	echo "</tr>";
	}
}
echo "</center>";
echo "</table>";
echo "</html>";
?>