<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PHP 5.6 и Apache 2 под PHP 5.6

$start = microtime(true);

header('Content-Type: text/html; charset=utf-8');

include 'simple_html_dom.php';
include 'parser_category.php';
require_once __DIR__ . '/Classes/PHPExcel.php';
require_once __DIR__ . '/Classes/PHPExcel/Writer/Excel2007.php';
require_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';

set_time_limit(0);

$arrayHtml = [];
$arrayParse = [];

$html = file_get_html("http://progadget59.ru");
global $html_in;

$links_category = $parse_category;

/*
 * Список ссылок на категории
*/

function translit($str) {
  $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Sch', '', 'Y', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya');
  return str_replace($rus, $lat, $str);
}

if (!empty($links_category)) {
  foreach ($links_category as $number => $link_category) {
    $start = microtime(true);

    if (true) {
      $xls = new PHPExcel();
      $xls = PHPExcel_IOFactory::load(__DIR__ . '/layout.xlsx');

      $xls->setActiveSheetIndex(0);
      $sheet = $xls->getActiveSheet();

      $objWriter = new PHPExcel_Writer_Excel2007($xls);

      $file_name = (string)html_entity_decode($link_category);
      $first_char = strrpos($file_name, '/', -2) + 1;
      $last_char = strrpos($file_name, '/');
      $file_name = substr($file_name, $first_char, $last_char - $first_char);

      $page_category = file_get_html(html_entity_decode($link_category) . '?limit=1000');

      $links_item = $page_category->find('.products-view-picture-link');


      foreach ($links_item as $i => $link_item) {
        if (!empty($link_item)) {

          if (!strpos(html_entity_decode($link_item->href), '%')) {
            $page_item = file_get_html(html_entity_decode($link_item->href));

            $category = '';
            $subcategory = '';
            $subcategory_2 = '';
            $name = '';
            $atricle = '';
            $available = '';
            $price = '';
            $desc = '';


            if (str_get_html($page_item->find('.breads', 0)->find('.breads-item', 1)->find('a', 0))) {
              $category = html_entity_decode($page_item->find('.breads', 0)->find('.breads-item', 1)->find('a', 0)->find('span', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.breads', 0)->find('.breads-item', 2)->find('a', 0))) {
              $subcategory = html_entity_decode($page_item->find('.breads', 0)->find('.breads-item', 2)->find('a', 0)->find('span', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.breads', 0)->find('.breads-item', 3))) {
              if (str_get_html($page_item->find('.breads', 0)->find('.breads-item', 3)->find('a', 0))) {
                $subcategory_2 = html_entity_decode($page_item->find('.breads', 0)->find('.breads-item', 3)->find('a', 0)->find('span', 0)->plaintext);
              }
            }

            if (str_get_html($page_item->find('[itemprop="name"]', 0))) {
              $name = html_entity_decode($page_item->find('[itemprop="name"]', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.details-param-value', 0))) {
              $atricle = html_entity_decode($page_item->find('.details-param-value', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.details-availability', 0))) {
              $available = html_entity_decode($page_item->find('.details-availability', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.price-number', 0))) {
              $price = html_entity_decode($page_item->find('.price-number', 0)->plaintext);
            }

            if (str_get_html($page_item->find('.details-tabs-deacription', 0))) {
              $desc = trim(html_entity_decode($page_item->find('.details-tabs-deacription', 0)->plaintext));
            }

            /*echo 'Категория - ' . $category . '</br>';
            echo 'Подкат - ' . $subcategory . '</br>';
            echo 'Подкат_2 - ' . $subcategory_2 . '</br>';
            echo 'Название - ' . $name . '</br>';
            echo 'Артикул - ' . $atricle . '</br>';
            echo 'Наличие - ' . $available . '</br>';
            echo 'Цена - ' . $price . '</br>';
            echo 'Описание - ' . $desc . '</br>';*/

            $image_name = str_replace('&nbsp;', ' ', $name);
            $image_name = preg_replace('/-/', '', $image_name);
            $image_name = preg_replace('/^ /', '', $image_name);
            $image_name = preg_replace('/«/', '', $image_name);
            $image_name = str_replace('/', ' ', $image_name);
            $image_name = preg_replace('/»/', '', $image_name);
            $image_name = preg_replace('/\(/', '', $image_name);
            $image_name = preg_replace('/\)/', '', $image_name);
            $image_name = preg_replace('/:/', '', $image_name);
            $image_name = preg_replace('/\./', '', $image_name);
            $image_name = preg_replace('/,/', '', $image_name);
            $image_name = preg_replace('/"/', '', $image_name);
            $image_name = preg_replace('/”/', '', $image_name);
            $image_name = preg_replace('/\s+/', ' ', $image_name);
            $image_name = preg_replace('/№/', '', $image_name);
            $image_name = str_replace(' ', '_', translit($image_name));
            $image_name = preg_replace('/_$/', '', $image_name);

            if (strlen($image_name) > 50) {
              $pos_ = strpos($image_name, '_', '40');

              if ($pos_) {
                $image_name = substr($image_name, 0, $pos_);
              }
            }

            $image_name_article = str_replace('/', ' ', $atricle);
            $image_name_article = mb_strtolower(str_replace('&nbsp;', '', $image_name_article));
            $image_name_article = str_replace(' ', '_', translit($image_name_article));

            $image_name = $image_name . '_' . $image_name_article;
            $image_name = str_replace('_', '-', mb_strtolower($image_name));

            $links_image = $page_item->find('.gallery-photos-item-obj');
            $urls = [];
            $images_urls = [];

            foreach ($links_image as $j => $link_image) {
              $url_image = $link_image->src;
              $url_image = str_replace('xsmall', 'big', $url_image);

              array_push($urls, $url_image);
            }

            $urls = array_values(array_unique($urls));

            foreach ($urls as $j => $url) {
              $path = html_entity_decode(__DIR__ . '/items/' . $image_name . ($j !== 0 ? '_' . ($j + 1) : '') . '.jpg');
              $image_file_name = $image_name . ($j !== 0 ? '_' . ($j + 1) : '') . '.jpg';
              file_put_contents($path, file_get_contents($url));

              array_push($images_urls, $image_file_name);
            }

            /*print_r($images_urls);
            echo '</br></br>';*/

            $sheet->setCellValue('A' . (2 + $i), $category);
            $sheet->setCellValue('B' . (2 + $i), $subcategory);
            $sheet->setCellValue('C' . (2 + $i), $subcategory_2);
            $sheet->setCellValue('D' . (2 + $i), $name);
            $sheet->setCellValue('E' . (2 + $i), $atricle);
            $sheet->setCellValue('F' . (2 + $i), $available);
            $sheet->setCellValue('G' . (2 + $i), $price);
            $sheet->setCellValue('H' . (2 + $i), $desc);
            $sheet->setCellValue('I' . (2 + $i), implode($images_urls, ';'));

          }
        }
      }

      $objWriter->save(__DIR__ . '/excel/' . $number . '. ' . $file_name . '.xlsx');
      $xls->disconnectWorksheets();
      unset($objWriter, $xls);
    }

    $finish = microtime(true);
    $delta = round($finish - $start);
    $minute = floor($delta / 60);
    $second = abs(floor($delta / 60) * 60 - $delta);

    echo $number + 1 . '. Success - ' . $link_category . '! Execution time:' . $minute . ' min ' . $second . ' sec</br>' . PHP_EOL;
  }
}


$finish = microtime(true);
$delta = round($finish - $start);
$minute = floor($delta / 60);
$second = abs(floor($delta / 60) * 60 - $delta);

$html->clear();
unset($html);

echo '</br>Success! Execution time: ' . $minute . ' min ' . $second . ' sec';

die();


