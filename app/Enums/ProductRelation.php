<?php

namespace App\Enums;

enum ProductRelation: string
{
    case Accessory = 'accessory';
    case SparePart = 'spare_part';
    case CrossSell = 'cross_sell';
    case Upsell = 'upsell';
    case Substitute = 'substitute';
}
