<?php

namespace app\database\models;

use app\traits\Create;
use app\traits\Delete;
use app\traits\Read;
use app\traits\Update;
use PDOException;

abstract class BaseModel
{
    use Create, Read, Update, Delete;
}