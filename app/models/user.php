<?php
use Phalcon\Mvc\Model;
class user extends Model
{
    public $id;
    public $username;
    public $password;
    public $status;
}