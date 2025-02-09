<?php require 'myheader.php'; ?>
<title>Mes Demandes</title>


<div class="container">
    <div class="row">

        <div class="col-md-6">

            <table class="table table-striped">
                <thead class="th_info">
                    <tr>
                        <th>ID Demande</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action par</th>
                    </tr>
                </thead>
                <tbody id="my_tb">


                </tbody>
            </table>


            <div class="pagin w-100 d-flex justify-content-center align-items-center" style="background: #0077c0;">
                <i class="fas fa-chevron-left text-white" id="gtl" style="cursor: pointer;"></i>
                <input type="text" id='idx' style="width: 40px;margin-left:3px;text-align:center;background:#0077c0;border:#0077c0;color:#ffffff;" value="1">
                <input type="text" id='idy' style="width: 40px;margin-right:3px;text-align:center;background:#0077c0;border:#0077c0;color:#ffffff;">
                <i class="fas fa-chevron-right text-white " id="gtr" style="cursor: pointer;"></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dv_info iddemande">ID Demande </div>
            <table class="table table-striped">
            <thead>
                <th>Produit</th>
                <th>Quantité</th>
            </thead>
            <tbody id="tb_trshwo">

            </tbody>
        </table>
        </div>
       


    </div>
</div>





<?php require 'js_link.php'; ?>
<script>
    $('document').ready(function() {
        var cur_tit = $(this).attr('title');
        $('.thetitle').html(cur_tit);
        var idx = $('#idx').val();
        $.ajax({
            url: "databin.php",
            method: "POST",
            data: {
                "btn_act": "gtl",
                "idx": idx
            },
            success: function(respgtl0) {
                var respgtl = JSON.parse(respgtl0);
                $('#idy').val(respgtl['nb_pg']);
                $('#my_tb').html(respgtl['ctlg']);

                $('.trshow').click(function() {
                    var id_bon=this.id;
                    $('.iddemande').text("ID DEMANDE : "+this.id);
                    $.ajax({
                        url:"databin.php",
                        method:"POST",
                        data:{"btn_act":"trshow","id_bon":id_bon},
                        success:function(resp_trshow){
                            $('#tb_trshwo').html(resp_trshow);
                        }

                    })
                })
            }
        })
    })


    $('#gtl').click(function() {
        var idx = $('#idx').val();
        if (idx > 1) {
            idx--;
            $('#idx').val(idx);

            $.ajax({
                url: "databin.php",
                method: "POST",
                data: {
                    "btn_act": "gtl",
                    "idx": idx
                },
                success: function(respgtl0) {
                    var respgtl = JSON.parse(respgtl0);
                    $('#idy').val(respgtl['nb_pg']);
                    $('#my_tb').html(respgtl['ctlg']);
                }
            })
        }

    })

    $('#gtr').click(function() {
        var idx = $('#idx').val();
        var idy = $('#idy').val();
        if (idy > idx) {
            idx++;
            $('#idx').val(idx);
            $.ajax({
                url: "databin.php",
                method: "POST",
                data: {
                    "btn_act": "gtl",
                    "idx": idx
                },
                success: function(respgtl0) {
                    var respgtl = JSON.parse(respgtl0);
                    $('#idy').val(respgtl['nb_pg']);
                    $('#my_tb').html(respgtl['ctlg']);
                }
            })
        }

    })
</script>