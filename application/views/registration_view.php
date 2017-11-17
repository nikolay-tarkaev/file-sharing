<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <h3>Регистрация</h3>
    <hr />
    <div class="text-center hidden" id="registration_result"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_form">
        <form role="form" action="<?php echo $host; ?>registration/ajax" method="POST" id="registration_form">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs col-lg-offset-1 reg_td_left">
                    Имя *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="text" name="user_firstname" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1 reg_td_left">
                    Фамилия *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="text" name="user_lastname" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1 reg_td_left">
                    Логин *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="text" name="user_login" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1 reg_td_left">
                    E-mail *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="text" name="user_email" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1 reg_td_left">
                    Пароль *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="password" name="user_password" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1 reg_td_left">
                    Повторите пароль *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 reg_td_right">
                    <input type="password" name="user_confirm_password" class="form-control" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <hr />
            </div>
            <div class="col-lg-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 col-lg-offset-1 reg_td_left">
                    Пол *
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 col-xs-8 reg_td_right">
                    <div class="radio radio-primary">
                        <input type="radio" name="user_sex" id="radio_man" value="m">
                        <label for="radio_man">
                            Мужской
                        </label>
                    </div>
                    <div class="radio radio-primary">
                        <input type="radio" name="user_sex" id="radio_woman" value="w">
                        <label for="radio_woman">
                            Женский
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 col-lg-offset-1 reg_td_left">
                    Дата рождения
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 col-xs-8 reg_td_right">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <select name="user_day" class="form-control">
                            <option value="0">День</option>
                            <?php
                                for($d = 1; $d <= 31; $d++){
                                    echo "<option value=\"$d\">$d</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <select name="user_month" class="form-control">
                            <option value="0">Месяц</option>
                            <option value="1">Январь</option>
                            <option value="2">Февраль</option>
                            <option value="3">Март</option>
                            <option value="4">Апрель</option>
                            <option value="5">Май</option>
                            <option value="6">Июнь</option>
                            <option value="7">Июль</option>
                            <option value="8">Август</option>
                            <option value="9">Сентябрь</option>
                            <option value="10">Октябрь</option>
                            <option value="11">Ноябрь</option>
                            <option value="12">Декабрь</option>

                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <select name="user_year" class="form-control">
                            <option value="0">Год</option>
                            <?php
                                $year = date("Y");
                                for($y = $year; $y >= 1900; $y--){
                                    echo "<option value=\"$y\">$y</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-7 col-md-8 col-sm-8 col-xs-11 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-1  reg_notes">
                    * - обязательные для заполнения поля
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <hr />
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 reg_tr">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-offset-1 reg_td_left">
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 col-sm-8 col-xs-12 reg_td_right">
                    <input type="submit" name="registration_submit" id="registration_submit" value="Зарегистрироваться" class="form-control btn btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    &nbsp;
</div>