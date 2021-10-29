var KTFormControls = (function() {

	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z," "]+$/i.test(value);
	}, "only characters are allowed.");

    jQuery.validator.addMethod("checkYoutubeLink", function(value, element) {
        return this.optional(element) || /^https:\/\/(?:www\.)?youtube.com\/watch\?(?=.*v=\w+)(?:\S+)?$/i.test(value);
    }, "Please enter only youtube link.");

    jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
    }, "Space not allow.");

    jQuery.validator.addMethod("check_email", function(value, element) {
        return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/i.test(value);
    }, "Please enter a valid email address.");

    $.validator.addMethod("pwcheck", function(value) {
        return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
    }, "The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Special Character, 1 Numeric Value.");

    var user_chanage_password_form = function() {
        $("#user-change-password-form").validate({
            // define validation rules
            rules: {
                password: {
                    required: true,
                    minlength: 3,
                    pwcheck:true,
                    noSpace: true
                },
                password_confirmation: {
                    required: true,
                    pwcheck:true,
                    equalTo: '#password',
                    noSpace: true
                },
            },
            messages:{
                password: {
                    required: "Password is required.",
                },
                password_confirmation: {
                    required: 'Confirm Password is required.',
                    equalTo: 'Password and Confirm Password does not match.'
                },
            },
            submitHandler: function(form) {
                $('#user-change-password-form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };

    var create_user = function() {
        $("#create_user_form").validate({
            // define validation rules
            rules: {
                first_name: {
                    required: true,
                    noSpace: true,
                    minlength: 3,
                    lettersonly: true,
                    maxlength: 20,

                },
                last_name: {
                    required: true,
                    noSpace: true,
                    minlength: 3,
                    lettersonly: true,
                    maxlength: 20,
                },
                email: {
                    required: true,
                    noSpace: true,
                    check_email: true,
                },
                plan: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 3,
                    pwcheck:true,
                    noSpace: true
                },
                password_confirmation: {
                    required: true,
                    pwcheck:true,
                    equalTo: '#password',
                    noSpace: true
                },
            },
            messages:{
            	first_name:{
            		required: "First Name is required.",
            		lettersonly: "Only alphabets character are allowed ."
            	},
                last_name:{
                    required: "Last Name is required.",
                    lettersonly: "Only alphabets character are allowed "
                },
                email: {
                    required: "Email address is required.",
                    email: "Enter valid email address.",
                    noSpace: "Space not allowed"
                },
                password: {
                    required: "Password is required.",
                },
                plan: {
                    required: "Subscription plan is required.",
                },
                password_confirmation: {
                    required: 'Confirm Password is required.',
                    equalTo: 'Password and Confirm Password does not match.'
                },
            },
            submitHandler: function(form) {
                $('#update_user_form button[type="submit"], a').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var update_user = function() {
        $("#update_user_form").validate({
            // define validation rules
            rules: {
                first_name: {
                    noSpace: true,
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                    lettersonly: true,
                },
                last_name: {
                    noSpace: true,
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                    lettersonly: true,
                }
            },
            messages:{
            	first_name:{
            		required: "First Name is required.",
                    lettersonly: "Only alphabets character are allowed ."
            	},
                last_name:{
                    required: "Last Name is required.",
                    lettersonly: "Only alphabets character are allowed ."
                }
            },
            submitHandler: function(form) {
                $('#update_user_form button[type="submit"], a').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var add_subscriptions = function() {
        $("#add_subscription_form").validate({
            // define validation rules
            rules: {
                package_name: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                description: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 250,
                },
                billing_period: {
                    required: true
                },
                billing_frequency: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    number: true
                },
                price: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 1,
                    maxlength: 15,
                    number: true,
                },
                search_limit: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    number: true,
                    required: true,
                    minlength: 1,
                    maxlength: 12,
                },
                no_of_result: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    number: true,
                    required: true,
                    minlength: 1,
                    maxlength: 5,
                    max:1000
                }
            },
            messages:{
                package_name:{
                    required: "Package Name is required."
                },
                description:{
                    required: "Description is required."
                },
                billing_period:{
                    required: "Billing Period is required."
                },
                billing_frequency:{
                    required: "Billing Frequency is required.",
                    number: "Allowed only numeric value."
                },
                price:{
                    required: "Price is required.",
                },
                search_limit: {
                    number: "Please enter only numeric value",
                    required: "Seach Limit is required",
                },
                no_of_result: {
                    number: "Please enter only numeric value",
                    required: "No of result is required",
                }
            },
            submitHandler: function(form) {
                $('#add_subscription_form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var update_subscriptions = function() {
        $("#update_subscription_form").validate({
            // define validation rules
            rules: {
                package_name: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                description: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 250,
                },
                billing_period: {
                    required: true
                },
                billing_frequency: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    number: true
                },
                price: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 1,
                    maxlength: 15
                },
                search_limit: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    number: true,
                    required: true,
                    minlength: 1,
                    maxlength: 12,
                },
                no_of_result: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    number: true,
                    required: true,
                    minlength: 1,
                    maxlength: 5,
                    max:1000
                }
            },
            messages:{
                package_name:{
                    required: "Package Name is required."
                },
                description:{
                    required: "Description is required."
                },
                billing_period:{
                    required: "Billing Period is required."
                },
                billing_frequency:{
                    required: "Billing Frequency is required.",
                    number: "Allowed only numeric value."
                },
                price:{
                    required: "Price is required.",
                },
                search_limit: {
                    number: "Please enter only numeric value",
                    required: "Seach Limit is required",
                },
                no_of_result: {
                    number: "Please enter only numeric value",
                    required: "No of result is required",
                }
            },
            submitHandler: function(form) {
                $('#update_subscription_form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var update_search_type = function() {
        $("#update_search_type_form").validate({
            // define validation rules
            rules: {
                name: {
                    required: true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    minlength: 3,
                    maxlength: 100
                },
                description: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 250
                }
            },
            messages:{
                name:{
                    required: "Name is required."
                },
                description: {
                    required: "Description is required."
                }
            },
            submitHandler: function(form) {
                $('#update_search_type_form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var chanage_password_form = function() {
        $("#changepassword-form").validate({
            // define validation rules
            rules: {
                oldpassword: {
                    required: true,
                    remote: {
                        url: CHECK_PASSWORD_URL,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        data: {
                            password: function()
                            {
                                return $('#oldpassword').val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    noSpace: true,
                    minlength: 3
                },
                confirmpassword: {
                    required: true,
                    noSpace: true,
                    equalTo: '#password'
                },
            },
            messages:{
                oldpassword: {
                    required: 'Old Password is required.',
                    remote: "Old Password does not matched."
                },
                password: {
                    required: "Password is required.",
                },
                confirmpassword: {
                    required: 'Confirm Password is required.',
                    equalTo: 'Password and Confirm Password does not match.'
                },
            },
            submitHandler: function(form) {
                $('#changepassword-form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var update_email_template = function() {
        $("#update_email_template").validate({
            // define validation rules
            rules: {
                title: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                },
                subject: {
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                },
                content: {
                    required: true,
                    normalizer: function( value ) {
                        return $.trim( value );
                    },
                },
            },
            messages:{
                title: {
                    required: "Title is required.",
                },
                subject: {
                    required: "Subject is required.",
                },
                content: {
                    required: "Content is required.",
                },
            },
            submitHandler: function(form) {
                if($('.summernote').summernote('isEmpty')){
                    $('#content-err').show();
                    return;
                }else{
                    $('#content-err').hide();
                }
                $('#update_email_template button[type="submit"]').attr(
                    "disabled",
                    true
                );
                $('#update_email_template a').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    var member_content = function() {
        $("#member_content_form").validate({
            // define validation rules
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                videolink: {
                    url: true,
                    checkYoutubeLink: true,
                },
                description: {
                    required: true,
                    minlength: 3,
                    maxlength: 500
                }
            },
            messages:{
                title: {
                    required: "Title is required.",
                },
                description: {
                    required: "Content is required.",
                }
            },
            submitHandler: function(form) {
                $('#member_content_form button[type="submit"]').attr(
                    "disabled",
                    true
                );
                $('#member_content_form a').attr(
                    "disabled",
                    true
                );
                form.submit(); // submit the form
            }
        });
    };
    return {
        // public functions
        init: function() {
            user_chanage_password_form();
            update_user();
            create_user();
            add_subscriptions();
            update_subscriptions();
            update_search_type();
            chanage_password_form();
            update_email_template();
            member_content();
        }
    };
})();

jQuery(document).ready(function() {
    KTFormControls.init();
});
