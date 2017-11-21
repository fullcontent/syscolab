<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo e(trans("crudbooster.page_title_login")); ?> : <?php echo e(Session::get('appname')); ?></title>
    <meta name='generator' content='CRUDBooster'/>
    <meta name='robots' content='noindex,nofollow'/>
    <link rel="shortcut icon" href="<?php echo e(CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png')); ?>">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo e(asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo e(asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- support rtl-->
    <?php if(App::getLocale() == 'ar'): ?>
      <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
      <link href="<?php echo e(asset("vendor/crudbooster/assets/rtl.css")); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel='stylesheet' href='<?php echo e(asset("vendor/crudbooster/assets/css/main.css")); ?>'/>
    <style type="text/css">
      .login-page, .register-page {
          background: <?php echo e(CRUDBooster::getSetting("login_background_color")?:'#dddddd'); ?> url('<?php echo e(CRUDBooster::getSetting("login_background_image")?asset(CRUDBooster::getSetting("login_background_image")):asset('vendor/crudbooster/assets/bg_blur3.jpg')); ?>');
          color: <?php echo e(CRUDBooster::getSetting("login_font_color")?:'#ffffff'); ?> !important;
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
      }
      .login-box, .register-box {
        margin: 2% auto;
      }
      .login-box-body {
        box-shadow: 0px 0px 50px rgba(0,0,0,0.8);              
        background: rgba(255,255,255,0.9);
        color: <?php echo e(CRUDBooster::getSetting("login_font_color")?:'#666666'); ?> !important;
      }
      html,body {
        overflow: hidden;
      }
    </style>
  </head>

  <body class="login-page">

    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo e(url('/')); ?>">
            <img title='<?php echo (Session::get('appname') == 'CRUDBooster')?"<b>CRUD</b>Booster":CRUDBooster::getSetting('appname'); ?>' src='<?php echo e(CRUDBooster::getSetting("logo")?asset(CRUDBooster::getSetting('logo')):asset('vendor/crudbooster/assets/logo_crudbooster.png')); ?>' style='max-width: 100%;max-height:170px'/>
        </a>
      </div><!-- /.login-logo -->      
      <div class="login-box-body">
	  
    		<?php if( Session::get('message') != '' ): ?>
        		<div class='alert alert-warning'>
        			<?php echo e(Session::get('message')); ?>

        		</div>	
    		<?php endif; ?> 
		
        <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme a Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar e Logar
                                </button>
                            </div>
                        </div>
                    </form>
        
        

		<br/>
        <!--a href="#">I forgot my password</a-->

      </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->



    <!-- jQuery 2.1.3 -->
    <script src="<?php echo e(asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo e(asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script> 
  </body>
</html>