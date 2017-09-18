<?php
namespace SnowIO\AkeneoDataModel;

class CategoryReference
{
    public static function of(array $path): self
    {
        if (empty($path)) {
            throw new \Error('Path must not be empty but an empty array was specified.');
        }
        foreach ($path as $categoryCode) {
            if (!\is_string($categoryCode)) {
                throw new \Error('Path must only contain strings but a non-strong was specified.');
            }
        }
        if ($path !== \array_unique($path)) {
            throw new \Error('Path contains at least one duplicate category code.');
        }
        return new self($path);
    }

    public function getRootCategoryCode(): string
    {
        return \reset($this->path);
    }

    public function getCategoryCode(): string
    {
        return \end($this->path);
    }

    public function getPath(): array
    {
        return $this->path;
    }

    public function getLevel(): int
    {
        return \count($this->path);
    }

    public function isDescendantOf(string $categoryCode): bool
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
