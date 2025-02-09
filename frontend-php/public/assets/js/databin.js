// ---- demande script

$(".clrinp").on("click", function() {
    $("#inpprd").val("");
    $("#pr_in").val("");
});

$("#inpprd").on("change", function() {
    var inpprd = $("#inpprd").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "dem_artc",
            inpprd: inpprd,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_deminfo) {
        $("#tb_deminfo").html(resp_deminfo);
        var valslc = $("#dem_nmsr").val();
        if ($("#dem_nmsr").val() === "x" || $("#dem_nmsr").val() == " ") {
            $("#qnt_dem").prop("disabled", false);
            $("#qnt_dem").val(0);
        } else {
            $("#qnt_dem").prop("disabled", true);
            $("#qnt_dem").val(1);
        }
    });
});

// end demande script

$("#add_mag").on("click", function(e) {
    e.preventDefault();
    var nwmag = $("#nwmag").val();
    var lcmag = $("#lcmag").val();
    var descmag = $("#descmag").val();
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "add_mag",
            nwmag: nwmag,
            lcmag: lcmag,
            descmag: descmag,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_add_mag) {
        alert(resp_add_mag);
    });
});

// ---------------------

/*$('.add_stckg').on('click', function(e) {
    e.preventDefault();
    var magp = $('#magp').val();
    var arm_mag = $('#arm_mag').val();
    var et_mag = $('#et_mag').val();
    var loc_mag = $('#loc_mag').val();
    var desc_mag = $('#desc_mag').val();
    var settings = {
        "url": "databin.php",
        "data": { "btn_act": "add_stckg", "magp": magp, "arm_mag": arm_mag, "et_mag": et_mag, "loc_mag": loc_mag, "desc_mag": desc_mag },
        "method": "POST",

    };

    $.ajax(settings).done(function(resp_add_stck) {
        alert(resp_add_stck);
        $('#magp').val("");
        $('#arm_mag').val("");
        $('#et_mag').val("");
        $('#loc_mag').val("");
        $('#desc_mag').val("");
    });
})*/

$(".add_stckg").on("click", function(e) {
    e.preventDefault();
    var magp = $("#magp").val();
    var arm_mag = $("#arm_mag").val();
    var nbet = $("#nbet").val();
    var loc_mag = $("#loc_mag").val();
    var desc_mag = $("#desc_mag").val();

    //----
    var long_et = $("#long_et").val();
    var lrg_et = $("#lrg_et").val();
    var ht_et = $("#ht_et").val();
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "add_stckg",
            magp: magp,
            arm_mag: arm_mag,
            nbet: nbet,
            loc_mag: loc_mag,
            desc_mag: desc_mag,
            long_et: long_et,
            lrg_et: lrg_et,
            ht_et: ht_et,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_add_stck) {
        alert(resp_add_stck);
        $("#magp").val("");
        $("#arm_mag").val("");
        $("#nbet").val("");
        $("#loc_mag").val("");
        $("#desc_mag").val("");
        $("#long_et").val("");
        $("#lrg_et").val("");
        $("#ht_et").val("");
    });
});

//---------------------
$("#add_ctg").on("click", function(e) {
    e.preventDefault();

    var nwctg = $("#nwctg").val();
    var desc_ctg = $("#descmag").val();
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "addctg",
            nwctg: nwctg,
            desc_ctg: desc_ctg,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_add_stck) {
        alert(resp_add_stck);
        $("#nwctg").val("");
        $("#descmag").val("");
    });
});

// ---------------------------

/*$('#add_pr').on('click', function(e) {
    e.preventDefault();
    var myfile = $('#img_pr').prop("files")[0];
    var img_pr = $('#img_pr').val();
    var settings = {
        "url": "databin.php",
        "data": {
            "btn_act": "add_pr",
            "myfile": myfile
        },
        "method": "POST",
    };

    $.ajax(settings).done(function(resp_add_pr) {
        alert(resp_add_pr);
    });
})*/

