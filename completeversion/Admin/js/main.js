//runs all javascript methods 

main = {};

main.QuillEditor = "";
main.DefaultImgUpload = "../img/default.png";

$(function(){});

main.setInputFilter = function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}

//for normal quill
main.setQuillEditor = function setQuillEditor(uniqueId, placeHolder) {

    var toolbarOptions = [
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
    ];
    var options = {
        debug: "info",
        modules: {
            toolbar: toolbarOptions,
        },
        placeholder: placeHolder,
        theme: "snow",
    };
    main.QuillEditor = new Quill("." + uniqueId, options);
}

// for the advanced quill
main.setComplexQuillEditor = function setComplexQuillEditor(uniqueId, placeHolder) {
    var toolbarOptions = [

        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'font': [] }],
        ['blockquote'],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ["bold", "italic", "underline"],
        [{ list: "ordered" }, { list: "bullet" }],
        ['image'],
        ['clean'],

    ];
    var options = {
        debug: "info",
        modules: {
            toolbar: toolbarOptions,
        },
        placeholder: placeHolder,
        theme: "snow",
    };
    main.QuillEditor = new Quill("#" + uniqueId, options);
}

main.readURL = function readURL(input, uniqueId, imgName) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + uniqueId).attr('src', e.target.result);
            if (imgName != "") {
                var fileName = input.files[0].name;
                $('#' + imgName).val(fileName);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }

}

//get image from computer
main.BtnUploadImg = function BtnUploadImg(inputId) {
    var FileUpload = document.getElementById(inputId);
    FileUpload.click();
}

//remove image from webpage
main.BtnRemoveImg = function BtnRemoveImg(ImgSRC, inputId, imgFileName) {
    $("#" + ImgSRC).attr("src", main.DefaultImgUpload);
    $("#" + inputId).val(null);
    $("#" + imgFileName).val(null);
}

//create project
main.doAdd_EditProject = function(formId) {
    var quill = main.QuillEditor.root.innerHTML;

    var name = $("#name").val();
    var category = $("#category").val();
    var price = $("#price").val();
    var slug = $("#slug").val();
    var description = $("#description").val(quill);
    var photo1 = $("#productimage1").val();
    
    if (name == '') {
        alertify.error('Product Name is not Specified!');
        return;
    } else if (category == '') {
        alertify.error('Product Category is not Specified!');
        return;
    } else if (price == '') {
        alertify.error('Product Price is not Specified!');
        return;
    } else if (slug == '') {
        alertify.error('Product Slug is not Specified!');
        return;
    } else if (description == "<p><br></p>") {
        alertify.error('Product Description is not Specified!');
        return;
    } else if (photo1 == '') {
        alertify.error('Product Photo One is not Selected!');
        return;
    } else {
        $("#" + formId).submit();
    }
};
//delete project
main.doDeleteProduct = function(uniqueId, catidds) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Product",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            $.post('../system/controller/request_handler_post.php', {
                    namespace: 'deleteProduct',
                    id: uniqueId,
                    catid: catidds
                },
                function(result) {
                    //alert(result);
                    var suq = JSON.parse(result);

                    alertify.set({ delay: 10000 });
                    if (suq.response == true) {
                        alertify.set({ delay: 10000 });
                        alertify.success('Deleted successfully');
                        alertify.log('refreshing...');
                        window.location.href = suq.message;
                        location.reload();
                    } else {
                        alertify.error(suq.message);
                    }
                });

        } else {}
    });
}

//delete sale
function doDeleteSale(uniqueId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Sale record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            $.post('../system/controller/request_handler_post.php', {
                    namespace: 'deleteSale',
                    id: uniqueId
                },
                function(result) {
                    //alert(result);
                    var suq = JSON.parse(result);

                    alertify.set({ delay: 10000 });
                    if (suq.response == true) {
                        alertify.set({ delay: 10000 });
                        alertify.success('Deleted successfully');
                        alertify.log('refreshing...');
                        window.location.href = suq.message;
                        location.reload();
                    } else {
                        alertify.error(suq.message);
                    }
                });

        } else {}
    });
}


