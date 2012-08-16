@layout('templates.main')
@section('content')
 
    {{ Form::open() }}
    <div class="form_area">
        <h3 style="text-align: center;">Form</h3>
        <hr>
        <p style="text-align: center;" id="shownFormName">(Form Name)</p>
        <br>
        <div class="submit really_draggable">
            Done? 
        <input type="submit" value="Save Form" name="submit" id="submitButton" />
        </div>
    </div>
    <div class="side">
        <h3 style="text-align: center">Add Field</h3>
        
        <div class="choose_input draggable" data-itype="singleTextInput">Single line text</div>
        <div class="choose_input draggable" data-itype="passwordInput">Password field</div>
        <div class="choose_input draggable" data-itype="textArea">Paragraph</div>
        <div class="choose_input draggable" data-itype="checkbox">Checkbox</div>
        
        <div style="width: 100%;height: 10px;margin-top: 5px;float: left"></div>
        <hr style="float: left;width: 100%">
        <h3 style="text-align: center">Form Properties</h3>
        <div id="formProps">
            <label for="formName">Form Name:</label>
            <input type="text" id="formName" name="formName" value="(Form Name)"/>
            <label for="formDesc">Form Description:</label>
            <textarea name="formDesc"></textarea>
        </div>
        <hr>
        <h3 style="text-align: center">Field Properties</h3>
        <div id="fieldProps"></div>
        
    </div>
        </form>
<div id="mocksHolder" style="display:none;">
<?php //------------------------------------------------------------------------------------- ?>    
    <div id="singleTextInput" class="mockContainer" data-input_number="0">
        <label for="input_0" id="label_0">Text Input</label>
        <br>
        <input class="input_0" type="text" id="input_0"/>
        <span class="delete"></span>
    </div>
    <div id="singleTextInputProps" class="mockPropsContainer">
        <label for="label_for_input_">Label</label><br>
        <input class="props_for_input_" data-prop="label" input_number="" type="text" value="Text Input" id="label_for_input_" name="label_for_input_"/>
<!--        <label for="value_for_input_">Default value</label><br>
        <input class="props_for_input_" type="text" id="value_for_input_" name="value_for_input_"/>-->
        Type: Single line text
        <input type="hidden" class="hidden" value="text" name="type" />
    </div>
<?php //--------------------------------------------------------------------------------------- ?>        
    <div id="passwordInput" class="mockContainer">
        <label for="input_0">Password</label><br>
        <input class="input_0" type="password" id="input_0"/>
        <span class="delete"></span>
    </div>
    <div id="passwordInputProps" class="mockPropsContainer">
        <label for="label_for_input_">Label</label><br>
        <input class="props_for_input_" data-prop="label" input_number="" type="text" value="Password" id="label_for_input_" name="label_for_input_"/>
        Type: Password Field
        <input type="hidden" class="hidden" value="password" name="type" />
    </div>
<?php //--------------------------------------------------------------------------------------- ?>    
    <div id="checkbox" class="mockContainer" style="text-align: left">
        <input class="input_0" type="checkbox" id="input_0"/><span class="checkBoxLabel" id="label_0">Checkbox</span>
        <span class="delete" style="top:-8px;"></span>
    </div>
    <div id="checkboxProps" class="mockPropsContainer">
        <label for="label_for_input_">Label</label><br>
        <input class="props_for_input_" data-prop="label" input_number="" type="text" value="Checkbox" id="label_for_input_" name="label_for_input_"/>
        Type: Checkbox
        <input type="hidden" class="hidden" value="checkbox" name="type" />
    </div>
<?php //--------------------------------------------------------------------------------------- ?>    
    <div id="textArea" class="mockContainer">
        <label for="input_0">Text Area</label><br>
        <textarea class="input_0" id="input_0"></textarea>
        <span class="delete"></span>
    </div>
    <div id="textAreaProps" class="mockPropsContainer">
        <label for="label_for_input_">Label</label><br>
        <input class="props_for_input_" data-prop="label" input_number="" type="text" value="Text Area" id="label_for_input_" name="label_for_input_"/>
        Type: Text Area
        <input type="hidden" class="hidden" value="textArea" name="type" />
    </div>
