<?php
   //Nhúng tập tin chứa các hằng số mặc định của ứng dụng
   include 'define.php';


   //Nhúng tập tin chứa lớp AutoloaderFactory
   include LIBRARY_PATH . '/Zend/Loader/AutoloaderFactory.php';
   
   //Thiết chế tự động load các tập tin cấu hình của các thành phần mở rộng
   Zend\Loader\AutoloaderFactory::factory(array(
      'Zend\Loader\StandardAutoloader' => array(
      'autoregister_zf' => true
      )
   ));
   
   //Kiểm tra xem sự tồn tại của lớp AutoloaderFactory
   //Nếu không tồn tại thì hiển thị thông báo lỗi
   if (!class_exists('Zend\Loader\AutoloaderFactory')) {
      throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
   }
   
   // Nạp tập tin cấu hình /config/appliction.config.php
   //Sau đó chạy ứng dụng Zend Framework
   Zend\Mvc\Application::init(require 'config/application.config.php')->run();