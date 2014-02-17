@extends('layouts.admin.standard')

@section('content')
<form method="post" role="form">
    <div class="form-group">
        <?php echo Form::label('title', 'Title'); ?>
        <?php echo Form::text('title', null, array('class'=>'form-control','placeholder'=>'Enter post title')); ?>
        <?php echo \Helpers\Form::errors($errors->first('title')); ?>
    </div>

    <div class="form-group">
        <label for="post">Post text</label>
        <textarea name="post" id="post" cols="10" rows="10" class="form-control"></textarea>
        <?php echo \Helpers\Form::errors($errors->first('post')); ?>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" name="tags" id="tags" class="form-control" placeholder="Tags">
        <?php echo \Helpers\Form::errors($errors->first('tags')); ?>
    </div>

    <div class="form-group">
        <label for="optionsRadios1">Visible</label>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios1" value="1" checked>
                Show
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="status" id="optionsRadios2" value="0">
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
