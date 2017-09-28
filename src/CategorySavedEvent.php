<?php
namespace SnowIO\AkeneoDataModel;

class CategorySavedEvent
{
    public static function fromJson(array $json): self
    {
        $oldData = isset($json['old']) ? Category::fromJson($json['old']) : null;
        $newData = Category::fromJson($json['new']);
        return new self($newData, $oldData);
    }

    public function getCode(): string
    {
        return $this->newData->getCode();
    }

    public function getNewData(): Category
    {
        return $this->newData;
    }

    public function getOldData(): ?Category
    {
        return $this->oldData;
    }

    private $newData;
    private $oldData;

    private function __construct(Category $newData, Category $oldData = null)
    {
        $this->newData = $newData;
        $this->oldData = $oldData;
    }
}
