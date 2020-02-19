<?php
/**
 * Created by PhpStorm.
 * User: platonovso
 * Date: 18.10.2019
 * Time: 14:00
 */

/*include 'simple_html_dom.php';

$html = file_get_html("http://progadget59.ru");
$links = $html->find('.menu-dropdown-sub-link');
$links_path = [];

foreach ($links as $link) {
  array_push($links_path, $link->href);
  echo '\'' . $link->href . '\',<br/>';
}

$links = $html->find('.menu-dropdown-link');

foreach ($links as $link) {
  array_push($links_path, $link->href);
  echo '\'' . $link->href . '\',<br/>';
}*/

global $parse_category;


$parse_category = [
  'http://progadget59.ru/categories/remeshki-dlya-apple-watch',
  'http://progadget59.ru/categories/chekhly-dlya-airpods-1',
  'http://progadget59.ru/categories/iphone-11-pro-max',
  'http://progadget59.ru/categories/iphone-11-pro',
  'http://progadget59.ru/categories/iphone-11',
  'http://progadget59.ru/categories/iphone-xs-max',
  'http://progadget59.ru/categories/iphone-xs',
  'http://progadget59.ru/categories/iphone-xr',
  'http://progadget59.ru/categories/iphone-x',
  'http://progadget59.ru/categories/iphone-8-8-plus',
  'http://progadget59.ru/categories/iphone-7-7-plus',
  'http://progadget59.ru/categories/apple-watch-s1',
  'http://progadget59.ru/categories/apple-watch-s2',
  'http://progadget59.ru/categories/apple-airpods',
  'http://progadget59.ru/categories/chekhly-dlya-iphone-7-8-1',
  'http://progadget59.ru/categories/aksessuary-dlya-apple-watch',
  'http://progadget59.ru/categories/aksessuary-dlya-xiaomi-mi-band',
  'http://progadget59.ru/categories/aksessuary-dlya-avtomobilya',
  'http://progadget59.ru/categories/aksessuary-dlya-doma',
  'http://progadget59.ru/categories/aksessuary-dlya-kompiuterov',
  'http://progadget59.ru/categories/aksessuary-dlya-planshetov',
  'http://progadget59.ru/categories/aksessuary-dlya-telefonov',
  'http://progadget59.ru/categories/aksessuary-dlya-fotoapparatov',
  'http://progadget59.ru/categories/zaryadnye-ustroistva-2',
  'http://progadget59.ru/categories/kabeli',
  'http://progadget59.ru/categories/naushniki-1',
  'http://progadget59.ru/categories/portativnye-kolonki-3',
  'http://progadget59.ru/categories/nositeli-informatsii',
  'http://progadget59.ru/categories/kabeli-perekhodniki-adaptery',
  'http://progadget59.ru/manufacturers/beats',
  'http://progadget59.ru/manufacturers/gal',
  'http://progadget59.ru/manufacturers/smartbuy',
  'http://progadget59.ru/manufacturers/sony',
  'http://progadget59.ru/categories/apple-1',
  'http://progadget59.ru/categories/huawei-honor-1',
  'http://progadget59.ru/categories/meizu-2',
  'http://progadget59.ru/categories/noa',
  'http://progadget59.ru/categories/oukitel',
  'http://progadget59.ru/categories/samsung',
  'http://progadget59.ru/categories/xiaomi',
  'http://progadget59.ru/categories/testovaya-kategoriya-dlya-vygruzki-v-avito',
  'http://progadget59.ru/categories/aksessuary-3'
];