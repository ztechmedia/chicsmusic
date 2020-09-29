<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-logo" style="height: 100px"></div>
        <div class="login-body">
            <div class="login-title"><strong>Log In</strong></div>
            <form action="javascript:(0)" class="form-horizontal auth-login" data-url="<?=base_url("auth/login")?>">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="email" id="email" type="text" class="form-control" placeholder="E-mail" />
                        <span class="help-block form-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" />
                        <span class="help-block form-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-link btn-block">Lupa Password ?</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block" type="submit">Login</button>
                    </div>
                </div>
                <div class="login-subtitle">
                    Belum punya akun ? <a href="#"> Buat Akun</a>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2020 Chic's Music
            </div>
        </div>
    </div>

</div>