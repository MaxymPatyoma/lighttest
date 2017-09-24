﻿Конфиги / Настройка:

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

А так же константы для вёртски: 

'MAX_COMM_NEST'; // Максимальная вложенность Сообщений (для отображения). Не может быть меньше 1

'COMMENT_OFFSET'; // Кол-во пикселей, на которое смещается каждый комментарий 
// следующей вложенности (до ограничения MAX_COMM_NEST);

'COMMENT_OFFSET_AFTER_MAX_NEST'; // Кол-во пикселей, на которое смещается каждый комментарий 
// следующей вложенности (после ограничения MAX_COMM_NEST);


<-------------->


ОС: Windows 7 x64

Приложение запускалось через OpenServer x64 (папка localhost)

Настройки модулей:

Appache-2.4-x64

PHP-5.6-x64

MySQL-5.5



<------Done-------->

1) Исправлена ошибка подключения файлов (для всех файлов подключение теперь осуществляется с помощью $_SERVER['DOCUMENT_ROOT'])

2) Реализация функции проверки сообщений на уникальность -> Проблема была в переменной max_comments_nesting. 
Из-за неё mess_lvl сообщения при комментировании не увеличивался и оставался значением 0. 
По этому программа считала комментарий и как комментарий и как сообщение (т.к. отбор сообщений шёл по полю mess_lvl)

3) Исправлена проблема отображения комментариев (функции Draw)

4) Изменён дизайн вывода сообщений и комментариев

5) Исправлена ошибка с относительными путями

6) Испавлено отсутствие isset (к примеру, в templateview при проверке на наличие Сессии)

