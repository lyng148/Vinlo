# Vinlo

Vinlo là một blog đơn giản được xây dựng bằng Laravel.

## Tính năng

- Xác thực người dùng
- Chỉnh sửa thông tin cá nhân
- Tạo, đọc, cập nhật và xóa bài viết
- Upvote, Downvote bài viết
- Bình luận trên bài viết
- Follow, Unfollow người dùng

## Cài đặt

1. Sao chép repository:
   ```sh
   git clone https://github.com/lyng148/Vinlo.git
   cd Vinlo
2. Cài đặt dependency
    ```sh
   composer install
   npm install
3. Cấu hình cài đặt cơ sở dữ liệu trong tệp .env.
4. Chạy lệnh migrate
   ```sh
   php artisan migrate
5. Khởi chạy
    ```sh
   php artisan serve
   npm run dev

