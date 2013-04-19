<!DOCTYPE HTML >
<html>
    <head>
        <title>FormBuilder</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-1.8.3.js"></script>
    </head>
    <body>
        <div class="header">
            <h1 style="text-align: center">FormBuilder</h1>
        </div>
            
        <div class="" style="width: 1100px;height: 600px;margin: 0px auto;">
           <div id="singleForm" style="margin: 10px auto;width: 600px;">
    <h2><?php echo $form['name'] ?></h2>
    
<form>
<?php foreach ($form['inputs'] as $input): ?>
<?php if( $input['type'] != "checkbox" ): ?>
<div class="form_label">
    <label><?php echo $input['name']; ?></label>
</div>
<?php endif; ?>
<?php if( $input['type'] == "text" ): ?>
<div class="form_input">
{{ Form::text("input_$input->id") }}
</div>
    <?php endif; ?>
@elseif( $input->type == "textArea" )
<div class="form_input">
{{ Form::textArea("input_$input->id") }}
</div>
@elseif( $input->type == "password" )
<div class="form_input">
{{ Form::password("input_$input->id") }}
</div>
@else
<div class="form_input">
{{ Form::checkbox("input_$input->id") }}
{{ $input->name }}
</div>
@endif
<?php endforeach; ?>
{{ Form::hidden('formId',"$form->id") }}
{{ Form::submit('Submit') }}
</form>
</div>
        </div>
    </body>
</html>
