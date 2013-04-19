<div style="margin: 10px auto;width: 800px;height: 500px;">
    <a href="javascript:" id="get_all">Get All Forms</a>
    <a href="javascript:" id="get_one">Get form</a> <input type="text" id="fid">
    <a href="javascript:" id="remove_one">delete form </a> <input type="text" id="frid">
</div>
    <script>
        $(document).ready(function(){
            $("#get_all").click(function(){
                $.post('<?php echo Helper::url("test") ?>',{all:true},function(data){
                    console.log(data);
                })
            })
            $("#get_one").click(function(){
                $.post('<?php echo Helper::url("test") ?>',{find:true,id:$("#fid").val()},function(data){
                    console.log(data);
                })
            })
            $("#remove_one").click(function(){
                $.post('<?php echo Helper::url("test") ?>',{remove:true,id:$("#frid").val()},function(data){
                    console.log(data);
                })
            })
        })
    </script>