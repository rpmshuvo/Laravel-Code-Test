@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-6">
                <fieldset>
                    <legend class="text-center">Enter License Key To Active</legend>
                    <form class="form-horizontal" method="post" id="license_active_form" action="{{ route('license.activeLicense') }}">
                            
                            <div class="form-group">
                                <label for="license_key">License Key<span class="required_star">*</span></label>
                                <input type="text" class="form-control" id="license_key" name="license_key" placeholder="License Key" value="">
                                @if ($errors->has('license_key'))
                                    <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                        <p>{{ $errors->first('license_key') }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group text-right">
                                <a class="btn btn-primary btn-block" type="submit" id="license_active_form_submit">Submit</a>
                            </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {

            $('#license_active_form_submit').on('click', function (e) {
                e.preventDefault();
                var license_key = $('#license_key').val();
                alert(license_key);
                if (license_key != '') {
                    
                    $.ajax({
                        type: "post",
                        url: "license-active",
                        data: {
                            'license_key' : license_key
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                alert(response.success+' ' +response.expire_date);
                                location.reload();
                            }else{
                                alert('something went wrong');
                            }
                        }
                    });
                    

                }else if(license_key == '' && client_id != ''){
                   
                    alert('Please Create License');

                }else if(license_key != '' && client_id == ''){
                    alert('Give a client Id');
                }else if(license_key == '' && client_id == ''){
                    alert('Give a client Id and Create License');
                }
                
            });
        });
    </script>
@endsection