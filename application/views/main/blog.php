<?php
//$dir    = 'public/img/img/polirovka';
//$scanned_directory = array_diff(scandir($dir), array('..', '.'));

$path       = 'public/img/img/polirovka'; // путь к директории с изображениями
$extensions = array('png', 'jpg', 'jpeg', 'gif'); // показывать расширения

$directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$iteratorIterator  = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);
?>
<style>
  body { background: grey; }
</style>

<h1>Полировка волос</h1>
<div class="column">
          <!-- Разметка Lightbox -->
          <!-- миниатюрные изображения завернутые в ссылку -->
          <div class="thumb">
            <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo ('<a href="#'.$str2[0]).'"><img src="/public/img/img/polirovka/'.$str2[0].'.jpg"></a>';
                }
              }
            ?>
          </div>
          <!-- лайтбокс контейнер скрыт с помощью CSS -->
          <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo('<a href="#close" class="lightbox" id="'.$str2[0].'">
            <img src="/public/img/img/polirovka/'.$str2[0].'.jpg">
          </a>');
                }
              }
            ?>
         
</div>

<?php
$path       = 'public/img/img/make'; // путь к директории с изображениями
$extensions = array('png', 'jpg', 'jpeg', 'gif'); // показывать расширения

$directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$iteratorIterator  = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);
?>
<style>
  body { background: grey; }
</style>
<h1>Прически и макияж</h1>
<div class="column">
          <!-- Разметка Lightbox -->
          <!-- миниатюрные изображения завернутые в ссылку -->
          <div class="thumb">
            <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo ('<a href="#'.$str2[0]).'"><img src="/public/img/img/make/'.$str2[0].'.jpg"></a>';
                }
              }
            ?>
          </div>
          <!-- лайтбокс контейнер скрыт с помощью CSS -->
          <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo('<a href="#close" class="lightbox" id="'.$str2[0].'">
            <img src="/public/img/img/make/'.$str2[0].'.jpg">
          </a>');
                }
              }
            ?>
         
</div>

<?php
$path       = 'public/img/img/nails'; // путь к директории с изображениями
$extensions = array('png', 'jpg', 'jpeg', 'gif'); // показывать расширения

$directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$iteratorIterator  = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);
?>
<style>
  body { background: grey; }
</style>
<h1>Ногти</h1>
<div class="column">
          <!-- Разметка Lightbox -->
          <!-- миниатюрные изображения завернутые в ссылку -->
          <div class="thumb">
            <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo ('<a href="#'.$str2[0]).'"><img src="/public/img/img/nails/'.$str2[0].'.jpg"></a>';
                }
              }
            ?>
          </div>
          <!-- лайтбокс контейнер скрыт с помощью CSS -->
          <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo('<a href="#close" class="lightbox" id="'.$str2[0].'">
            <img src="/public/img/img/nails/'.$str2[0].'.jpg">
          </a>');
                }
              }
            ?>
         
</div>

<?php
$path       = 'public/img/img/lashes'; // путь к директории с изображениями
$extensions = array('png', 'jpg', 'jpeg', 'gif'); // показывать расширения

$directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$iteratorIterator  = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);
?>
<style>
  body { background: grey; }
</style>
<h1>Ресницы</h1>
<div class="column">
          <!-- Разметка Lightbox -->
          <!-- миниатюрные изображения завернутые в ссылку -->
          <div class="thumb">
            <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo ('<a href="#'.$str2[0]).'"><img src="/public/img/img/lashes/'.$str2[0].'.jpg"></a>';
                }
              }
            ?>
          </div>
          <!-- лайтбокс контейнер скрыт с помощью CSS -->
          <?php 
              foreach ($iteratorIterator as $file) {
              if (in_array($file->getExtension(), $extensions)) {
                  $str2 = explode(".", $file->getFilename());
                  echo('<a href="#close" class="lightbox" id="'.$str2[0].'">
            <img src="/public/img/img/lashes/'.$str2[0].'.jpg">
          </a>');
                }
              }
            ?>
         
</div>