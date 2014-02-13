<div class="list-group">
    <?php if ( !Auth::user()->check() ) : ?>
        <?php echo link_to('user/register', 'Register', array('class'=>'list-group-item'.Helpers\MrView::activeLaravelLink('UserController@*Register'))); ?>
        <?php echo link_to('user/login', 'Login', array('class'=>'list-group-item'.Helpers\MrView::activeLaravelLink('UserController@*Login'))); ?>
    <?php else : ?>
        <?php echo link_to('user/account', 'Your account', array('class'=>'list-group-item'.Helpers\MrView::activeLaravelLink('UserController@*Account'))); ?>
        <?php echo link_to('user/logout', 'Logout', array('class'=>'list-group-item')); ?>
    <?php endif; ?>
</div>
