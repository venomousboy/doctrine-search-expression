<?php

declare(strict_types=1);

namespace Venomousboy\DoctrineSearchExpression;

use Venomousboy\SearchQuery\FuzzySearchQuery;
use Doctrine\Common\Collections\Criteria;

final class FuzzySearchBuilder
{
    public static function search(FuzzySearchQuery $searchQuery, array $fields): Criteria
    {
        $criteria = Criteria::create();

        if ($searchQuery->getQuery()) {
            $exprList = [];
            foreach ($searchQuery->getProperties() as $property) {
                if (in_array($property, $fields)) {
                    $exprList[] = Criteria::expr()->contains($property, $searchQuery->getQuery());
                }
            }

            if (count($exprList) !== 0) {
                $criteria->andWhere(
                    Criteria::expr()->orX(... $exprList)
                );
            }
        }

        return $criteria;
    }
}