<h3>Title: <b><?php echo $post['Post']['title']; ?></b></h3>

<?php if( $authorPost != "" ){ ?>
<h1>Author: <b><?php echo $this->Html->link($authorPost, 
					array('controller'=>'users',
						'action'=>'view',$post['Post']['user_id'])); 
						?> </b></h1> 
<?php } ?>

<small>Created on: <b><?php echo $post['Post']['created']; ?></b></small>
<br><br><br> 
<p>
	<?php echo $post['Post']['body']; ?>
</p> 