
<div class="show_all" style="min-height: 300px;">
    <h3 style="text-align: center">Entries for form: <?php echo $form->name ?></h3>
    <ul class="forms_list">
<?php foreach( $entries as $formNumber=>$entry ): ?>
<li>
    <p>Entry {{ $formNumber }}</p>
    <div class="forms_link">{{ HTML::link_to_action("Home@entry","View Entry",array('formNumber'=>$formNumber,'formId'=>$form->id)) }}</div>
    <div class="forms_link">
        <a class="entries_delete" href="javascript:" formNumber="{{ $formNumber }}">Delete Entry</a>
    </div>
    <div class="clear-fix"></div>
</li>
<?php endforeach; ?>
    </ul>
</div>
<script>
$(document).ready(function(){
        $(".entries_delete").click(function(){
            if(!confirm('Are you sure you want to delete this entry?'))
                return;
            $this = $(this).parents('li')
              $.post("{{ action('Home@delete_entry') }}",{'formNumber':$(this).attr('formNumber'),'formId':"{{ $form->id }}"},function(data){
                  if(data.success)
                  {
                      alert('Entry successfully deleted!')
                      $this.fadeOut(500)
                  }
                  else
                      alert('error')
              },"json")

        })
    });
</script>
@endsection