<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class CategoryPath
{
    public static function of(array $categoryCodes): self
    {
        if (empty($categoryCodes)) {
            throw new AkeneoDataException('Path must not be empty but an empty array was specified.');
        }
        $result = new self;
        foreach ($categoryCodes as $categoryCode) {
            if (!\is_string($categoryCode)) {
                throw new AkeneoDataException('Path must only contain strings but a non-strong was specified.');
            }
            if (\in_array($categoryCode, $result->path, $strict = true)) {
                throw new AkeneoDataException('Path must not contain duplicate category codes.');
            }
            $result->path[] = $categoryCode;
        }
        return $result;
    }

    public function getCategoryCode(): string
    {
        $level = $this->getLevel();
        return $this->path[$level - 1];
    }

    public function getRootCategoryCode(): string
    {
        return $this->path[0];
    }

    public function getParentCategoryCode(): ?string
    {
        $level = $this->getLevel();
        if ($level == 1) {
            return null;
        }
        return $this->path[$level - 2];
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
        foreach ($this->path as $ancestor) {
            if ($categoryCode === $ancestor) {
                return true;
            }
        }
        return false;
    }

    public function equals($other)
    {
        return $other instanceof self && $other->path === $this->path;
    }

    private $path = [];

    private function __construct()
    {

    }
}