//delete user
function doDeleteUser(uniqueId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this User Data",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            $.post('../system/controller/request_handler_post.php', {
                    namespace: 'deleteUser',
                    id: uniqueId
                },
                function(result) {
                    //alert(result);
                    var suq = JSON.parse(result);

                    alertify.set({ delay: 10000 });
                    if (suq.response == true) {
                        alertify.set({ delay: 10000 });
                        alertify.success('Deleted successfully');
                        alertify.log('refreshing...');
                        window.location.href = suq.message;
                        location.reload();
                    } else {
                        alertify.error(suq.message);
                    }
                });

        } else {}
    });
}


// toogle settings
function toogleSettingTab(tabNum) {

    let tab1 = $("#lcp-body-tab1");
    let tab2 = $("#lcp-body-tab2");
    let tab3 = $('#lcp-body-tab3');
    let navtab1 = $('#lcp-nav-tab1');
    let navtab2 = $('#lcp-nav-tab2');

    if (tabNum === 1) {
        navtab2.removeClass("active");
        navtab1.addClass("active");
        tab1.removeClass("d-none");
        tab2.addClass("d-none");
        tab3.addClass("d-none");
    } else
    if (tabNum === 2) {
        navtab1.removeClass("active");
        navtab2.addClass("active");
        tab1.addClass("d-none");
        tab2.removeClass("d-none");
        tab3.addClass("d-none");
    } else if (tabNum === 3) {
        tab1.addClass("d-none");
        tab2.addClass("d-none");
        tab3.removeClass("d-none");
    }
}

// load the modal form
main.LoadTeamPopUpForm = function(purpose, uniqueId, date)
{
    $("#loader").removeClass("d-none");
    $("#loadTeamPopUpForm").addClass("d-none");

    if (purpose == "sale") 
    {
        $("#loadTeamPopUpForm").load("viewmodal.php?id=" + uniqueId + "&page=sale&saledate=" + date +"", function() {
            $("#loader").addClass("d-none");
            $("#loadTeamPopUpForm").removeClass("d-none");
        });
    }
    else if (purpose == "user") 
    {
        $("#loadTeamPopUpForm").load("viewmodal.php?id=" + uniqueId + "&page=user", function() {
            $("#loader").addClass("d-none");
            $("#loadTeamPopUpForm").removeClass("d-none");
        });
    }
}

/**
 * 
 * JQUERY AJAX METHODS
 * { AjaxOnBegin, AjaxOnSucess, AjaxOnComplete, AjaxOnfailure }
 * 
**/
main.AjaxOnAddingSucess = function AjaxOnSucess(result) {
    //alert(result);
    var suq = JSON.parse(result);

    alertify.set({ delay: 50000 });
    alertify.success('Added successfully');
    alertify.log('redirecting...');
    window.location.href = suq.message;
}
main.AjaxOnSettingAdded = function AjaxOnSettingAdded(result) {
   // alert(result);
    var suq = JSON.parse(result);

    alertify.set({ delay: 10000 });
    if (suq.response == true) {
        $('#teamFormModal').modal('hide');
        alertify.success('Added successfully');
        window.location.href = suq.message;
    } else {
        alertify.error(suq.message);
    }
}
main.AjaxOnSettingUpdate = function AjaxOnSettingUpdate(result) {
    //alert(result);
    var suq = JSON.parse(result);

    alertify.set({ delay: 10000 });
    if (suq.response == true) {
        $('#teamFormModal').modal('hide');
        alertify.success('Updated successfully');
        window.location.href = suq.message;
    } else {
        alertify.error(suq.message);
    }
}
main.AjaxOnUpdateSucess = function AjaxOnSucess(result) {
    var suq = JSON.parse(result);

    alertify.set({ delay: 50000 });
    alertify.success('Update successful');
    if (suq != "") {
        alertify.log('redirecting...');
        window.location.href = suq.message;
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