// -------------
$("#add_pr").click(function(e) {
    e.preventDefault();
    // Making the image file object
    var file = $("#img_pr").prop("files")[0];
    var docp = $("#doc_pr").prop("files")[0];

    var id_pr = $("#id_pr").val();
    var name_pr = $("#name_pr").val();
    var ctg_pr = $("#ctg_pr").val();
    var fbrq_pr = $("#fbrq_pr").val();
    var prix_pr = $("#prix_pr").val();
    var min_pr = $("#min_pr").val();
    var stck_pr = $("#stck_pr").val();
    var frns_pr = $("#frns_pr").val();
    var desc_pr = $("#desc_pr").val();
    var long_pr = $("#long_pr").val();
    var lrg_pr = $("#lrg_pr").val();
    var ht_pr = $("#ht_pr").val();
    var ref_pr = $("#ref_pr").val();

    // Making the form object
    var form = new FormData();

    // Adding the image to the form
    form.append("image", file);
    form.append("btn_act", "add_pr");
    form.append("docp", docp);
    form.append("id_pr", id_pr);
    form.append("name_pr", name_pr);
    form.append("ctg_pr", ctg_pr);
    form.append("fbrq_pr", fbrq_pr);
    form.append("prix_pr", prix_pr);
    form.append("min_pr", min_pr);
    form.append("stck_pr", stck_pr);
    form.append("frns_pr", frns_pr);
    form.append("desc_pr", desc_pr);

    form.append("long_pr", long_pr);
    form.append("lrg_pr", lrg_pr);
    form.append("ht_pr", ht_pr);
    form.append("ref_pr", ref_pr);

    // The AJAX call
    $.ajax({
        url: "databin.php",
        type: "POST",
        data: form,
        contentType: false,
        processData: false,
        success: function(result) {
            alert(result);
            location.reload();
            var name_pr = $("#name_pr").val("");
            var ctg_pr = $("#ctg_pr").val("");
            var fbrq_pr = $("#fbrq_pr").val("");
            var prix_pr = $("#prix_pr").val("");
            var min_pr = $("#min_pr").val("");
            var stck_pr = $("#stck_pr").val("");
            var frns_pr = $("#frns_pr").val("");
            var desc_pr = $("#desc_pr").val("");
            var desc_pr = $("#img_pr").val("");
            var desc_pr = $("#doc_pr").val("");
            var long_pr = $("#long_pr").val("");
            var lrg_pr = $("#lrg_pr").val("");
            var ht_pr = $("#ht_pr").val("");
        },
    });
});

// ----------

$(".inp_vlm").on("keyup", function() {
    var long_et = $("#long_et").val();
    var lrg_et = $("#lrg_et").val();
    var ht_et = $("#ht_et").val();

    var rslt = long_et * lrg_et * ht_et;

    $("#vlm_et").val(rslt.toFixed(2));
});

$(".slct").on("change", function() {
    $(".s_slct").css("display", "block");
    var slct_val = $(".slct").val();
    if (slct_val === "Magasin") {
        var settings = {
            url: "databin.php",
            data: {
                btn_act: "slct_s",
                slct_val: slct_val,
            },
            method: "POST",
        };

        $.ajax(settings).done(function(resp_slct) {
            $(".s_slct").html(resp_slct);
        });
    }

    if (slct_val === "Catégorie") {
        var settings = {
            url: "databin.php",
            data: {
                btn_act: "slct_s",
                slct_val: slct_val,
            },
            method: "POST",
        };

        $.ajax(settings).done(function(resp_slct) {
            $(".s_slct").html(resp_slct);
        });
    }
});
// btn left

// btn right

$(".gtrght").on("click", function() {
    var ind_ed = $("#ed_idx").val();
    var ind_cur = $("#bg_idx").val();
    if (ind_cur < ind_ed) {
        var bg_idx = parseInt($("#bg_idx").val(), 10);
        $("#bg_idx").val(bg_idx + 1);
        $("#bg_idx").change();
    }
});

$(".gtlft").on("click", function() {
    var ind_ed = $("#ed_idx").val();
    var ind_cur = $("#bg_idx").val();
    if (ind_cur > 1) {
        var bg_idx = parseInt($("#bg_idx").val(), 10);
        $("#bg_idx").val(bg_idx - 1);
        $("#bg_idx").change();
    }
});

$("#bg_idx").on("change", function() {
    var bg_idx = $("#bg_idx").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "gtrght",
            bg_idx: bg_idx,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_gtrght) {
        $("#tb_ctlg").html(resp_gtrght);

        //alert(resp_gtrght);
    });
});

// -------------------------

$("#ss_slct").on("change", function() {
    var lcprt = $(".slct").val();
    var s_mg = $("#ss_slct").val();
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "shpmg",
            lcprt: lcprt,
            s_mg: s_mg,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_shpmg) {
        $("#tb_ctlg").html(resp_shpmg);
        $("#nvpg").removeClass("d-flex");
        $("#nvpg").addClass("d-none");
    });
});

$("#pr_in").on("change", function() {
    var pr_in = $("#pr_in").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "pr_info_in",
            pr_in: pr_in,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_prin) {
        $(".prd_info_in").html(resp_prin);
        var id_inp = $(".id_inp").val();
        $("#iddd_pr").val(id_inp);
    });
});

