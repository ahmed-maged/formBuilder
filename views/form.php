<!DOCTYPE HTML >
<html>
    <head>
        <title>FormBuilder</title>
        {{ HTML::style('css/style.css') }}
        {{ HTML::script('js/jquery-1.8.3.js') }}
    </head>
    <body>
        <div class="header">
            <h1 style="text-align: center">FormBuilder</h1>
        </div>
            
        <div class="" style="width: 1100px;height: 600px;margin: 0px auto;">
           <div id="singleForm" style="margin: 10px auto;width: 600px;">
    <h2>{{ $form->name }}</h2>
    
{{ Form::open() }}
@foreach ($form->inputs as $input)
@if( $input->type != "checkbox" )
<div class="form_label">
{{ Form::label("input_$input->id","$input->name") }}
</div>
@endif
@if( $input->type == "text" )
<div class="form_input">
{{ Form::text("input_$input->id") }}
</div>
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
@endforeach
{{ Form::hidden('formId',"$form->id") }}
{{ Form::submit('Submit') }}
{{ Form::close() }}
</div>
        </div>
    </body>
</html>
