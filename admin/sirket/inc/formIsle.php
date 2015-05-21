<?php
session_start();
require_once "../../../lib/fonksiyonlar.php";

function element_to_obj($element) {
    $obj = array("tag" => $element->tagName );
    foreach ($element->attributes as $attribute) {
        $obj[$attribute->name] = $attribute->value;
    }
    foreach ($element->childNodes as $subElement) {
        if ($subElement->nodeType == XML_TEXT_NODE) {
            $obj["html"] = $subElement->wholeText;
        }
        else {
            $obj["children"][] = element_to_obj($subElement);
        }
    }
    return $obj;
}

function htmlToDom($html) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    return element_to_obj($dom->documentElement);
}



if (isset($_POST["render"]) and isset($_SESSION["sirketId"])) {
    $html = $_POST["render"];
    $re = "/(<!-- .*-->)/";
    $html = preg_replace($re, "", $html);

    $re_title = "/<legend>(.*)<\\/legend>/";
    preg_match($re_title, $html, $title);
    $title = $title[1];

    $htmlDom = htmlToDom($html);
    $htmlJson = json_encode($htmlDom, JSON_PRETTY_PRINT);

    $formEkle = Bulut::formEkle($_SESSION["sirketId"], $title, $html, $htmlJson);

    if ($formEkle) {
        $mesaj = "basarili";
    }
    else {
        $mesaj = "basarisiz";
    }

}
else {
    $mesaj = "basarisiz";
}

echo "
<script>
window.location.href = '../../index.php?link=formlar&sonuc=$mesaj';
</script>";






?>