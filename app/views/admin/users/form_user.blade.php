<?php echo Form::model($user, array('class' => 'form-horizontal', 'autocomplete'=>'off')); ?>
    <div class="form-group">
        <?php echo Form::label('nick', 'Nickname'); ?>
        <?php echo Form::text('nick', null, array('class'=>'form-control','placeholder'=>'Enter user nickname')); ?>
        <?php echo \Helpers\Form::errors($errors->first('nick')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('email', 'Email'); ?>
        <?php echo Form::email('email', null, array('class'=>'form-control','placeholder'=>'Enter user email')); ?>
        <?php echo \Helpers\Form::errors($errors->first('email')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('password', 'Password'); ?>
        <?php echo Form::password('password', array('class'=>'form-control','placeholder'=>'Enter user password')); ?>
        <?php echo \Helpers\Form::errors($errors->first('password')); ?>
    </div>

    <div class="form-group">
        <label for="optionsRadios1">Status</label>
        <div class="radio">
            <label>
                {{ Form::radio('status', 1) }}
                Active
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('status', 0) }}
                Inactive
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('status', 2) }}
                Banned
            </label>
        </div>
        <?php echo \Helpers\Form::errors($errors->first('status')); ?>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>