<?php

namespace App;
enum Role: string
{
    case ADMIN = 'ADMIN';
    case GESTOR = 'GESTOR';
    case DEVELOPER = 'DEVELOPER';
    case CLIENT = 'CLIENT';
}
