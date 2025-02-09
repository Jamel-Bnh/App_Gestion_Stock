<?php require 'myheader.php'; ?>
<title>Page non autorisé</title>


<div class="container mt-5">
    <div class="row">

   <center> <img style="width: 300px;" src="assets/img/stop.png"/></center>

    <center class="text-danger " >vous n'avez pas l'autorisation d'accéder à cette page</center>
    <center><a href="index.php">Retour</a></center>
 

    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
       $('document').ready(function(){
        var cur_tit=$(this).attr('title');
        $('.thetitle').html(cur_tit);
    })
</script>