<div class="show_all" style="min-height: 300px;">
    <h3 style="text-align: center">Your Forms</h3>
    <ul class="forms_list">
<?php foreach( $forms as $form ): ?>
<li>
    <h4><?php echo $form['name']; ?></h4>
    <div class="forms_link"> <a href="<?php echo $this->baseUrl ?>/view/id=<?php echo $form['_id'] ?>">View Form</a></div>
    <div class="forms_link"><a href="<?php echo $this->baseUrl ?>/entries?formId=<?php echo $form['id'] ?>">View Entries</a></div>
    <div class="forms_link"><a class="forms_delete" href="javascript:" formId="<?php echo $form['id'] ?>">Delete</a></div>
    <div class="clear-fix"></div>
</li>
<?php endforeach; ?>
    </ul>
</div>
<script>
    $(document).ready(function(){
        $(".forms_delete").click(function(){
            if(!confirm('Are you sure you want to delete this form and all it\'s data?'))
                return;
            $this = $(this).parents('li')
              $.post("<?php echo  $this->baseUrl ?>/delete_form",{'formId':$(this).attr('formId')},function(data){
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