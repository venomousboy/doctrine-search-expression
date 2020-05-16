<?php

declare(strict_types=1);

namespace Venomousboy\DoctrineSearchExpression;

use Venomousboy\SearchQuery\FilterQuery;
use Doctrine\Common\Collections\Criteria;

final class CriteriaBuilder
{
    /**
     * @param FilterQuery[] $filters
     * @return \Doctrine\Common\Collections\Criteria
     */
    public static function createByFilters(array $filters): Criteria
    {
        $criteria = Criteria::create();

        foreach ($filters as $filter) {
            $criteria->andWhere(Filter::makeExpression($filter));
        }

        return $criteria;
    }
}