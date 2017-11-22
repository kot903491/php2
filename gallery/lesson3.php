<?php
/**
 * Created by PhpStorm.
 * User: Тимурка
 * Date: 21.11.2017
 * Time: 23:55
 */
require_once '/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
ob_start();
if (!isset($_GET['page'])){
    $content='hello.tpl';
    $title='Галерея';
    $header='Привет, это заголовок галереи';
}
else {
    $f = scandir('files');
    $i = 0;
    foreach ($f as $value) {
        if ($value != "." && $value != "..") {
            $img['img'] = 'files/' . $value;
            $img['name']=$value;
            $img['id'] = ++$i;
            $images[$i] = $img;
            unset($img);

        }
    }
    switch ($_GET['page']){
        case 'all':
            $content='images.tpl';
            $image=$images;
            $title='Каталог галереи';
            $header='Это каталог галереи';
            break;
        default:
            $content='image.tpl';
            $image=$images[$_GET['page']];
            $title=$image['name'];
            $header='Просмотр изображения'.$image['name'];
            break;
    }
}
    try {
        $loader = new Twig_Loader_Filesystem('tpl');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('main.tpl');
        $page = array('header' => $header,
            'footer' => 'Это подвал галереи',
            'title' => $title);
        echo $template->render(array('page' => $page,
                                    'CONTENT'=>$content,
                                    'image'=>$image));
        ob_end_flush();

    } catch (Exception $e) {
        die('ERROR: ' . $e->getMessage());
    }
ob_end_clean();