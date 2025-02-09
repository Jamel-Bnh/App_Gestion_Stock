<?php require 'myheader.php'; ?>
<title></title>


<div class="container">
    <div class="row">
 

    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html(cur_tit);
    })
</script>