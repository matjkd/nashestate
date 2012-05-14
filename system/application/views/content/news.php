<?php 

foreach($news as $row):
		if($row->title !="") {
		 echo "<h1>".$row->title."</h1>";
		 echo $row->published."<br/>";
		 echo $row->content."<br/>";
		}
	
		?>
		
		
		
		<?php 	endforeach; ?>