@layout('templates.main')
@section('content')
<div class="show_all" style="min-height: 300px;">
    <h3 style="text-align: center">Your Forms</h3>
    <ul class="forms_list">
@foreach( $forms as $form )
<li>
    <h4>{{ $form->name }}</h4>
    <div class="forms_link">{{ HTML::link_to_action("Home@form","View Form",array('id'=>$form->id)) }}</div>
    <div class="forms_link">{{ HTML::link_to_action("Home@entries","View Entries",array('formId'=>$form->id)) }}</div>
    <div class="forms_link"><a class="forms_delete" href="javascript:" formId="{{ $form->id }}">Delete</a></div>
    <div class="clear-fix"></div>
</li>
@endforeach
    </ul>
</div>
<script>
    $(document).ready(function(){
        $(".forms_delete").click(function(){
            if(!confirm('Are you sure you want to delete this form and all it\'s data?'))
                return;
            $this = $(this).parents('li')
              $.post("{{ action('Home@delete_form') }}",{'formId':$(this).attr('formId')},function(data){
                  if(data.success)
                  {
                      alert('Form successfully deleted!')
                      $this.fadeOut(500)
                  }
                  else
                      alert('error')
              },"json")

        })
    });
</script>
@endsection