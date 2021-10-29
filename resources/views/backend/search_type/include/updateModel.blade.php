{!! Form::open(['route' => ['searchtype.update',$id],'id'=>'update_search_type_form']) !!}
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" value="{{$search_type->name}}" class="form-control" id="update_name">
    </div>
    <div class="form-group">
        <label>Description</label>
        {{Form::textarea('description',$search_type->description,['class'=>'form-control','rows'=>'3','id'=>'update_description'])}}
    </div>
    <div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Update</strong></button>
    </div>
{!! form::close() !!}
<script type="text/javascript">
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
</script>