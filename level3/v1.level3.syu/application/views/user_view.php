<h1>Добро пожаловать!</h1>
<p>
    <img src="/images/office-small.jpg" align="left" >
    <a href="/">ЗАГОЛОВОК</a> это страница списка книг
    <?php
        if (isset($_GET['offset'])) {
            echo 'offset=' . $_GET['offset'];
        }
    ?>
</p>