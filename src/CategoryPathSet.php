<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class CategoryPathSet implements \IteratorAggregate
{
    public static function of(array $categoryPaths): self
    {
        return new CategoryPathSet($categoryPaths);
    }

    public static function create(): self
    {
        return self::of([]);
    }

    public static function fromJson(array $json): self
    {
        $references = [];
        foreach ($json as $categoryCodes) {
            $references[] = CategoryPath::of($categoryCodes);
        }
        return new CategoryPathSet($references);
    }

    /**
     * @return string[]
     */
    public function getCategoryCodes(): array
    {
        return \array_map(
            function (CategoryPath $reference) {
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
        return $this->filter(function (CategoryPath $categoryPath) use ($ancestorCategoryCode) {
            return $categoryPath->contains($ancestorCategoryCode);
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
