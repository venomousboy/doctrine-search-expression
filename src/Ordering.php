<?php

declare(strict_types=1);

namespace Venomousboy\DoctrineSearchExpression;

use Venomousboy\SearchQuery\OrderQuery;
use Doctrine\ORM\QueryBuilder;

final class Ordering
{
    /**
     * @param OrderQuery[] $orderQueries
     */
    public static function add(QueryBuilder $queryBuilder, array $orderQueries): void
    {
        foreach ($orderQueries as $orderQuery) {
            $queryBuilder->orderBy($orderQuery->getProperty(), $orderQuery->getOrdering());
        }
    }
}