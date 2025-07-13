<?php
class UserService {
    public function getUser($id) {
        $users = [
            1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com'],
            2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com'],
        ];

        return isset($users[$id]) ? $users[$id] : null;
    }
}

ini_set("soap.wsdl_cache_enabled", "0");
$server = new SoapServer(null, ['uri' => 'http://localhost']);
$server->setClass('UserService');
$server->handle();
