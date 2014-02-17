@extends('layouts.admin.standard')

@section('content')
<?php echo Form::model($post, array('class' => 'form-horizontal', 'method' => 'put')); ?>
    <div class="form-group">
        <?php echo Form::label('title', 'Title'); ?>
        <?php echo Form::text('title', null, array('class'=>'form-control','placeholder'=>'Enter post title')); ?>
        <?php echo \Helpers\Form::errors($errors->first('title')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('post', 'Post text'); ?>
        <?php echo Form::textarea('post', null, array('class' => 'form-control', 'rows'=>10, 'cols'=>10)); ?>
        <?php echo \Helpers\Form::errors($errors->first('post')); ?>
    </div>

    <div class="form-group">
        <label for="optionsRadios1">Visible</label>
        <div class="radio">
            <label>
                {{ Form::radio('status', 1) }}
                Show
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('status', 0) }}
                Hide
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

</form>
@stop

@section('js_foot')
<script src="/js-libraries/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post');
</script>
@stop
