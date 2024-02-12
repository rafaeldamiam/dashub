<br>
<h1 class='text-center'>DASHUB - Centralizador de Sites!</h1>
<br><br>
<div class="card-group col-lg-10">
	<?php 
	$counter = 0;
	foreach ($sites as $site): 
		$counter++;
	?>
		<div class="card bg-light col-lg-4" width="50%">
			<div class="card-body ">
				<a href="<?=$site['url']?>" target="_blank">
					<div class='box'><img width="50%" class="img-fluid" src="<?=URL_BASE.$site['logo']?>">
					</div>
				</a>
			</div>
		    <div class="card-body">
		      <h5 class="card-title"><?=$site['title']?></h5>
		      <p class="card-text"><?=$site['description']?></p>
		    </div>
	  	</div>
	<?php
		if($counter == 4){
			$counter = 0;
			echo "</div><div class='card-group col-lg-10'>";
		}
	endforeach; 
	?>
</div>