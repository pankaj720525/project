$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "Space not allow.");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Only characters are allowed.");

    jQuery.validator.addMethod("check_email", function(value, element) {
        return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/i.test(value);
    }, "Please enter a valid email address.");

    $.validator.addMethod("pwcheck", function(value) {
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
    }, "The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Special Character, 1 Numeric Value.");

	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: 'slideDown',
		timeOut: 4000
	};

	$(".togglePassword").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});

    /* */
    $(document).on('click',".copy-to-clipboard",function () {
        var td = $(this).data("text");
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(td).select();
        document.execCommand("copy");
        $temp.remove();
        toastr.success('Copied successfully');
    });

    function copy_template(){
        $(document).on('click',"#copy-template",function () {
            var td = $(this).data("text");
            const el = document.createElement('textarea');
            el.value = td;
            document.getElementById('copy-template').appendChild(el);
            el.select();
            document.execCommand('Copy');
            document.getElementById('copy-template').removeChild(el);
            toastr.success('Copied successfully');
        });
    }

	/* Search Form Ajax */
	// function start_auto_refresh() {
	// 	auto_search = "True";
	// 	add_refresh = setInterval(function(){ auto_search = "True"; $('#search_form').trigger('submit'); }, 5000);
	// }
	// start_auto_refresh();

    var interval = 15;
    function start_auto_refresh() {
        add_refresh = setInterval(function(){
            $('#display_interval').html("("+interval+")");
            if(interval == 0){
                interval = 15;
                $('#auto-refresh').trigger('click');
            }else{
                interval--;
            }
        }, 1000);
    }
    start_auto_refresh();

    $(document).on('click','#auto-refresh',function(){
        $('#search_form').trigger('submit');
    });

	$(document).on('submit','#search_form',function(e){
        e.preventDefault();
        var form = $(this);
        interval = 15;
        clearInterval(add_refresh);
        $('#load_conent').addClass('sk-loading');
        $('#auto-refresh').attr('disabled',true);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                start_auto_refresh();
                $('#auto-refresh').attr('disabled',false);
                $('#load_conent').removeClass('sk-loading');
                $('#search_form button').attr('disabled',false);
                $('#search_form .fa-spin').addClass('d-none');
                if (response.status == 401) {
                    toastr.error('Something went wrong. Please try again sometime.');
                } else {
                    $('#load_conent').html(response.html);
                }
            },
            error: function(){
                toastr.error('Something went wrong.');
                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });
	});

    $(document).on('click','#search_btn',function(){
        $('#page').val('1');
        $('#form-orderbycolumn').val("");
        $('#form-orderby').val("");
        $('#search_form button').attr('disabled',true);
        $('#search_form .fa-spin').removeClass('d-none');
        $('#search_form').trigger('submit');
    });

    /*Ajax Pagination*/
    $(document).on('click','.custom-pagination a',function(e){
        e.preventDefault();
        if($(this).attr('href').split('perpage=')[1] == undefined){
            var page_number = $(this).attr('href').split('page=')[1];
        }else{
            var page_number = $(this).attr('href').split('page=')[2];
        }
        $('#page').val(page_number);
        $('#search_form').trigger('submit');
    });

    /* Search on change */
    $(document).on('keyup','.seach_on_change',function(){
        if($(this).val().length > 2 || $(this).val().length == 0){
            $('#page').val('1');
            $('#search_form').trigger('submit');
        }
    });

    $(document).on('change','.search-status',function(){
        $('#page').val('1');
        $('#search_form').trigger('submit');
    });

    $(document).on('change','#per_page',function(){
        $('#page').val('1');
        $('#search_form').trigger('submit');
    });

    /* Order by query */
	$(document).on('click','.orderby',function(){
		var column = $(this).attr('data-column');
		var orderby = $(this).attr('data-orderby');
		if(orderby == "asc"){
			orderby = "desc";
		}else{
			orderby = "asc";
		}
		$('#form-orderbycolumn').val(column);
		$('#form-orderby').val(orderby);
    	$('#search_form').trigger('submit');
	});

    /* Delete record query */
    $(document).on('click','.delete_record',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var title = $(this).attr('data-title');
        var message = "You want to delete this " + title + "?";
        clearInterval(add_refresh);
        swal({
            title: "Are you sure?",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if(isConfirm){
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: { _token: $('meta[name="csrf-token"]').attr("content") },
                    success: function (data) {
                        if (data.status == 200) {
                            $('#search_form').trigger('submit');
                            swal({
                                title: "Deleted!",
                                text: data.message,
                                type: "success",
                                timer: 3000
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: data.message,
                                type: "error",
                                timer: 3000
                            });
                        }
                    },
                    error: function(){
                        start_auto_refresh();
                        swal.close()
                        toastr.error('Something went wrong. Please try again sometime.')
                    }
                });
            }else{
                start_auto_refresh();
            }
        });
    });

    /* Duplicate record query */
    $(document).on('click','.duplicate_email_template',function(e){
        e.preventDefault();
        var url     = $(this).attr('href');
        var loader  = $(this).ladda();
            loader.ladda( 'start' );
        clearInterval(add_refresh);
        $.ajax({
            type: "POST",
            url: url,
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            success: function (data) {
                start_auto_refresh();
                loader.ladda('stop');
                if (data.status == 200) {
                    $('#search_form').trigger('submit');
                    toastr.success(data.message);
                } else {
                    $('#search_form').trigger('submit');
                    toastr.error(data.message);
                }
            },
            error: function(){
                start_auto_refresh();
                loader.ladda('stop');
                toastr.error('Something went wrong.');
            }
        });
    });

    /*Send Email*/
    $(document).on('click','.send-email',function(){
        var email = $(this).attr('data-email');
        $('#to_email').val(email);
        $('#send-mail-template').modal('show');
    });

    $(document).on('change','.email_template',function(){
        var $this = $(this);
        var id = $this.val();
        $('#send-email button[type="submit"]').attr("disabled", true );
        if(id == ""){
            $('#load-mail-content').html('');
            return;
        }
        $this.attr('disabled',true);
        $('#load-mail-content').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i></div>');
        $.ajax({
            url: Load_Mail_Template_URL,
            type: 'get',
            data: {'id' : id},
            success: function(response) {
                $('#load-mail-content').html('');
                $this.attr('disabled',false);
                if (response.status == 401) {
                    toastr.error('Something went wrong. Please try again sometime.');
                } else {
                    $('#load-mail-content').html(response.html);
                    $('.summernote').summernote();
                    $('.note-editable').css('height','200px');
                    $('#send-email button[type="submit"]').attr("disabled", false );
                }
            },
            error: function(){
                $this.attr('disabled',false);
                $('#load-mail-content').html('');
                toastr.error('Something went wrong.');
            }
        });
    });

    $('#send-mail-template').on('hidden.bs.modal', function () {
        $('#send-email').trigger('reset');
        $('#load-mail-content').html('');
    });

    var send_email_btn = $('#send-email button[type="submit"]').ladda();
    $("#send-email").validate({
        rules: {
            email_template_id:{
                required: true,
            },
            content:{
                required:  true
            }
        },
        messages: {
            email_template_id:{
                required: "Email template is required.",
            },
            content:{
                required: "Content is required.",
            }
        },
        submitHandler: function(form) {
            send_email_btn.ladda( 'start' );
            form.submit(); // submit the form
        }
    });

    /*Preview Email Template*/
    $(document).on('click','.preview-email-template',function(){
        var id      = $(this).attr('data-id');
        var title   = $(this).attr("data-name");
        var url     = $(this).attr("data-url");
        $('#load_conent').addClass('sk-loading');
        clearInterval(add_refresh);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                copy_template();
                start_auto_refresh();
                $('#load_conent').removeClass('sk-loading');
                if (response.status == 200) {
                    $("#preview-template-modal").modal("show");
                    $("#preview-content").empty();
                    $("#preview-template-modal .modal-title").text(
                        title + " Template Preview"
                        );
                    $("#preview-content").html(response.html);
                    $('#copy-template').attr('data-text',response.html);
                } else {
                    toastr.error('Something went wrong.');
                }
            },
            error: function(){
                start_auto_refresh();
                $('#load_conent').removeClass('sk-loading');
                $('#search_form button').attr('disabled',false);
                $('#search_form .fa-spin').addClass('d-none');
                toastr.error('Something went wrong.');
            }
        });
    });
})

   /*  */
$(document).on('click','.cancel_subscription',function(e){
    e.preventDefault();
    var url = $(this).data('url');
    var message = "After cancellation you can allow to search till your search limit should not me exceed."
    swal({
        title: "Are you sure want to cancel your subscription ?",
        text: message,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, cancel it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if(isConfirm){
            $.ajax({
                url: url,
                type: 'POST',
                success: function(response) {
                    swal.close();
                    console.log(response);
                    if (response.status == 'success') {
                        toastr.success('Your subscription plan has been cancelled.');
                    } else {
                        toastr.error(response.message);
                    }
                    setTimeout(function(){
                        window.location.href = response.url;
                    },3000);
                },
                error: function(){
                    swal.close();
                    toastr.error('Something went wrong.');
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }
            });
        }
    });
});
