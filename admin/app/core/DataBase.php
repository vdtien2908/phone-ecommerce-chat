<?php
class DataBase
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'e_commerce_app';

    public function HandleConnect()
    {
        $connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
        mysqli_set_charset($connect, 'utf8');
        if (mysqli_connect_errno() === 0) {
            return $connect;
        }
        return false;
    }
}
