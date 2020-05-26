@extends('layouts.public.home')

@include('layouts.home.public.head')



<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title login-title" id="myModalLabel">
                    无需注册,登陆第三方账号即可
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
              <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12 login-icon" > 
                    <a class="fa fa-github" href="{{ url('home/login/github') }}" alt="GitHub" title="给他哈勃"></a>
                    <!-- <div class="fa fa-qq" title="QQ"></div> -->
                  </div>
              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>