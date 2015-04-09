<?php
include "tmplKontrol.php";
?>

<section>
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Şifrelerinizi giriniz.
                </h3>
            </div>
            <div class="panel-body">
                <form action="admin/index.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" type="email" autofocus="" name="fMail" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" autofocus="" name="fMail" placeholder="E-mail">
                    </div>
                    <input class="btn btn-lg btn-block btn-one" type="submit" value="Değiştir" name="sifre"/>
                </form>
            </div>
        </div>
    </div>
</section>

