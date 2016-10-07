<?php
/*
* Библиотека для работы с AutoOrder по API
 * Можно использовать для любого PHP скрипта на любом фреймворке.
 * Ответы от сервера приходят в формате JSON
 * Передаются на сервер в POST
 * 
 * @url http://autoorder.biz/
 * @docs http://autoorder.biz/help/api/
 * @autor http://krotovroman.ru 
*/
class ApiAutoOrder {
    
    const VERSION = '0.1';
    private $url_autoorder = 'http://autoorder.biz/api/';
    
    /*
     * Получить данные заказа
     * $id - id заказа
     * @return array
     */
    public function get_order($id) {
        return $this->api('get_order', array('id' => $id));
    }
    
    /*
     * Получить данные заявки
     * $id - id заявки
     * @return array
     */
    public function get_lead($id) {
        return $this->api('get_lead', array('id' => $id));
    }
    
    /*
     * Добавить заявку
     * @return int - id заявки
     */
    public function add_lead($data) {
        return $this->api('add_lead', $data);
    }
    
    /*
     * Получить статусы заявок
     * $id - id статуса
     * @return array
     */
    public function get_statuses_lead($id = FALSE) {
        return (!$id) ? $this->api('get_statuses_lead') : $this->api('get_statuses_lead', array('id' => $id));
    }
    
    /*
     * Получить поля формы
     * $id - id формы
     * @return array
     */
    public function get_fields($id) {
        return $this->api('get_fields', array('id' => $id));
    }
    
    /*
     * Получить формы/форму
     * $id - id формы
     * @return array
     */
    public function get_forms($id = FALSE) {
        return (!$id) ? $this->api('get_forms') : $this->api('get_forms', array('id' => $id));
    }
    
    /*
     * Получить услуги/услугу
     * $id - id услуги
     * @return array
     */
    public function get_services($id = FALSE) {
        return (!$id) ? $this->api('get_services') : $this->api('get_services', array('id' => $id));
    }
    
    /*
     * Получить способы оплаты подключенные в аккаунте
     * $id - id конкретного способа оплаты который нужно получить
     * @return array - массив названий и описаний способов оплаты с id
     */
    public function get_types_pay($id = FALSE) {
        return (!$id) ? $this->api('get_types_pay') : $this->api('get_types_pay', array('id' => $id));
    }
    
    /*
     * Получить типы товаров
     * $id - id типа товара
     * @return array
     */
    public function get_types_product($id = FALSE) {
        return (!$id) ? $this->api('get_types_product') : $this->api('get_types_product', array('id' => $id));
    }
    
    /*
     * Получить категории/категорию товаров
     * $id - id категории, не обязательный параметр
     * @return array
     */
    public function get_categoryes($id = FALSE) {
        return (!$id) ? $this->api('get_categoryes') : $this->api('get_categoryes', array('id' => $id));
    }
    
    /*
     * Получить товары или товар
     * $id - id товара, не обязательный параметр
     * @return array
     */
    public function get_products($id = FALSE) {
        return (!$id) ? $this->api('get_products') : $this->api('get_products', array('id' => $id));
    }
    
    /*
     * Добавить заказ
     * @return int - id заказа в системе AutoOrder
     */
    public function add_order($data) {
        return $this->api('add_order', $data);
    }    
   
    /**
     * Запрос через POST 
     * @param String $methodName - имя метода в API, который вызываем
     * @param array $data - параметры, которые передаем, необязательное поле
     * @return mixed|null
     */
    private function api($methodName, $data = array())
    {
        $result = NULL;        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $this->url($methodName));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE); //не выводить на экран ответ сервера
        if(is_array($data) AND count($data) > 0)
        {
            curl_setopt($ch,CURLOPT_POST, count($data));
            curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //не через SSL
        $result = curl_exec($ch);
        if (!$result) {
            $errno = curl_errno($ch);
            $error = curl_error($ch);
        }
        curl_close($ch);
        if (isset($errno) AND isset($error)) {
            throw new \Exception($error, $errno);
        }  
        
        return json_decode($result, TRUE);
    }
            
    /**
     * Генерит локальный хэш
     * @return \ApiAutoOrder
     */
    public function sethash($key, $username) {
        $this->hash = md5($key . $username);
        return $this;
    }
    
    /**
     * Получаем url для обращения к API
     * @return string
     */
    public function url($methodName) {
        return $this->url_autoorder . '/' . $methodName . '/' .$this->hash;
    }

    /*
     * Для подключения к фреймворку Codeigniter
     * Расскомментировать это, а обычный конструктор __construct ниже закомментировать
     * Ложить в папку library
     */
//    public function ApiAutoOrder($config) {        
//        if (isset($config['key']) AND isset($config['username'])) {
//            $this->sethash($config['key'], $config['username']);
//        }
//    }
    
    /*
     * Для подключения библиотеки к любому PHP скрипту
     * Если нужно подключить к фреймворку Codeigniter, то это нужно заккомментировать
     */
    public function __construct($config){
        if (isset($config['key']) AND isset($config['username'])) {
            $this->sethash($config['key'], $config['username']);
        }
    }
}
