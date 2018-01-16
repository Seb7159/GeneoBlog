<div class="posts">
	<?php foreach($posts as $post) : ?> 
	<!-- Display title -->	
	<h3> <?php echo $this->Html->link($post['Post']['title'],
						array('controller'=>'posts','action'=>'view',$post['Post']['id'])); ?> 

	<!-- Display author -->
	<?php 
	$un = NULL; 
	if( $post['Post']['user_id'] != "" ){
		$con= new mysqli("localhost","geneo","Geneo1234","geneo");
		$query = "SELECT * FROM users WHERE id = " . $post['Post']['user_id']; 
		$result = mysqli_query($con, $query); 
		$un = mysqli_fetch_array($result)['username']; 
		mysqli_close($con);
	} 
	 
	if( $un != NULL ){ 
		echo "by "; 
		echo $un; 
	}
	?> 
	</h3> 
	
	<!-- Display body --> 
	<h4> <?php echo $post['Post']['body'];  ?> </h4> 
	<br>  
	<?php endforeach; ?> 	
</div> 