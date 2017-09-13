Конфиги / Настройка:

1) Подключение к базе данных: -> Необходимо настроить конфиг dbcfg.php :

$dbhost = '127.0.0.1'; //Database Host 

$dbname = 'lighttest'; //Database Name

$dbusername = 'root'; //Database Username

$dbpass = '123456'; //Database Password

Так же необходимо импортировать БД из папки /database/

2) Facebook API: -> Настройка Facebook приложения в файле facebookcfg.php :

define('FB_ID', '130035117626009'); //Id Приложения в Facebook

define('FB_SECRET', '10496357c79faa0b69fed9eb106c6b70');  //Секретный код Приложения в Facebook

define('FB_URL', 'http://localhost/'); // URL Приложения в Facebook

define('FB_DGV', 'v2.10'); // Default Graph Version;

3) Кроме того, доступна общая настройка в файле applicationcfg.php, которая включает

$default_controller = 'Facebook'; // Контроллер по умолчанию

$default_action = 'index'; //Действие по умолчанию

А так же

$max_comments_nesting = '6'; // Максимальная вложенность Сообщений (для отображения) (сейчас влияет на лимит по столбцу mess_lvl в таблице messages)

<-------------->

Приложение запускалось через OpenServer x64 (папка localhost)

Настройки модулей:

Appache-2.4-x64

PHP-5.6-x64

MySQL-5.5



<-------------->
Todo:

1) Реализация функции проверки сообщений на уникальность (для того, что бы комментарий не выводился дважды - 1 раз как сообщение, 2 раз как комментарий

2) Исправить проблему отображения комментарией (функции Draw)


