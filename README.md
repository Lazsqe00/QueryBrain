## Thành viên nhóm
- Nguyễn Xuân Kì Diệu - Leader
- Trần Minh Hoàng
- Võ Huỳnh Kim Chi
- Ngô Nguyễn Nhật Cường
---
# QueryBrain
**QueryBrain** là hệ thống hỗ trợ người dùng trò chuyện bằng với AI ngôn ngữ tự nhiên, định hướng phân tích cấu trúc dữ liệu và sinh câu truy vấn SQL nhanh chóng.
<p align="center">
  <br>
  <img width="1916" height="861" alt="image" src="https://github.com/user-attachments/assets/f04f0b26-a87c-4256-a1c2-19b866ca6c05" />
</p>

## Giới thiệu

Trong quản trị và khai thác cơ sở dữ liệu, việc viết các câu truy vấn SQL phức tạp có thể gặp nhiều rào cản đối với người dùng không chuyên hoặc tốn thời gian cho lập trình viên. 

**QueryBrain** ra đời nhằm thu hẹp khoảng cách này bằng cách ứng dụng mô hình trí tuệ nhân tạo để:
- Tiếp nhận câu hỏi bằng ngôn ngữ tự nhiên từ người dùng.
- Hiểu ngữ cảnh hội thoại và hỗ trợ giải đáp, gợi ý truy vấn cơ sở dữ liệu.

---

## Cấu hình

### Cấu hình API Key
Mở tệp `config/config.php` và điền khóa API của bạn vào vị trí `api_key`:

```php
<?php 
return [
    'apifree_ai' => [
        'provider'    => 'glm',
        'api_key'     => 'YOUR_API_KEY_HERE', // <-- Thay thế bằng API Key của bạn
        'model'       => 'zai-org/glm-4.7',
        'endpoint'    => 'https://api.apifree.ai/v1/chat/completions',
        'max_tokens'  => 2048,
        'temperature' => 0.7,
    ]
];
          
├── autoload.php             # load class
├── index.php              
└── README.md


       
