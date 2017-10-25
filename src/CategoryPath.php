<?php
namespace SnowIO\AkeneoDataModel;

class CategoryPath
{
    public static function of(array $categoryCodes): self
    {
        if (empty($categoryCodes)) {
            throw new AkeneoDataException('Path must not be empty but an empty array was specified.');
        }
        foreach ($categoryCodes as $categoryCode) {
            if (!\is_string($categoryCode)) {
                throw new AkeneoDataException('Path must only contain strings but a non-strong was specified.');
            }
        }
        if ($categoryCodes !== \array_unique($categoryCodes)) {
            throw new AkeneoDataException('Path contains at least one duplicate category code.');
        }
        return new self($categoryCodes);
    }

    public function getCategoryCode(): string
    {
        return \end($this->path);
    }

    public function getRootCategoryCode(): string
    {
        return \reset($this->path);
    }

    public function getLevel(): int
    {
        return \count($this->path);
    }

    public function toArray(): array
    {
        return $this->path;
    }

    public function contains(string $categoryCode): bool
    {
        if ($categoryCode === $this->getCategoryCode()) {
            return false;
        }
        foreach ($this->path as $ancestor) {
            if ($categoryCode === $ancestor) {
                return true;
            }
        }
        return false;
    }

    private $path;

    private function __construct(array $path)
    {
        $this->path = $path;
    }
}
