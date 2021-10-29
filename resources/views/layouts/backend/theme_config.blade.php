<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-settings">
            <div class="title">Configuration <br></div>
            <div class="setings-item default-skin">
                <span class="skin-name ">
                    <a href="#" class="s-skin-0" data-toggle="modal" data-target="#changepassword-modal">
                        Change Password
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>


<!--Add/Update Status Modal--> 
<div class="modal inmodal" id="changepassword-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            {!! Form::open(['route'=>['admin.change_password'],'id'=>'changepassword-form'])!!}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Old Password: <span class="input-required">*</span></label> 
                        {{ Form::password('oldpassword', ['class' => 'form-control','placeholder' => 'Enter old password','id'=>'oldpassword']) }}                     
                        <i class="fa fa-eye togglePassword" toggle="#oldpassword"></i>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>New Password: <span class="input-required">*</span></label> 
                        {{ Form::password('password', ['class' => 'form-control','id'=>'password','placeholder' => 'Enter new password']) }}                        
                        <i class="fa fa-eye togglePassword" toggle="#password"></i>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Confirm Password: <span class="input-required">*</span></label> 
                        {{ Form::password('confirmpassword', ['class' => 'form-control','placeholder' => 'Enter confirm password','id'=>'confirmpassword']) }}                        
                        <i class="fa fa-eye togglePassword" toggle="#confirmpassword"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit-button">Change now</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!--End-->