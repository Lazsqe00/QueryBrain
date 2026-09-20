<?php
    /*
        - Chuẩn hóa đường dẫn, linux or mac chỉ hiểu dấu /, trong khi đó win lại hiểu '\' và '/' => chuyển về '/' gọi require_once đường dẫn
        - Dấu '\' bị hiểu nhầm là ký tự thoát, nếu gõ \" => xem như nó giữ lại dấu ", do đó cần thay là \\ = 1 ký tự \ bình thường
    */
    spl_autoload_register(function(string $class) {
        $path = __DIR__ . "/src/" . str_replace("\\", "/", $class) . ".php";
         require_once $path;
    });
?>