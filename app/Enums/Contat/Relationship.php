<?php

namespace App\Enums\Contat;

enum Relationship: string
{
    case FATHER = 'Pare';
    case MOTHER = 'Mare';
    case SON = 'Fill';
    case DAUGHTER = 'Filla';
    case BROTHER = 'Germà';
    case SISTER = 'Germana';
    case GRANDFATHER = 'Avi';
    case GRANDMOTHER = 'Àvia';
    case UNCLE = 'Oncle';
    case AUNT = 'Tia';
    case COUSIN = 'Cosí/Cosina';
    case FRIEND = 'Amic/Amiga';
}
