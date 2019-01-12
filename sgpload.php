
<?php


$count=0;
$max_load=0;
$sync_done=0;
function load($dir) {
   $path = opendir($dir);
   while (false !== ($file = readdir($path))) {
       if($file!="." && $file!="..") {
           if(is_file($dir."/".$file))
               $files[]=$file;
           else
               $dirs[]=$dir."/".$file;           
       }
   }
   if($dirs) {
       natcasesort($dirs);
       foreach($dirs as $dir) {
           echo $dir;
           read_dir($dir);
       }
   }
   if($files) {
       natcasesort($files);
       foreach ($files as $file) {

$data = explode(".", $file);

// syncronizing graph to time
while (($count != substr($data[0], 6, 2)) && ($sync_done==0))
{
$load_value[$count]=-1;
$load_value[$count]=-1;
$count++;
}
$sync_done = 1;




$load_value[$count] = $data[1] * 100 + $data[2];


// Find the maximum
if ($load_value[$count] > $max_load) {$max_load = $load_value[$count];}




$count++;



}




$i=0;

// **************************************************************************
// Okay, now we can start creating html tables with html graphs :-)
// **************************************************************************

?>


<table border="0" height="200" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="left" width="70">


<table height="200" border="0" cellspacing="0" cellpadding="0" width="70" border="0">
<tr>
<td height="50" valign="top" align="right">
<? echo number_format(($max_load/100), 1); ?> &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo number_format(($max_load*3/400), 1); ?> &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo number_format(($max_load/200), 1); ?> &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo number_format(($max_load/400), 1); ?> &nbsp;
</td>
</tr>
</table>


</td>
<td align="left">


<table height="200" cellspacing="0" cellpadding="0" background="graph.gif" width="<? echo $count; ?>" border="0">
<tr>
<td align="left">
<?
while($i < $count) { if ($load_value[$i] != -1)
{
echo '<img src="blu.png" height="';
echo (($load_value[$i]/$max_load) * 200);
echo '" width="1">';
}
else
{
?><img src="gray.png" height="200" width="1"><?
}
$i++;
}
?>
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td colspan="3" align="left">

<table cellspacing="0" cellpadding="0" border="0">
<tr><td height="3" colspan="14"></td></tr>
<tr>
<td width="42">&nbsp;</td>
<td width="60" align="center"></td>
<td width="60" align="center"><?  $date = (date("H") - 11); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 10); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 9); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 8); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 7); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 6); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 5); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 4); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 3); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 2); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 1); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
<td width="60" align="center"><?  $date = (date("H") - 0); if ( $date < 0) { $date = abs($date + 24); } echo "$date:00"; ?></td>
</tr>
</table>

</td>
</tr>
</table>


<?
}
closedir($path);

// **************************************************************************
// End of the function
// **************************************************************************
}
?>









<?php

// **************************************************************************
// Call the function to create the graphs with the path where data files are
// **************************************************************************

load("./data/load");

?> 

