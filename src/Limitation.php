<?php

declare(strict_types=1);

namespace Venomousboy\DoctrineSearchExpression;

use Venomousboy\SearchQuery\LimitationQueryImmutable;
use Doctrine\Common\Collections\Criteria;

final class Limitation
{
    public static function limitation(LimitationQueryImmutable $limitation): Criteria
    {
        return
            Criteria::create()
                ->setFirstResult($limitation->getOffset())
                ->setMaxResults($limitation->getLimit())
            ;
    }
}