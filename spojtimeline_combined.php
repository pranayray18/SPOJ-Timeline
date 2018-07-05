<head>
<title>SPOJ Timeline</title>
<style>
	table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: center;
}
</style>
</head>
<body>
<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<input type="text" placeholder="Enter Username" name="user1">
<button type="submit" name="submit">Submit</button>
</form>
<br/>






<table style="width:75%"">
<tr>
<th>Sl. No.</th>
<th>Name</th>
<th>Date</th>
<th>Month</th>
<th>Year</th>
<th>Time</th>
</tr>
<tr>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	
	$u1=$_POST["user1"];
	
$lnk='http://www.spoj.com/users/'.$u1.'/';
$url=file_get_contents($lnk);
if(preg_match_all('/<td align="left" width="14%"><a href="[^"]+">(.+)<\/a><\/td>/',$url,$matched))
	{
		//echo ($matched[0][3]);
	
			for($i=0;$i<sizeof($matched[0]);$i++)
		{
			$pr=strip_tags($matched[0][$i]);
			//echo($pr);
			if(!empty($pr)){
			$name1[$i]=$pr;	
			}
			
		//echo strip_tags($matched[0][$i],"<b>");
		//printf("\n");	
		}
		

	}
	else
	{
		echo "No match found";
	}
	//echo "first";
	//echo sizeof($name1);

	$lnk2='http://www.spoj.com/users/'.'bbi5291'.'/';
	$url2=file_get_contents($lnk2);

	if(preg_match_all('/<td align="left" width="14%"><a href="[^"]+">(.+)<\/a><\/td>/',$url2,$matched2))
	{
		//echo sizeof($matched[0]);
		for($i11=0;$i11<sizeof($matched2[0]);$i11++)
		{
			$name2[$i11]=strip_tags($matched2[0][$i11],"<b>");
		//echo $matched2[0][$i1];
		//printf("\n");	
		}
		
	}
	else
	{
		echo "No match found";
	}
	
	
	$assarr=array();

	for($i2=0;$i2<sizeof($name1);$i2++)
	{
		$lnk2='http://www.spoj.com/status/'.$name1[$i2].','.$u1.'/';
		
		$url2=file_get_contents($lnk2);	
		if(preg_match('/<tr class="kol1 ">([\s\S]*?)<\/tr>/',$url2,$matched1))
		{

		$r=substr(strip_tags($matched1[1]),19,17);
		//echo($name1[$i2]." ".$r);
		//echo("\n");
		$timestamp = strtotime($r);
		$nme=$name1[$i2];
		$assarr[$nme]=$timestamp;
	}
	else
	{
		//$assarr[$nme]=0;
		//$name1[$nme]=0 ;
	}
	
}
arsort($assarr);

$cc=1;
foreach ($assarr as $key => $value) {
    // $arr[3] will be updated with each value from $arr...
    ?>
    <td><?php echo($cc) ?></td>
    
    <?php
    $cnt=0;
     for($i3=0;$i3<sizeof($name2);$i3++)
		{
			$n2=$name2[$i3];
			if(strcmp($key,$n2)==0)
			{
				$cnt=1;

			}
		}
		if($cnt==0)
		{
			?> <td><?php echo '<a target="_blank" href=http://www.spoj.com/problems/'.$key.'/>'.$key.'</a>' ; ?></td>
			<?php
		}
		else
		{
			?> <td bgcolor="#b1ff6d"><?php echo '<a target="_blank" href=http://www.spoj.com/problems/'.$key.'/>'.$key.'</a>' ; ?></td>
			<?php
		}


    ?>
    
    <td><?php echo date("d",$value); ?></td>
    <td><?php echo date("M",$value); ?></td>
    <td><?php echo date("Y",$value); ?></td>
    <td><?php echo date("h:i a",$value); ?></td>
    </tr>
    


   

	
	
<?php	
$cc=$cc+1;
}
}
?>

</table>
</body>
