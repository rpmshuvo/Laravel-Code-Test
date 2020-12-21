@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-6">
                <fieldset>
                    <legend class="text-center">Create License</legend>
                    <div>
                        <table id="user_information" class="table table-bordered">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <form class="form-horizontal" method="post" action="{{ route('license.createLicense') }}">
                            <div class="form-group">
                                <label for="client_id">Client ID<span class="required_star">*</span></label>
                                <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Client ID" value="">
                                @if ($errors->has('client_id'))
                                    <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                        <p>{{ $errors->first('client_id') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="license_key">License Key<span class="required_star">*</span></label>
                                <input type="text" class="form-control" id="license_key" name="license_key" placeholder="License Key" value="" readonly>
                                @if ($errors->has('license_key'))
                                    <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                        <p>{{ $errors->first('license_key') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group text-center">
                                <a href="" class="btn btn-primary btn-block" id="save_key">Save</a>
                            </div>
                            <div class="form-group">
                                <label for="license_period">License For<span class="required_star">*</span></label>
                                <div class="form-inline">
                                    <select class="form-control col-lg-8" name="license_period" id="license_period">
                                        <option value="">Select License Period</option>
                                        <option value="1">3</option>
                                        <option value="6">6</option>
                                        <option value="12">12</option>
                                    </select>
                                    <span class="ml-3">
                                        Months
                                    </span> 
                                </div>
                                @if ($errors->has('license_period'))
                                    <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                        <p>{{ $errors->first('license_period') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group text-right">
                                <a href="" class="btn btn-primary" id="create_key">Create Key</a>
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

            // $('#save_key').on('click', function (e) {
            //     e.preventDefault();
                
            //     var client_id = $('#client_id').val();
            //     var license_key = $('#license_key').val();
            //     if (license_key != '' && client_id != '') {
                    
            //         $.ajax({
            //             type: "post",
            //             url: "license-store",
            //             data: {
            //                 'user_id'        : client_id,
            //                 'license_key' : license_key
            //             },
            //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //             dataType: "json",
            //             success: function (response) {
            //                 console.log(response);
            //                 if (response.success) {
            //                     alert(response.success);
            //                     location.reload();
            //                 }else{
            //                     alert('something went wrong');
            //                 }
            //             }
            //         });
                    

            //     }else if(license_key == '' && client_id != ''){
                   
            //         alert('Please Create License');

            //     }else if(license_key != '' && client_id == ''){
            //         alert('Give a client Id');
            //     }else if(license_key == '' && client_id == ''){
            //         alert('Give a client Id and Create License');
            //     }
                
            // });

            $('#create_key').on('click', function (e) {
                e.preventDefault();
                
                var client_id = $('#client_id').val();
                var license_period = $('#license_period').val();
                if (license_period != '' && client_id != '') {
                    
                    $.ajax({
                        type: "post",
                        url: "license",
                        data: {
                            'user_id'        : client_id,
                            'license_period' : license_period
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function (response) {
                            if (response.license_key != '') {
                                console.log(response.license_key);
                                $('#license_key').val(response.license_key);
                            }
                        }
                    });
                    

                }else if(license_period == '' && client_id != ''){
                   
                    alert('Please License Period');

                }else if(license_period != '' && client_id == ''){
                    alert('Give a client Id');
                }else if(license_period == '' && client_id == ''){
                    alert('Give a client Id and select License period');
                }
                
            });

        $('#client_id').keypress(function(event){
            if(event.keyCode == 13){

                var client_id = $('#client_id').val();
                $('#user_information tbody').html('');
                
                $.ajax({
                    type: "get",
                    url: "get-user-by-ajax",
                    data: {
                        'user_id' : client_id
                    },
                    dataType: "json",
                    success: function (response) {

                        if (!response.error) {

                            var user = `<tr>
                                        <td>First Name</td>
                                        <td>${response.first_name} </td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td>${response.last_name}</td>
                                    </tr>
                                    <tr>
                                        <td>Name of Organization</td>
                                        <td>${response.organization}</td>
                                    </tr>
                                    <tr>
                                        <td>Street</td>
                                        <td>${response.street}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>${response.city}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>${response.mobile_number}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>${response.email}</td>
                                    </tr>
                                    <tr>
                                        <td>license Key</td>
                                        <td>${response.license_key}</td>
                                    </tr>`;

                            $('#user_information tbody').append(user);
                            
                        } else {

                           var t = `<p class="text-center">${response.error}</p>`
                            $('#user_information tbody').append(t);
                        }
                    }
                });


            }
        });




        });
    </script>
@endsection