//runs all javascript methods 

main = {};

$(function(){});

// load the modal form
main.LoadProductModal = function(uniqueId) 
{
    $("#loader").removeClass("d-none");
    $("#loadTeamPopUpForm").addClass("d-none");
   
    $("#loadTeamPopUpForm").load("zpopupmodal.php?id=" + uniqueId, function() {
        $("#loader").addClass("d-none");
        $("#loadTeamPopUpForm").removeClass("d-none");
    });
}

//products - cart
function docart(pid, action, quantity)
{
    if(quantity <= 1 && action == "updateCartMinus")
    {
        return;
    }
    else
    {
        $.post('system/controller/userRequest_handler_get.php', {
            namespace: action,
            id: pid
        },
        function(result) 
        {
            updateDiv();
            getCartItems();
            // alert(result);
            var suq = JSON.parse(result);

            alertify.set({ delay: 10000 });
            if (suq.response == true) 
            {
                if(suq.message != "")
                {
                    alertify.success(suq.message);
                }
            } 
            else 
            {
                alertify.error(suq.message);
            }
        });
    }
}

function updateDiv()
{
    $( "#cartdiv" ).load(window.location.href + " #cartdiv" );
    $( "#topcartdiv" ).load(window.location.href + " #topcartdiv" );
    $( "#reloaddiv" ).load(window.location.href + " #reloaddiv");
    // $( "#ordersummary" ).load(window.location.href + " #ordersummary");
}

function getCartItems()
{
    $.post('system/controller/userRequest_handler_get.php', {
        namespace: "getSession"
    },
    function(result) 
    {
        var suq = JSON.parse(result);
        document.getElementById("topcartcount").innerHTML = suq.message;
        document.getElementById("topcartcount2").innerHTML = suq.message;
    });
}

function addbillingdetails(formId)
{
    var fullname = $("#fullname").val();
    var email = $("#email").val();
    var apassword = $("#apassword").val();
    var address = $("#address").val();
    var town_city = $("#town_city").val();
    var country = $("#country").val();
    var zipcode = $("#zipcode").val();
    var aconfrimpassword = $("#aconfrimpassword").val();
    const cb = document.querySelector('#acceptterms');
    //var contact_info = $("#contact_info").val();
    
    if (fullname == '') 
    {
        alertify.error('Full Name is not Specified!');
        return;
    } 
    else if (email == '') 
    {
        alertify.error('Email is not Specified!');
        return;
    }
    else if (apassword == '') 
    {
        alertify.error('Password is not Specified. Unless you have an account already, account password is needed');
        return;
    }
    else if (address == '') 
    {
        alertify.error('Address is not Specified!');
        return;
    } 
    else if (town_city == '') 
    {
        alertify.error('Town / City is not Specified!');
        return;
    } 
    else if (country == "") 
    {
        alertify.error('Country is not Specified!');
        return;
    } 
    else if (zipcode == '') 
    {
        alertify.error('Postcode / ZIP is not Specified!');
        return;
    }
    else if(aconfrimpassword == '')
    {
        alertify.error('Confrimation Password is not Specified!');
        return;
    }
    else if(cb.checked == false)
    {
        alertify.error('Accept Privacy and Policy');
        return;
    }
    // else if (contact_info == '') 
    // {
    //     alertify.error('Mobile Number is not Specified!');
    //     return;
    // }
    else
    {
        if (aconfrimpassword !== apassword) 
        {
            alertify.error('Password does not Match!');
            return;
        }
        else 
        {
            $("#" + formId).submit();
        }
    }
}

function updatebillingdetails(formId)
{
    var fullname = $("#fullname").val();
    var email = $("#email").val();
    var address = $("#address").val();
    var town_city = $("#town_city").val();
    var country = $("#country").val();
    var zipcode = $("#zipcode").val();
    //var contact_info = $("#contact_info").val();

    //check terms and agreement if is checked
    const cb = document.querySelector('#acceptterms');

    if (fullname == '') 
    {
        alertify.error('Full Name is not Specified!');
        return;
    } 
    else if (email == '') 
    {
        alertify.error('Email is not Specified!');
        return;
    } 
    else if (address == '') 
    {
        alertify.error('Address is not Specified!');
        return;
    } 
    else if (town_city == '') 
    {
        alertify.error('Town / City is not Specified!');
        return;
    } 
    else if (country == "") 
    {
        alertify.error('Country is not Specified!');
        return;
    }
    else if (zipcode == '') 
    {
        alertify.error('Postcode / ZIP is not Specified!');
        return;
    }
    else if(cb.checked == false)
    {
        alertify.error('Accept Privacy and Policy');
        return;
    }
    // else if (contact_info == '') 
    // {
    //     alertify.error('Mobile Number is not Specified!');
    //     return;
    // }
    else 
    {
        $("#" + formId).submit();
    }
}

function changePassword()
{
    var apassword = $("#apassword").val();
    var aconfrimpassword = $("#aconfrimpassword").val();
    var id = $("#userid").val();
    
    if (apassword == '') 
    {
        alertify.error('Password is not Specified!');
        return;
    }
    else if(aconfrimpassword == '')
    {
        alertify.error('Confrimation Password is not Specified!');
        return;
    }
    else
    {
        if (aconfrimpassword !== apassword) 
        {
            alertify.error('Password does not Match!');
            return;
        }
        else 
        {
            $.post('system/controller/userRequest_handler_get.php', {
                namespace: "changePassword",
                password: apassword,
                id: id
            },
            function(result) 
            {
                var suq = JSON.parse(result);

                if (suq.response == true) 
                {
                    if(suq.message != "")
                    alertify.success(suq.message);
                } 
                else
                {
                    alertify.error(suq.message);
                }
            });
        }
    }
}

