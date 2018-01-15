<div class="users form">
<?php echo $this->Form->create('Post'); ?>
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
        <?php 
        echo $this->Form->input('title');
        echo $this->Form->input('body'); 
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div> 