<?php

/**
 * Twig arayüzü için sadece render çağırıcı içeren bir sınıf.
 *
 * Class Twiggy
 */
class Twiggy
{
    public $loader = null;
    public $twig;

    /**
     * Gerekli construct işlemleri halleder.
     *
     * NOT:
     * ====
     * 1. $depth: çağırılan script'in ana klasor ne kadar altında
     *    olduğunu belirtir.
     *          index.php       $depth = 0,
     *          admin/index.php $depth = 1, vs.
     *
     * @param $depth integer
     * @param null $cache_klasor
     */
    public function __construct($depth=0, $cache_klasor=null)
    {
        // $depth'e göre gereken klasor yollarının
        // başına ../ atanması.
        $pre = "";
        for ($i = 0; $i<$depth; $i++) {
            $pre .= "../";
        }

        require_once($pre."config.php");
        require_once($pre."Twig/lib/Twig/Autoloader.php");
        Twig_Autoloader::register();

        $this->loader = new Twig_Loader_Filesystem($pre.TEMP_KLASOR);

        if ($cache_klasor) {
            $this->twig = new Twig_Environment($this->loader, array( 'cache' => $cache_klasor, "debug" => true ));
        } else {
            $this->twig = new Twig_Environment($this->loader, array("debug" => true));
        }
        $this->twig->addExtension(new Twig_Extension_Debug());
    }

    public function render($template, $data)
    {
        echo $this->twig->render("$template", array("data" => $data));
    }

}



?>