</div>
<?php //--------------------------------------------------------------------------------------- ?>   
<script>
    
/**
 * true when lmb is down, false when not
 */    
var down = false;

/**
 * current div being dragged to the form, null if there is non
 */
var current = null;

/**
 *current really_draggable element, this element actually stays in the changed 
 *
 */
var current_really_draggable = null;
/**
 * true if mouse pointer is inside the form area, false if outside
 * used by mouseup to check if the div being dragged is dropped inside or 
 * outside the form area
 */
var inFormArea = false;

/**
 * inputs are numbered incrementally,
 * this is the number of the current input being processed
 */
var inputNumber = 1;

$(document).ready(function(){
    
    $('.form_area').hover(function(){inFormArea = true;},function(){inFormArea = false;})
    
    $(document).mouseup(function(){
        down = false;
        if(current){
            if(inFormArea){
                $(document.getElementById(current.data('itype'))).clone()
                                                                 .removeAttr('id')      
                                                                 .find('label')
                                                                    .attr('for','input_' + inputNumber)
                                                                    .attr('id','label_'+inputNumber)
                                                                 .end()
                                                                 .find('span.checkBoxLabel')
                                                                    .attr('id','label_'+inputNumber)
                                                                 .end()
                                                                 .find('.input_0')
                                                                    .attr('id','input_' + inputNumber)
                                                                 .end()
                                                                 .data('input_number', inputNumber)
                                                                 .appendTo('.form_area')
                $(document.getElementById(current.data('itype')+'Props')).clone()      
                                                                 .attr('id','props'+inputNumber)
                                                                 .find('label')
                                                                     .attr('for',function(i,value){return value+inputNumber})
                                                                 .end()
                                                                 .find('input')
                                                                     .attr('id',function(i,value){return value+inputNumber})
                                                                     .attr('name',function(i,value){return 'inputs['+inputNumber+'][label]'})
                                                                     .attr('input_number',inputNumber)
                                                                 .end()
                                                                 .find('input.hidden')
                                                                     .removeAttr('id')
                                                                     .attr('name',function(i,value){return 'inputs['+inputNumber+'][type]'})
                                                                 .end()
                                                                 .appendTo('#fieldProps')
                $("#input_"+inputNumber).click()                                                                 
                inputNumber++;                
            }
            current.remove();
        }       
        current = null;
        
        current_really_draggable = null;        
    });
    
    $(document).mousemove(function(e){
        if(down){
            if(current){
                var left = e.pageX - 70;
                var top = e.pageY - 5;
                current.css({"position":"absolute","left":left,"top":top})
            }
            if(current_really_draggable){
                var left = e.pageX - 70;
                var top = e.pageY - 35;
                current_really_draggable.css({"position":"fixed","left":left,"top":top})
            }
        }
    })
    
    $('.draggable').mousedown(function(e){
        down = true;
        var left = e.pageX - 70;
        var top = e.pageY - 35;
        current = $(this).clone()
                         .appendTo('.main_content')
                         .css({"position":"absolute","left":left,"top":top})
        return false;
    })
    
    $('.really_draggable').mousedown(function(e){
        down = true;
        var left = e.pageX - 70;
        var top = e.pageY - 35;
        current_really_draggable = $(this).css({"position":"fixed","left":left,"top":top})
        return false;
    })
    
    $(document).on('click','.mockContainer',function(){
        $('.mockContainer').css('background-color','inherit');
        $(this).css('background-color','#A2ADBC');
        $('.mockPropsContainer').hide();
        $('#props'+$(this).data('input_number')).show();
        console.log($(this).data('input_number'))
    })
    
    $(document).on('keyup','.props_for_input_',function(){
        if($(this).data('prop') == 'label'){
            $('#label_'+$(this).attr('input_number')).text($(this).val())
        }
    })
    
    $(document).on('keypress','input',function(e){
        if(e.keyCode == 13)
            return false;
        
    })
    $(document).on('keyup','#formName',function(){
        $('#shownFormName').text($(this).val())
    })
    
    $(document).on('click','.delete',function(){
        number = $(this).parent('.mockContainer').data('input_number')
        $(this).parent('.mockContainer').remove();
        $('#props'+number).remove();
    })
    
    
    
})
</script>


@endsection