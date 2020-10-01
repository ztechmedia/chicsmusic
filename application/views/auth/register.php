<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-logo" style="height: 100px"></div>
        <div class="login-body">
            <div class="login-title"><strong>Registrasi Member</strong></div>
            <form action="javascript:(0)" class="form-horizontal auth-action"
                data-url="<?=base_url("auth/register")?>"
                data-btnclass=".register-btn"
                data-btnname="Kirim">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="name" id="name" type="text" class="form-control" placeholder="Name" />
                        <span class="help-block form-error" id="name-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" />
                        <span class="help-block form-error" id="email-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" />
                        <span class="help-block form-error" id="password-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="confirm" id="confirm" type="password" class="form-control" placeholder="Ulangi Password" />
                        <span class="help-block form-error" id="confirm-error"><span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                     
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block register-btn" type="submit">Kirim</button>
                    </div>
                </div>
                <div class="login-subtitle">
                    Sudah punya akun ? <a href="<?=base_url("login")?>"> Login</a>
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

<style>
    .login-container {
        height: 100vh;
    }
</style>