<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="modal fade" id="b-modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <a class="fa fa-github" href="{{ url('home/login/github') }}" title="github"></a>
                    <div class="fa fa-qq"></div>
                  </div>
              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
    