function registerUser(formId)
{
    var username = $("#username").val();
    var email = $("#fullname").val();
    var password = $("#password").val();
    var confrimpassword = $("#confrimpassword").val();

    if (username == '') 
    {
        alertify.error('Username is not Specified!');
        return;
    }
    else if (email == '') 
    {
        alertify.error('Email is not Specified!');
        return;
    }
    else if (password == '') 
    {
        alertify.error('Password is not Specified!');
        return;
    }
    else if (confrimpassword == '') 
    {
        alertify.error('Confirm Password feild is Empty!');
        return;
    }
    else
    {
        if (confrimpassword !== password) 
        {
            alertify.error('Password does not Match!');
            return;
        }
        else 
        {
            $("#" + formId).submit();
        }
    }
}

function loginUser(page)
{
    var email = $("#loginemail").val();
    var password = $("#loginpassword").val();    
   
    if (email == '') 
    {
        alertify.error('Email is not Specified!');
        return;
    }
    else if (password == '') 
    {
        alertify.error('Password is not Specified!');
        return;
    }
    else
    {
        $.post('system/controller/userRequest_handler_get.php', {
            namespace: "login",
            email: email,
            password: password,
            id: ""
        },
        function(result) 
        {
            var suq = JSON.parse(result);
    
            alertify.set({ delay: 500000 });
            if (suq.response == true) 
            {
                if(suq.message != "")
                alertify.set({ delay: 500000 });
                alertify.success(suq.message);
                window.location.href = page+".php";
            } 
            else 
            {
                alertify.error(suq.message);
            }
        });
    }
}

function userResetPassword()
{
    var email = $("#resetloginemail").val();
   
    if (email == '') 
    {
        alertify.error('Email is not Specified!');
        return;
    }
    else
    {
        $.post('system/controller/userRequest_handler_get.php', {
            namespace: "passwordreset",
            email: email,
            id: ""
        },
        function(result) 
        {
            var suq = JSON.parse(result);
    
            alertify.set({ delay: 10000 });
            if (suq.response == true) 
            {
                if(suq.message != "")
                alertify.success(suq.message);
                document.getElementById("displaymsg").innerHTML = suq.message;
            } 
            else 
            {
                alertify.error(suq.message);
            }
        });
    }
}


/**
 * 
 * JQUERY AJAX METHODS
 * { AjaxOnBegin, AjaxOnSucess, AjaxOnComplete, AjaxOnfailure }
 * 
**/
main.AjaxOnAddingSucess = function AjaxOnSucess(result) 
{
    //alert(result);
    var suq = JSON.parse(result);

    if (suq.response == true) 
    {
        //alertify.set({ delay: 90000 });
        alertify.success(suq.message);
    }
    else
    {
        alertify.error(suq.message);
    }
}

main.AjaxOnAddingSucess2 = function AjaxOnSucess(result) 
{
    //alert(result);
    var suq = JSON.parse(result);

    if (suq.response == true) 
    {
        //alertify.set({ delay: 90000 });
        alertify.success(suq.message+"madd1");
    }
    else
    {
        alertify.error(suq.message);
    }
}

main.AjaxOnSettingAdded = function AjaxOnSettingAdded(result) {
    // alert(result);
    var suq = JSON.parse(result);

    alertify.set({ delay: 10000 });
    if (suq.response == true) 
    {
        $('#teamFormModal').modal('hide');
        alertify.success('Added successfully');
        //window.location.href = suq.message;
    } else {
        alertify.error(suq.message);
    }
}
main.AjaxOnSettingUpdate = function AjaxOnSettingUpdate(result) {
    alert(result);
    var suq = JSON.parse(result);

    alertify.set({ delay: 10000 });
    if (suq.response == true) 
    {
        $('#teamFormModal').modal('hide');
        alertify.success('Updated successfully');
        //window.location.href = suq.message;
    } 
    else
    {
        alertify.error(suq.message);
    }
}
main.AjaxOnUpdateSucess = function AjaxOnSucess(result) {
    var suq = JSON.parse(result);

    alertify.set({ delay: 50000 });
    alertify.success('Update successful');
    if (suq != "")
    {
        alertify.log('redirecting...');
        //window.location.href = suq.message;
    }
}
main.AjaxOnComplete = function AjaxOnComplete() {
    $('#btn-loader').addClass('d-none');
    $('#btn-text').removeClass('d-none');
    $("#btn-create").removeAttr("disabled");
}
main.AjaxOnBegin = function AjaxOnBegin() {
    $('#btn-loader').removeClass('d-none');
    $('#btn-text').addClass('d-none');
    $("#btn-create").attr("disabled", "true");
}
main.AjaxOnfailure = function AjaxOnfailure() {
    alertify.error("Task failed successfully (no comments).");
}
main.AjaxOnComplete2 = function AjaxOnComplete2() {
    $('#teambtn-loader').addClass('d-none');
    $('#teambtn-text').removeClass('d-none');
    $("#teambtn-create").removeAttr("disabled");
}
main.AjaxOnBegin2 = function AjaxOnBegin2() {
    $('#teambtn-loader').removeClass('d-none');
    $('#teambtn-text').addClass('d-none');
    $("#teambtn-create").attr("disabled", "true");
}


