<?php
// TODO: Güvenlik include.
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        Bulut Süper Admin
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Navigasyon</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Süper Admin 1.0 (<?php echo $_SESSION["kulAdi"]; ?>)</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- MESAJLAR -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Mesajlar ve Notifikasyonlar.</strong>
                                    <span class="pull-right text-muted">
                                        <em>Ne Zaman?</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>

                <!- TASKLAR -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>

                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>

                <!-- ALERT'LAR -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>

                <!-- AYARLAR VE ÇIKIŞ -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <p style="text-align: center">
                            <?php echo $_SESSION["kulAdi"]; ?>
                        </p>
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="cikis.php"><i class="fa fa-sign-out fa-fw"></i>Çıkış Yap</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


            <div class="navbar-default sidebar" role="navigation">

                <!-- SOL BAR -->
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <!-- LOGO -->
                        <li>
                            <div style="text-align: center; padding: 10px">
                                <a href="../index.php">
                                    <img src="../static/images/logo_200.png" alt="Logomuz"/>
                                </a>
                            </div>
                        </li>

                        <!-- ARAMA BARI -->
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>


                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Admin Paneli</a>
                        </li>

                        <li>
                            <a href="?link_ref=sirketler"><i class="fa fa-dashboard fa-fw"></i> Şirketler</a>
                        </li>

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Müşteriler</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- ŞİRKET LİSTESİ -->
            <?php
            if (isset($link_ref) and $link_ref == "sirketler") {
                $sirketler = Bulut::getirSirketler();

                foreach($sirketler as $sirket) {

                    ?>

                    <div class="row">

                        <!-- ŞİRKET ADI -->
                        <div class="col-lg-8">
                            <div class="col-lg-4">
                                <img src="../<?php Bulut::logoGetir($sirket["logo"], 200, true); ?>" alt=""/>
                            </div>
                            <div class="col-lg-8">
                                <!-- TODO: CSS Değişme -->
                                <header>
                                    <a style="font-size: 2.5rem" href="?link_ref=sirket&id= <?php echo $sirket['id']; ?>">
                                        <?php echo $sirket["adi"]; ?>
                                        (<?php
                                            if ($sirket["premium"]) {
                                                echo "Premium Kullanıcı";
                                            }
                                            else {
                                                echo "Normal Kullanici";
                                            }
                                        ?>)
                                    </a>
                                    <br/>
                                    <div>
                                        <strong>Yetkili: </strong><?php echo $sirket["yetkili"]; ?>
                                        <br/>
                                        <strong>Tel: </strong> <a href="tel:<?php echo $sirket['tel']; ?>"><?php echo $sirket["tel"]; ?></a>
                                        <br/>
                                        <strong>Kayıt Tarihi: </strong><?php echo substr($sirket["tarih_kayit"], 0, 10); ?>
                                    </div>
                                </header>
                            </div>
                            <br/>
                        </div>
                        <div class="col-lg-4">
                            <span class="btn btn-default">Giriş</span>
                            <span class="btn btn-default">Aktif/Pasif</span>
                            <span class="btn btn-default">İletişim</span>

                        </div>

                        <!-- alt bilgiler -->
                        <div class="col-lg-12">

                            <hr/>

                            <div class="col-lg-8">

                                <div class="col-lg-6">

                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-support fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">
                                                        <?php echo $sirket["kullanici_sayisi"]; ?>
                                                    </div>
                                                    <div>
                                                        <h4>Kullanıcı</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="?link_ref=sirket&id=<?php echo $sirket['id'];?>#kullanicilar">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <!-- müşteriler -->
                                <div class="col-lg-6">

                                    <div class="panel panel-red">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-support fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">
                                                        <?php echo Bulut::getirSirketMusteriler($sirket["id"], $sayı=true); ?>
                                                    </div>
                                                    <div>
                                                        <h4>Müşteriler</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="?link_ref=sirket&id=<?php echo $sirket['id'];?>#kullanicilar">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Details</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <hr/>

                                <div class="col-lg-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, unde!</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab ad aliquid asperiores aspernatur cum dolorem, enim ipsa ipsam minus quos ratione reiciendis sunt, temporibus veritatis?</p>
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <div class="panel panel-red">
                                    <div class="panel-heading text-center">
                                        <h3>
                                            İletişim Bilgileri
                                        </h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <address>
                                            <?php echo $sirket["adres"]; ?>
                                        </address>
                                        <hr>
                                        <div class="text-center">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6030.533199975311!2d29.15560257888792!3d40.90990002799083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x15813283ae2b8635!2sKartal+Adliyesi!5e0!3m2!1sen!2s!4v1428913400874" width="300" height="200" frameborder="0" style="border:0"></iframe>
                                        </div>
                                    </div>

                                    <div class="panel-footer text-center">
                                        <strong>Tel: </strong> <a href="tel:<?php echo $sirket['tel']; ?>"><?php echo $sirket["tel"]; ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <hr/>

                <?php
                }
            }
            ?>


            <!-- BİREYSEL ŞİRKET BİLGİLERİ -->
            <?php
            if (isset($link_ref) and
                isset($link_id) and
                $link_ref == "sirket"
            ){
                $sirket = Bulut::getirSirket($link_id);
            ?>

                <div class="row">

                    <!-- ŞİRKET ADI -->
                    <div class="col-lg-8">
                        <div class="col-lg-4">
                            <img src="../upload/logo.jpg" alt=""/>
                        </div>
                        <div class="col-lg-8">
                            <!-- TODO: CSS Değişme -->
                            <header>
                                <a style="font-size: 2.5rem" href="?link_ref=sirket&id= <?php echo $sirket['id']; ?>">
                                    <?php echo $sirket["adi"]; ?>
                                    (<?php
                                    if ($sirket["premium"]) {
                                        echo "Premium Kullanıcı";
                                    }
                                    else {
                                        echo "Normal Kullanici";
                                    }
                                    ?>)
                                </a>
                                <br/>
                                <div>
                                    <strong>Yetkili: </strong><?php echo $sirket["yetkili"]; ?>
                                    <br/>
                                    <strong>Tel: </strong> <a href="tel:<?php echo $sirket['tel']; ?>"><?php echo $sirket["tel"]; ?></a>
                                    <br/>
                                    <strong>Kayıt Tarihi: </strong> <?php echo substr($sirket["tarih_kayit"], 0, 10); ?>
                                </div>
                            </header>
                        </div>
                        <br/>
                    </div>
                    <div class="col-lg-4 text-right">
                        <span class="btn btn-default">Giriş</span>
                        <span class="btn btn-default">Aktif/Pasif</span>
                        <span class="btn btn-default">İletişim</span>
                    </div>

                    <!-- alt bilgiler -->
                    <div class="col-lg-12">

                        <hr/>

                        <div class="col-lg-8">

                            <div class="col-lg-12">
                                <!-- ŞİRKET AYRINTILI BİLGİLER -->


                                <!-- kullanıcılar paneli -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">
                                                    <?php echo $sirket["kullanici_sayisi"]; ?>
                                                </div>
                                                <div>
                                                    <h3>KULLANICILAR</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <?php
                                        $kullanicilar = Bulut::getirSirketKullanicilar($sirket["id"]);

                                        foreach($kullanicilar as $kullanici){
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <?php echo $kullanici["adi"]." ".$kullanici["soyadi"]; ?>
                                                        </div>
                                                        <div class="col-lg-4 text-right">
                                                            <span class="btn btn-default">İşlem</span>
                                                            <span class="btn btn-default">İşlem</span>
                                                            <span class="btn btn-default">İşlem</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    adfasfsadf
                                                </div>
                                            </div>

                                            <hr/>

                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <<<
                                            </div>
                                            <div class="col-lg-8 text-center">
                                                1 - 2 - 3 - 4 - 5
                                            </div>
                                            <div class="col-lg-2 text-right">
                                                >>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">
                                                    <?php echo Bulut::getirSirketMusteriler($sirket["id"], $sayı=true); ?>
                                                </div>
                                                <div>
                                                    <h3>MÜŞTERİLER</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $musteriler = Bulut::getirSirketMusteriler($sirket["id"]);

                                        if(!$musteriler) {
                                            $musteriler = array();
                                        }

                                        foreach($musteriler as $musteri) {
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <?php echo $musteri["adi"]." ".$musteri["soyadi"]; ?>
                                                        </div>
                                                        <div class="col-lg-4 text-right">
                                                            <span class="btn btn-default">İşlem</span>
                                                            <span class="btn btn-default">İşlem</span>
                                                            <span class="btn btn-default">İşlem</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <strong>Email: </strong> <?php echo $musteri["mail"]; ?><br/>
                                                    <strong>Kayıt Tarihi: </strong><?php echo $musteri["tarih_kayit"]; ?><br/>
                                                    <strong>Son Giriş: </strong><?php echo $musteri["tarih_son_giris"]; ?>
                                                </div>
                                            </div>

                                            <hr/>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <<<
                                            </div>
                                            <div class="col-lg-8 text-center">
                                                1 - 2 - 3 - 4 - 5
                                            </div>
                                            <div class="col-lg-2 text-right">
                                                >>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel panel-red">
                                <div class="panel-heading text-center">
                                    <h3>
                                        İletişim Bilgileri
                                    </h3>
                                </div>
                                <div class="panel-body text-center">
                                    <address>
                                        <?php echo $sirket["adres"]; ?>
                                    </address>
                                    <hr/>
                                    <div class="text-center">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6030.533199975311!2d29.15560257888792!3d40.90990002799083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x15813283ae2b8635!2sKartal+Adliyesi!5e0!3m2!1sen!2s!4v1428913400874" width="300" height="200" frameborder="0" style="border:0"></iframe>
                                    </div>
                                </div>

                                <div class="panel-footer text-center">
                                    <strong>Tel: </strong> <a href="tel:<?php echo $sirket['tel']; ?>"><?php echo $sirket["tel"]; ?></a>
                                </div>
                            </div>


                                <div>
                                </div>

                        </div>
                        <br/>
                    </div>

                </div>

            <?php
            }
            ?>

            <hr/>
            <hr/>

        </div>
        <!-- /#page-wrapper -->


        <h1>Sayfa sonu</h1>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    </div>

</body>
</html>





