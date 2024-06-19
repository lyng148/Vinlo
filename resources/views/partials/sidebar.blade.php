<style>
    .sidebar {
        width: 250px;
        background: #f8f9fa;
        padding: 20px;
        border-right: solid 1px #E7E7E7;
    }

    .sidebar li {
        padding: 10px;
    }
    .sidebar ul {
        list-style-type: none;
        padding: 10px;
    }


    .item:hover{
        background-color: #F0F7FF;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: #333;
    }

    .sidebar ul li ul {

    }

    .content {
        flex: 1;
        padding: 20px;
    }

    .item {
        padding-left: 20px;
        padding-right: 20px;
        border-bottom: solid 1px #000000;
        justify-content: left;
        display: flex;
        align-items: flex-start;

    }

</style>
<div class="sidebar">
    <ul>
        <li><a href="#" class="item">Thông Tin Của Tôi</a>
            <ul>
                <li><a href="/users/{{auth()->id()}}/edit/avatar" class="">Avatar</a></li>
                <li><a href="/users/{{auth()->id()}}/edit/profile" class="">Tên</a></li>
                <li><a href="/users/{{auth()->id()}}/edit/email" class="">Email</a></li>
            </ul>
        </li>
        <li><a href="#" class="item">Bảo Mật</a>
            <ul>
                <li><a href="/users/{{auth()->id()}}/edit/password" class="">Mật Khẩu</a></li>
            </ul>
        </li>
    </ul>
</div>
