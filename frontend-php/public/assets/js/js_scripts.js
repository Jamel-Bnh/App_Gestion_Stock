$('.btn_clr').on('click', function(e) {
    e.preventDefault();
    $('#all_artcs').val("");
    $('#qnt_d').val("");
});
$('#all_artcs').on('change', function() {
    var artc = $('#all_artcs').val();
    $.ajax({

        url: "databin.php",
        method: "GET",
        dataType: "JSON",
        data: { "artc": artc, "btn_act": "artslc" },
        success: function(artc_info) {
            $('#qnt_d').val(artc_info['qnt_disp']);
        }
    })
});

$('.add_mag_btn').on('click', function(e) {
    e.preventDefault();
    var nwmag = $('#nwmag').val();
    var lpmag = $('#lpmag').val();
    $.ajax({

        url: "databinp.php",
        method: "POST",
        dataType: "JSON",
        data: { "nwmag": nwmag, "lpmag": lpmag, "btn_act_p": "addmag" },
        success: function(nwmag_resp) {
            alert(nwmag_resp['msg']);

            $('#nwmag').val("");
            $('#lpmag').val("");
            $('.tb_mag').html(nwmag_resp['lst_mag']);

        }
    })

})

/*$('.d_mag').on('click', function() {
    var d_id = (this.id);
    $.ajax({

        url: "databinp.php",
        method: "POST",
        dataType: "JSON",
        data: { "d_id": d_id, "btn_act_p": "d_mag" },
        success: function(d_resp) {
            alert(d_resp['msg']);
            $('.tb_mag').html(d_resp['lst_mag']);


        }
    })
});
$('.b_mag').on('click', function() {
    alert(this.id);
});
*/

$('.add_item_btn').on('click', function(e) {
    e.preventDefault();
    var it_add = $('#nwitem').val();
    $.ajax({

        url: "databinp.php",
        method: "POST",
        // dataType: "JSON",
        data: { "it_add": it_add, "btn_act_p": "add_itm" },
        success: function(it_resp) {
            alert(it_resp)


        }
    })
})

$('.add_ctg_btn').on('click', function(e) {
    e.preventDefault();
    var ctg_add = $('#nwctg').val();

    $.ajax({

        url: "databinp.php",
        method: "POST",
        // dataType: "JSON",
        data: { "ctg_add": ctg_add, "btn_act_p": "add_ctg" },
        success: function(ctg_resp) {
            alert(ctg_resp)
        }
    })
})

$('#slc_item').on('change', function(e) {
    e.preventDefault();
    var slc_inp = $('#slc_item').val();
    $.ajax({

        url: "databinp.php",
        method: "POST",
        // dataType: "JSON",
        data: { "slc_inp": slc_inp, "btn_act_p": "slc_lst" },
        success: function(inp_resp) {
            $('.tab_rsl').html(inp_resp);
        }
    })
})

$('.del_item_btn').on('click', function(e) {
    e.preventDefault();
    $('#nwitem').val("");
})

$('.del_ctg_btn').on('click', function(e) {
    e.preventDefault();
    $('#nwctg').val("");
})