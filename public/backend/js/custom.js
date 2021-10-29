/*
*
* Created By : Pankaj Mathavadiya
* Created At : 2021-04-29
*
*/ 

$(document).ready(function() {
    $(".spin-icon").click(function () {
        if ($(".theme-config-box").hasClass('show')) {
            $(".theme-config-box").removeClass('show');
        } else {
            $(".theme-config-box").addClass('show');
        }
    });
    
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

	/* Search Form Ajax */
    var interval = 30;
	function start_auto_refresh() {
		add_refresh = setInterval(function(){ 
            $('#display_interval').html("("+interval+")");
            if(interval == 0){
                interval = 30;
                $('#auto-refresh').trigger('click');
            }else{
                interval--;
            } 
        }, 1000);
	}
	start_auto_refresh();

    $(document).on('click','#auto-refresh',function(){
        interval = 30;
        $('#search_form').trigger('submit');
    });
	/* Search Form Ajax */
	$(document).on('submit','#search_form',function(e){
		e.preventDefault();
        var form = $(this);
        $('#auto-refresh').attr('disabled',true);
		clearInterval(add_refresh);
        $('#load_content').addClass('sk-loading');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
            	start_auto_refresh();
                $('#auto-refresh').attr('disabled',false);
                $('#load_content').removeClass('sk-loading');
                $('#search_form button').attr('disabled',false);
                $('#search_form .fa-spin').addClass('d-none');
                if (response.status == 401) {
                    toastr.error('Something went wrong.');
                } else {
                    $('#load_content').html(response.html);
                }
            },
            error: function(){
                setTimeout(function(){
                    location.reload();
                },3000);
            	start_auto_refresh();
                $('#auto-refresh').attr('disabled',false);
                $('#load_content').removeClass('sk-loading');
                $('#search_form button').attr('disabled',false);
                $('#search_form .fa-spin').addClass('d-none');
                toastr.error('Something went wrong.');
            }
        });
	});

    $(document).on('click','#search_btn',function(){
        interval = 30;
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
        interval = 30;
        var page_number = $(this).attr('href').split('page=')[1];
        $('#page').val(page_number);
        $('#search_form').trigger('submit');
    });
	/* Change status query */
	$(document).on('click','.change_status',function(){
		var url = $(this).attr('data-url');
		var title = $(this).attr('data-title');
		var message = "You want to change this " + title + " status?";
		clearInterval(add_refresh);
        swal({
            title: "Are you sure?",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Change it!",
            closeOnConfirm: false
        }, function (isConfirm) {
            if(isConfirm){
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { _token: $('meta[name="csrf-token"]').attr("content") },
                    success: function (data) {
                        start_auto_refresh();
                        if (data.status == 200) {
                        	$('#search_form').trigger('submit');
                            swal({
                            	title: "Changed!",
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
                    	toastr.error('Something went wrong. Please try again.')
                    }
                });                
            }else{
            	start_auto_refresh();
            }
        });
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
            			start_auto_refresh();
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

    /*Preview Email Template*/
    $(document).on('click','.preview-email-template',function(){
        var id      = $(this).attr('data-id');
        var title   = $(this).attr("data-name");
        var url     = $(this).attr("data-url");
        $('#load_content').addClass('sk-loading');
        clearInterval(add_refresh);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                start_auto_refresh();
                $('#load_content').removeClass('sk-loading');
                if (response.status == 401) {
                    toastr.error('Something went wrong. Please try again sometime.');
                } else {
                    $("#preview-template-modal").modal("show");
                    $("#preview-content").empty();
                    $("#preview-template-modal .modal-title").text(
                        title + " Template Preview"
                        );
                    $("#preview-content").html(response.html);
                }
            },
            error: function(){
                start_auto_refresh();
                $('#load_content').removeClass('sk-loading');
                $('#search_form button').attr('disabled',false);
                $('#search_form .fa-spin').addClass('d-none');
                toastr.error('Something went wrong. Please try again sometime.');
            }
        });
    });

    $('#edit-modal-form').on('hidden.bs.modal', function () {
        $('#update_search_type_form').trigger('reset');
    });

    /* Check is unlimited */
    $(document).on('change','#unlimited',function(){
        if($(this).prop('checked') == true){
            $('#search_limit').attr('readonly',true).val(0);
        }else{
            $('#search_limit').attr('readonly',false);
        }
    });
    $(document).on('keyup','#search_limit',function(){
        if($(this).val().length > 0){
            $('#unlimited').prop('checked',false);
        }
    });
    $('#changepassword-modal').on('hidden.bs.modal', function () {
        location.reload();
    });
    $('#edit-modal-form').on('hidden.bs.modal', function () {
        $("#load-modal").empty();
    });

    $(document).on('click','.update-search-type',function(){
        var url = $(this).data('url');
        var id  = $(this).data('id');
        $('.update-search-type button').attr('disabled',true);
        $('.'+id).removeClass('fa-pencil').addClass('fa-spin fa-spinner');
        clearInterval(add_refresh);
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('.update-search-type button').attr('disabled',false);
                $('.'+id).removeClass('fa-spin fa-spinner').addClass('fa-pencil');
                start_auto_refresh();
                $('#load_content').removeClass('sk-loading');
                if (response.status == 401) {
                    toastr.error('Something went wrong.');
                } else {
                    $("#load-modal").empty().html(response.html);
                    $('#edit-modal-form').modal('show');
                }
            },
            error: function(){
                $('.update-search-type button').attr('disabled',false);
                $('.'+id).removeClass('fa-spin fa-spinner').addClass('fa-pencil');
                start_auto_refresh();
                $('#load_content').removeClass('sk-loading');
                toastr.error('Something went wrong. Please try again sometime.');
            }
        });
    });
});