@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">重置密码</div>

                    <div class="panel-body">
                        <form class="form-horizontal" onclick="return false;">
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">请输入新密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"  required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">请再次确认新密码</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="submit" alt="{{ $user->id }}">
                                        确认
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#submit').bind('click',setPassword);



        });

        function setPassword() {
            var password = $('#password').val();
            var password_confirmation = $('#password-confirm').val();
            var user_id = $(this).attr('alt');

            console.log(password);
            console.log(password_confirmation);

            if((!password) || (!password_confirmation)){
                alert('密码为空');
                return;
            }
            if(password != password_confirmation){
                alert('两次密码不相同');
                return;
            }

            var url = "{{ url('') }}"+"/users/reset/"+user_id;
            $.post(url,{ password : password},function(result){
                if(result.code == 0){
                    window.location.href =  "{{ url('orders') }}";
                }else{
                    alert(result.message);
                }
            });
        }


    </script>
@endpush
