<?php
namespace SnowIO\AkeneoDataModel;

class CategoryReferenceSet implements \IteratorAggregate
{
    public static function of(array $categories): self
    {
        return new CategoryReferenceSet($categories);
    }

    public static function empty(): self
    {
        return self::of([]);
    }

    public static function fromJson(array $json): self
    {
        $references = [];
        foreach ($json as $categoryCodes) {
            $references[] = CategoryReference::of($categoryCodes);
        }
        return new CategoryReferenceSet($references);
    }

    /**
     * @return string[]
     */
    public function getCategoryCodes(): array
    {
        return \array_map(
            function (CategoryReference $reference) {
                return $reference->getCategoryCode();
            },
            $this->categoryReferences
        );
    }

    public function filter(callable $predicate): self
    {
        $filteredReferences = \array_filter($this->categoryReferences, $predicate);
        return new self($filteredReferences);
    }

    /**
     * The resulting set will include the category identified by $ancestorCategoryCode if that category is part of this
     * CategoryReferenceSet
     */
    public function filterByAncestor(string $ancestorCategoryCode): self
    {
        return $this->filter(function (CategoryReference $reference) use ($ancestorCategoryCode) {
            return $reference->isDescendantOf($ancestorCategoryCode)
            || $reference->getCategoryCode() === $ancestorCategoryCode;
        });
    }

    public function isEmpty(): bool
    {
        return empty($this->categoryReferences);
    }

    public function getIterator(): \Iterator
    {
        foreach ($this->categoryReferences as $reference) {
            yield $reference;
        }
    }

    private $categoryReferences;

    private function __construct(array $categoryReferences)
    {
        $this->categoryReferences = $categoryReferences;
    }
}