$("#checknmsr").on("change", function() {
    if (this.checked) {
        $("#nmrsr").prop("disabled", false);
        $("#qnt_in").prop("disabled", true);
        $("#qnt_in").val(1);
        $("#nmrsr").val("");
    } else {
        $("#nmrsr").prop("disabled", true);
        $("#qnt_in").prop("disabled", false);
        $("#qnt_in").val("");
    }
});

$("#btn_stck_in").on("click", function() {
    var num_bon = $("#num_bon").val();
    var pr_in = $("#pr_in").val();
    var iddd_pr = $("#iddd_pr").val();
    var qnt_in = $("#qnt_in").val();
    var nmrsr = $("#nmrsr").val();
    var desc_pr_in = $("#desc_pr_in").val();
    var cmt_pr_in = $("#cmt_pr_in").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "stck_in",
            num_bon: num_bon,
            pr_in: pr_in,
            iddd_pr: iddd_pr,
            qnt_in: qnt_in,
            nmrsr: nmrsr,
            desc_pr_in: desc_pr_in,
            cmt_pr_in: cmt_pr_in,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_s_in) {
        alert(resp_s_in);
        if (resp_s_in === "success") {
            location.reload();
        }
    });
});

$("#slc_list").on("change", function() {
    var slc_list = $("#slc_list").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "listbon",
            slc_list: slc_list,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_listbon) {
        $(".tb_list").html(resp_listbon);

        $(".btn_in_print").on("click", function() {
            var id_bon = this.id;
            window.open("print_in.php?id_bon=" + id_bon);
        });
    });
});

$("#btn_addp").on("click", function() {
    var id_pr_info = $("#id_pr_info").val();
    var qnt_pr_info = parseInt($("#qnt_pr_info").text());
    var stckg_pr_info = $("#stckg_pr_info").text();
    var qnt_dem = $("#qnt_dem").val();
    var artc_dem = $("#artc_dem").text();
    var dem_nmsr = $("#dem_nmsr").val();

    if (qnt_dem == "" || qnt_dem == "") {
        alert("données manquantes");
    } else if (qnt_dem > qnt_pr_info) {
        alert("quantité insuffisante ");
    } else {
        //---------------------------------
        var settings = {
            url: "databin.php",
            data: {
                btn_act: "nw_pan",
                id_pr_info: id_pr_info,
                qnt_pr_info: qnt_pr_info,
                stckg_pr_info: stckg_pr_info,
                qnt_dem: qnt_dem,
                artc_dem: artc_dem,
                dem_nmsr: dem_nmsr,
            },
            method: "POST",
        };

        $.ajax(settings).done(function(resp_nw_pan) {
            if (resp_nw_pan === "success") {
                location.reload();
            } else if (resp_nw_pan === "dupartc") {
                alert("Article deja ajouté");
            }
        });

        //---------------------
    }
});

$(".del_item").on("click", function() {
    var del_id = this.id;
    var del_name = $(this).attr("name");

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "del_item",
            del_id: del_id,
            del_name: del_name,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_delitem) {
        if (resp_delitem === "success") {
            location.reload();
        } else {
            alert(resp_delitem);
        }
    });
});

$("#pan_accp").on("click", function() {
    var id_demd = $("#id_demd").val();
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "vald_dem",
            id_demd: id_demd,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_dem) {
        if (resp_dem === "success") {
            location.reload();
        }
    });
});

$("#pan_ref").on("click", function() {
    alert("refus");
});

$(".show_wreq").on("click", function() {
    var id_wdemd = this.id;
    var settings = {
        url: "databin.php",
        data: {
            btn_act: "show_wdem",
            id_wdemd: id_wdemd,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_wdem) {
        // $('#wdem_tb').html(resp_wdem);

        $("#mbdy").html(resp_wdem);

        $("#mdl1").modal("show");
    });
});

$(".accp_wreq").on("click", function() {
    var req_id = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "accp_req",
            req_id: req_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_accdem) {
        if (resp_accdem === "success") {
            location.reload();
        }
    });
});

$(".rfs_wreq").on("click", function() {
    var req_id = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "rfs_req",
            req_id: req_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_rfs) {
        if (resp_rfs === "success") {
            location.reload();
        }
    });
});

$("#sh_mypanier").on("click", function() {
    $("#mypan").modal("show");
});

var settings = {
    url: "databin.php",
    dataType: "JSON",
    data: {
        btn_act: "ctg_use",
    },
    method: "POST",
};

$("#btn_out").on("click", function(e) {
    e.preventDefault();
    var req_id = $("#id_dem_accp").val();

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "print_out",
            req_id: req_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_out) {
        $(".bd_out").html(resp_out);

        $(".btn_p").on("click", function(e) {
            e.preventDefault();

            window.open("bon_out.php?id_out=" + req_id);
        });
    });
});

