<?php

$count=0;
$sync_done=0;

function create_graphs($dir) {
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
$values_in[$count]=0;
$values_out[$count]=0;
$count++;
}
$sync_done = 1;

// Avoid tho have the first value very very high.. :-)
$values_in[$count] = ($data[1] - $prev_value_in);
if ($values_in[$count] == $data[1]) $values_in[$count]=0;

$values_out[$count] = ($data[2] - $prev_value_out);
if ($values_out[$count] == $data[2]) $values_out[$count]=0;

//define now these variables so next cycle we will konw the previus values
$prev_value_in = $data[1];
$prev_value_out = $data[2];

$count++;
}

// **************************************************************************
// Okay, now i have the array with all values, let's start to elaborate it.
// **************************************************************************

// First, find the maximum values
$max_in=0;
$max_out=0;
while($i < $count)
{
if ($values_in[$i] > $max_in) $max_in = $values_in[$i];
if ($values_out[$i] > $max_out) $max_out = $values_out[$i];
$i++;
}
$i=0;

// Let's use more friendly numbers
$max_in=$max_in/10/1024/60;
$max_in=ceil($max_in);
$max_in.=0;

$max_out=$max_out/10/1024/60;
$max_out=ceil($max_out);
$max_out.=0;


// **************************************************************************
// Okay, now we can start creating html tables with html graphs :-)
// **************************************************************************

?>


<table height="200" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="left" width="70">


<table height="200" border="0" cellspacing="0" cellpadding="0" width="70">
<tr>
<td height="50" valign="top" align="right">
<? echo (pow(10,log10($max_in))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_in)*(3/4))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_in)*(2/4))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_in)*(1/4))); ?> Kbs &nbsp;
</td>
</tr>
</table>


</td>
<td align="left">


<table height="200" cellspacing="0" cellpadding="0" background="graph.gif" width="<? echo $count; ?>" border="0">
<tr>
<td align="left">
<?
while($i < $count) { if ($values_in[$i] != 0)
{
echo '<img src="blu.png" height="';
//normalizzo a 1 dividendo per max_in e moltiplico per l'altezza
echo ceil((log10(($values_in[$i]/1024/60/$max_in)*200)/log10(200))*200);
//echo ceil((log(log(($values_out[$i]/1024/60/$max_out)*200)*10)/log(log(200)*10))*200);
//echo ceil(($values_in[$i]/1024/60/$max_in)*200);
echo '" width="1">';
}
else
{
echo '<img src="gray.png" height="200" width="1">';
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

<? $i=0; ?><br>




<table height="200" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="left" width="70">


<table height="200" border="0" cellspacing="0" cellpadding="0" width="70">
<tr>
<td height="50" valign="top" align="right">
<? echo (pow(10,log10($max_out))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_out)*(3/4))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_out)*(2/4))); ?> Kbs &nbsp;
</td></tr>
<tr><td height="50" valign="top" align="right">
<? echo round(pow(10, log10($max_out)*(1/4))); ?> Kbs &nbsp;
</td>
</tr>
</table>


</td>
<td align="left">


<table height="200" cellspacing="0" cellpadding="0" background="graph.gif" width="<? echo $count; ?>" border="0">
<tr>
<td align="left">
<?
while($i < $count) { if ($values_out[$i] != 0)
{
echo '<img src="green.png" height="';
//echo ceil(($values_out[$i]/1024/60/$max_out)*200);
echo ceil((log10(($values_out[$i]/1024/60/$max_out)*200)/log10(200))*200);
echo '" width="1">';
}
else
{
echo '<img src="gray.png" height="200" width="1">';
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
// Set the path where data files are, call the function to create the graphs
// **************************************************************************

$path="./data/net";
create_graphs($path);
?> 

