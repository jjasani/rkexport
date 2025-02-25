function resetdata() {

    $("#company_div").removeClass("has-error is-focused");
    $("#email_div").removeClass("has-error is-focused");

    if (ACTION == 1) {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    } else {
        $('#company_div').val('');
        $('#companyname').val('');
        $('#email').val('');
        $('#email_div').val('');
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    }

    if(MODALVIEW == 0){
        $('html, body').animate({scrollTop:0},'slow');  
    }
}

function checkvalidationcompany(addtype = 0) {

    var companyname = $('#companyname').val().trim();
    var email = $('#emailid').val().trim();

  
    var isvalidcompanyname = isvalidemail = 0;

    PNotify.removeAll();
    if (companyname == '') {
        $("#company_div").addClass("has-error is-focused");
        new PNotify({ title: 'Please enter company !', styling: 'fontawesome', delay: '3000', type: 'error' });
        isvalidcompanyname = 0;
    } else {
        $("#company_div").removeClass("has-error is-focused");
        isvalidcompanyname = 1;
    }


    if (email == '') {
        $("#email_div").addClass("has-error is-focused");
        new PNotify({ title: 'Please enter email address !', styling: 'fontawesome', delay: '3000', type: 'error' });
        isvalidemail = 0;
    } else {
        if (!ValidateEmail(email)) {
            $("#email_div").addClass("has-error is-focused");
            new PNotify({ title: 'Please enter valid email address !', styling: 'fontawesome', delay: '3000', type: 'error' });
            isvalidemail = 0;
        } else {
            isvalidemail = 1;
        }
    }


   

    if (isvalidcompanyname == 1 && isvalidemail) {

        var formData = new FormData($('#addcompanyform')[0]);
        if (ACTION == 0) {
            var uurl = SITE_URL + "Company/company_add";

            $.ajax({
                url: uurl,
                type: 'POST',
                data: formData,
                //async: false,
                beforeSend: function() {
                    $('.mask').show();
                    $('#loader').show();
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data['error'] == 1) {
                        new PNotify({ title: "Company successfully added.", styling: 'fontawesome', delay: '3000', type: 'success' });
                        if(MODALVIEW == 1){
                            resetdata();
                            $("#addcompanyModal").modal("hide");
                            $("#companyid option").first().after("<option value='"+data['cid']+"' selected>"+data['cname']+"</option>");
                            $("#companyid").selectpicker('refresh');
                         
                        }else{
                            if(addtype==1){
                                resetdata();
                            }else{
                                setTimeout(function() { window.location = SITE_URL + "Company";}, 500);
                            }
                        }

                    } else if (data['error'] == 2) {
                        new PNotify({ title: 'Company already exists !', styling: 'fontawesome', delay: '3000', type: 'error' });
                    } else if (data['error'] == 3) {
                        new PNotify({ title: data['message'], styling: 'fontawesome', delay: '3000', type: 'error' });
                    } else if (data['error'] == 4) {
                        new PNotify({ title: 'This rights not available in portal !', styling: 'fontawesome', delay: '3000', type: 'error' });
                    } else {
                        new PNotify({ title: 'Company not added !', styling: 'fontawesome', delay: '3000', type: 'error' });
                    }
                },
                error: function(xhr) {
                    //alert(xhr.responseText);
                },
                complete: function() {
                    $('.mask').hide();
                    $('#loader').hide();
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {
            var uurl = SITE_URL + "Company/update_company";

            $.ajax({
                url: uurl,
                type: 'POST',
                data: formData,
                //async: false,
                beforeSend: function() {
                    $('.mask').show();
                    $('#loader').show();
                },
                success: function(response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    if (data['error'] == 1) {
                        new PNotify({ title: "successfully updated.", styling: 'fontawesome', delay: '1500', type: 'success' });
                        setTimeout(function() { window.location = SITE_URL + "Company"; }, 1500);
                    } else if (data['error'] == 3) {
                        new PNotify({ title: data['message'], styling: 'fontawesome', delay: '3000', type: 'error' });
                    } else if (data['error'] == 4) {
                        new PNotify({ title: 'This rights not available in portal !', styling: 'fontawesome', delay: '3000', type: 'error' });
                    } else {
                        new PNotify({ title: 'Company not updated !', styling: 'fontawesome', delay: '3000', type: 'error' });
                    }
                },
                error: function(xhr) {
                    //alert(xhr.responseText);
                },
                complete: function() {
                    $('.mask').hide();
                    $('#loader').hide();
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }
}