$(".acc_ok").on("click", function() {
    var nw_user = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "nw_user_acc",
            nw_user: nw_user,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_nw_user) {
        if (resp_nw_user === "success") {
            location.reload();
        }
    });
});

$(".acc_ok").on("click", function() {
    var nw_user = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "nw_user_acc",
            nw_user: nw_user,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_nw_user) {
        if (resp_nw_user === "success") {
            location.reload();
        }
    });
});

$(".btn_rc_user").on("click", function() {
    var req_id = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "rc_user",
            req_id: req_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_rc_user) {
        if (resp_rc_user === "success") {
            location.reload();
        }
    });
});

$(".edit_usr").on("click", function() {
    var edit_id = this.id;

    var settings = {
        url: "databin.php",
        data: {
            btn_act: "edit_user",
            edit_id: edit_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(resp_edit_user) {
        $("#bd_mdl").html(resp_edit_user);
        $("#mdl2").modal("show");

        $('#cls_mdl').on('click', function() {
            $("#mdl2").modal("hide");
        })

        $('.edit_ok').on('click', function() {
            var edt_id = this.id;
            var user_divs = $('#user_divs').val();
            var user_role = $('#user_role').val();


            var settings = {
                url: "databin.php",
                data: {
                    btn_act: "user_stg",
                    edt_id: edt_id,
                    "user_divs": user_divs,
                    "user_role": user_role,

                },
                method: "POST",
            };

            $.ajax(settings).done(function(rsp_usr) {
                if (rsp_usr === "success") {
                    $("#mdl2").modal("hide");
                    location.reload();
                }

            });
        })
    });
});

$('.del_usr').on('click', function() {
    var del_id = this.id;



    var settings = {
        url: "databin.php",
        data: {
            btn_act: "delt_user",
            del_id: del_id,
        },
        method: "POST",
    };

    $.ajax(settings).done(function(delt_user) {
        if (delt_user === "success") {
            location.reload();
        }
    });

})

// ---- stat



// ----------------------------------------------------------------- index chart
// for ctg
/*
var settings = {
    url: "databin.php",
    dataType: "JSON",
    data: {
        btn_act: "ctg_use",
    },
    method: "POST",
};

$.ajax(settings).done(function(resp_ctg) {
    var ctg_info = resp_ctg["ctg_info"];
    var ctg_elc = resp_ctg["ctg_elc"];
    var ctg_res = resp_ctg["ctg_res"];

    const ctx = document.getElementById("ctg_use");
    const myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Informatique", "Electrique", "Telecom"],
            datasets: [{
                label: "",
                data: [ctg_info, ctg_elc, ctg_res],
                backgroundColor: ["#2155CD", "#F9D923", "#36AE7C"],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                ],
                borderWidth: 1,
            }, ],
        },
        options: {
            scales: {},
        },
    });
});




// for request status

var settings = {
    url: "databin.php",
    dataType: "JSON",
    data: {
        btn_act: "req_sts",
    },
    method: "POST",
};

$.ajax(settings).done(function(resp_sts) {
    var req_ok = resp_sts["req_ok"];
    var req_wt = resp_sts["req_wt"];
    var req_rfs = resp_sts["req_rfs"];

    const ctx1 = document.getElementById("req_sts");
    const myChart1 = new Chart(ctx1, {
        type: "pie",
        data: {
            labels: ["Accepté", "En attente", "Refusé"],
            datasets: [{
                label: "",
                data: [req_ok, req_wt, req_rfs],
                backgroundColor: ["#2155CD", "#F9D923", "#36AE7C"],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                ],
                borderWidth: 1,
            }, ],
        },
        options: {
            scales: {},
        },
    });
});

//-----------

var settings = {
    url: "databin.php",
    dataType: "JSON",
    data: {
        btn_act: "req_sts",
    },
    method: "POST",
};

$.ajax(settings).done(function(resp_sts) {
    var req_ok = resp_sts["req_ok"];
    var req_wt = resp_sts["req_wt"];
    var req_rfs = resp_sts["req_rfs"];

    const ctx2 = document.getElementById("mag");
    const myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: ["Accepté", "En attente", "Refusé"],
            datasets: [{
                label: "",
                data: [req_ok, req_wt, req_rfs],
                backgroundColor: ["#2155CD", "#F9D923", "#36AE7C"],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                ],
                borderWidth: 1,
            }, ],
        },
        options: {
            scales: {},
        },
    });
});*/

$('#clp1').on('click', function() {
    $('#collapse-2').attr("aria-expanded", "false")
})