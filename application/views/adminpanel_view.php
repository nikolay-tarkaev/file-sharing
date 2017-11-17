<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>Панель администратора</h3>
    <hr />
    <div class="col-lg-12">
        <ul class="nav nav-tabs" style="margin-bottom: 30px;">
            <li class="active"><a class="tabnav" data-toggle="tab" href="#menu_1">Статистика посещений</a></li>
            <li><a class="tabnav" data-toggle="tab" href="#menu_2">Меню 2</a></li>
            <li><a class="tabnav" data-toggle="tab" href="#menu_3">Меню 3</a></li>
        </ul>
    </div>
    <div class="col-lg-12 tab-content" style="margin-bottom: 50px;">
        <div id="menu_1" class="tab-pane fade in active">
            <?php
                $file = $data['file'];
                $col = $data['col'];

                if ($col>sizeof($file)) { $col=sizeof($file); }
                echo "Последние <b>".$col."</b> посещений сайта (всего ".sizeof($file)."):"; 
            ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center visitor_stat">
                <div class="col-lg-2"><b>Дата</b></div>
                <div class="col-lg-2"><b>Логин</b></div>
                <div class="col-lg-2"><b>IP/Прокси</b></div>
                <div class="col-lg-6"><b>URL</b></div>
                <div class="col-lg-12"><b>Данные о посетителе</b></div>
            </div>

            <?php
                    for ($si=sizeof($file)-1; $si+1>sizeof($file)-$col; $si--) {
                        $string=explode("|",$file[$si]);
                        $q1[$si]=$string[0]; // дата и время
                        $q2[$si]=$string[1]; // имя бота
                        $q3[$si]=$string[2]; // логин
                        $q4[$si]=$string[3]; // ip бота
                        $q5[$si]=$string[4]; // адрес посещения
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center visitor_stat">
                            <div class="col-lg-2"><?php echo $q1[$si]; ?></div>
                            <div class="col-lg-2"><?php echo $q3[$si]; ?></div>
                            <div class="col-lg-2"><?php echo $q4[$si]; ?></div>
                            <div class="col-lg-6 stat_url"><?php echo $q5[$si]; ?></div>
                            <div class="col-lg-12"><?php echo $q2[$si]; ?></div>
                        </div>
                        <?php
                    }
            ?>
                <br>Просмотреть последние <a href="?stat=100">100</a> <a href="?stat=500">500</a>
                <a href="?stat=1000">1000</a> посещений.
                <br>Просмотреть <a href="?stat=all">все посещения</a>.
        </div>
        <div id="menu_2" class="tab-pane fade">
            - Меню 2 -

        </div>
        <div id="menu_3" class="tab-pane fade">
            - Меню 3 -

        </div>
    </div>
</div>