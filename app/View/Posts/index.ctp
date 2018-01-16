<div class="posts">
	<?php foreach($posts as $post) : ?> 
	<!-- Display title -->	
	<h3> <?php echo $this->Html->link($post['Post']['title'],
						array('controller'=>'posts','action'=>'view',$post['Post']['id'])); ?>  

	<!-- Display author -->
	<font size="2"> 
	<?php 
		if( $post['Post']['username'] != "" ) 
			echo "by ".$this->Html->link($post['Post']['username'],
						array('controller'=>'users','action'=>'view',$post['Post']['user_id']));
	?> </font> </h3> 
	
	
	<!-- Display body --> 
	<h4> <?php
	echo substr($post['Post']['body'], 0, 200);  
	if( strlen($post['Post']['body']) > 198 ) echo "..."; 
	?> </h4> 
	<br>  
	<?php endforeach; ?> 	
</div> 