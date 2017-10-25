<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class CategoryData
{
    public static function of(CategoryPath $path): self
    {
        $categoryData = new self;
        $categoryData->path = $path;
        $categoryData->labels = InternationalizedString::create();
        return $categoryData;
    }

    public function getCode(): string
    {
        return $this->path->getCategoryCode();
    }

    public function getParent(): ?string
    {
        return $this->path->getParentCategoryCode();
    }

    public function getPath(): CategoryPath
    {
        return $this->path;
    }

    public function getLabels(): InternationalizedString
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels->getValue($locale);
    }

    public function withLabels(InternationalizedString $labels): self
    {
        $result = clone $this;
        $result->labels = $labels;
        return $result;
    }

    public function withLabel(LocalizedString $label): self
    {
        $result = clone $this;
        $result->labels = $this->labels->with($label);
        return $result;
    }

    public static function fromJson(array $json): self
    {
        $category = new self;
        $category->path = CategoryPath::of($json['path']);
        $category->labels = InternationalizedString::fromJson($json['labels']);
        return $category;
    }

    /** @var CategoryPath $path*/
    private $path;
    /** @var InternationalizedString */
    private $labels;

    private function __construct()
    {
    }
}
