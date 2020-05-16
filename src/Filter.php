<?php

declare(strict_types=1);

namespace Venomousboy\DoctrineSearchExpression;

use Venomousboy\SearchQuery\ComparisonType;
use Venomousboy\SearchQuery\FilterQuery;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Ds\Map;

final class Filter
{
    public static function makeExpression(FilterQuery $filter): Comparison
    {
        switch ($filter->getComparison()) {
            case ComparisonType::in():
                $comparison = Criteria::expr()->in($filter->getProperty(), $filter->getValue());
                break;
            case ComparisonType::notIn():
                $comparison = Criteria::expr()->notIn($filter->getProperty(), $filter->getValue());
                break;
            case ComparisonType::isNull():
                $comparison = Criteria::expr()->isNull($filter->getProperty());
                break;
            case ComparisonType::isNotNull():
                $comparison = Criteria::expr()->neq($filter->getProperty(), null);
                break;
            default:
                return new Comparison(
                    $filter->getProperty(),
                    self::mapComparison($filter->getComparison()),
                    $filter->getValue()
                );
        }

        return $comparison;
    }

    private static function mapComparison(ComparisonType $type): string
    {
        $map = new Map();

        $map->put($type::eq(), Comparison::EQ);
        $map->put($type::neq(), Comparison::NEQ);
        $map->put($type::gt(), Comparison::GT);
        $map->put($type::gte(), Comparison::GTE);
        $map->put($type::lt(), Comparison::LT);
        $map->put($type::lte(), Comparison::LTE);

        return $map->get($type);
    }
}