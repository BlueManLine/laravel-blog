<div class="list-group">
    <?php echo link_to('user/register', 'Register', array('class'=>'list-group-item'.Helpers\MrView::activeLaravelLink('UserController@*Register'))); ?>
    <?php echo link_to('user/login', 'Login', array('class'=>'list-group-item'.Helpers\MrView::activeLaravelLink('UserController@*Login'))); ?>
</div>
