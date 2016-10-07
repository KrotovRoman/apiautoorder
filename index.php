<?php
/*
 * Пример использования библиотеки PHP
 * для работы с AutoOrder по API
 * 
 * @url http://autoorder.biz/
 * @docs http://autoorder.biz/help/api/
 * @autor http://krotovroman.ru 
 */
require_once 'ApiAutoOrder.php';

$config['key'] = 12345;  //Ключ API - задаете в настройках подключения в админке. 
$config['username'] = 'cofoviri'; //Ваш логин в системе AutoOrder
$api = new ApiAutoOrder($config); //создаем объект подключения по API


//добавить заказ
//$data['email'] = 'test@mail.ru'; //email - обязательно!
//$data['pay'] = 1;  //id способа оплаты  - обязательно!  
//$data['id_product'] = 1; //id товара на который оформляем заказ - обязательно!
//
//$data['phone']; //телефон
//$data['first_name']; //имя
//$data['last_name']; //фамилия
//$data['patronymic']; //отчество
//$data['country']; //страна
//$data['city']; //город
//$data['adress']; //адресс
//$data['area']; //область
//$data['postindex']; //почтовый индекс   
//   
//$data['comment_client']; //комментарий клиента
//$data['promocod']; //промокод
//
//$res = $api->add_order($data);

//получить категории
//$res = $api->get_categoryes();

//получить типы товаров
//$res = $api->get_types_product();

//получить товары
//$res = $api->get_products();

//получить способы оплаты
//$res = $api->get_types_pay();

//получить услуги
//$res = $api->get_services();

//получить формы
//$res = $api->get_forms();

//получить поля формы
//$res = $api->get_fields(1);

//получить статусы заявок
//$res = $api->get_statuses_lead();

//добавить заявку
//id_field_15 - в конце число - это id поля формы. 
//Можно посмотреть его в админке при редактировании полей формы
//$data['id_field_15'] = 'Вася';
//$data['id_field_16'] = '345243423423';
//$data['id_field_18'] = 'fdgdgdfg4@mail.ru';
//$data['id_form'] = 7; //id формы. Можно посмотреть в админке в разделе Формы
//$res = $api->add_lead($data);

//получить данные заявки
//$res = $api->get_lead(84);

//получить данные заказа
//$res = $api->get_order(365);

//var_dump($res);
