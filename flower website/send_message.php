<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Почтовый ящик, на который будет отправлено сообщение
    $to = "crkumcc@gmail.com";
    
    // Тема письма
    $subject = "Сообщение от посетителя сайта FlowerFusion";
    
    // Тело письма
    $body = "Имя: $name\n";
    $body .= "Email: $email\n";
    $body .= "Телефон: $phone\n";
    $body .= "Сообщение:\n$message";
    
    // Заголовки для установки адреса отправителя и кодировки
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";
    
    // Попытка отправить письмо
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время!');</script>";
    } else {
        echo "<script>alert('Что-то пошло не так. Попробуйте отправить сообщение позже.');</script>";
    }
}
?>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные о товаре из POST запроса
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    
    // Создаем или обновляем массив в сессии для хранения корзины
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Добавляем товар в корзину
    $item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1  // начальное количество товара
    );
    
    // Проверяем, есть ли уже такой товар в корзине
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $product_id) {
            $cart_item['quantity']++; // увеличиваем количество товара
            $found = true;
            break;
        }
    }
    
    // Если товар не был найден в корзине, добавляем новый элемент
    if (!$found) {
        array_push($_SESSION['cart'], $item);
    }
    
    // Возвращаем пользователя на предыдущую страницу или на страницу корзины
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
