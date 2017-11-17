<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>Вход</h3>
    <hr />
    <div class="text-center hidden" id="login_result"></div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_form">
         <form action="<?php echo $host; ?>login/ajax" method="POST" id="login_form">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_tr">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <input type="text" name="user_login" class="form-control" placeholder="Логин" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_tr">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <input type="password" name="user_password" class="form-control" placeholder="Пароль" />
                </div>
            </div>
            <!--
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_tr">
                 <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="" value="" class="form-check-input">&nbsp;&nbsp;&nbsp;Запомнить меня
                        </label>
                    </div>
                </div>
            </div>
            -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_tr">
                <div class="col-lg-3 col-lg-offset-6 col-md-4 col-md-offset-6 col-sm-5 col-sm-offset-6 col-xs-12">
                    <input type="submit" class="form-control btn btn-success" name="login_submit" value="Войти" />
                </div>
            </div>
        </form>
    </div>
</div>