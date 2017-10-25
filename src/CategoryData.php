<?php
namespace SnowIO\AkeneoDataModel;

class CategoryData
{
    public function getCode(): string
    {
        return $this->code;
    }

    public function getParent(): ?string
    {
        return $this->parent;
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

    public static function fromJson(array $json): self
    {
        $category = new self;
        $category->code = $json['code'];
        $category->parent = $json['parent'];
        $category->path = CategoryPath::of($json['path']);
        $category->labels = InternationalizedString::fromJson($json['labels']);
        return $category;
    }

    private $code;
    private $parent;
    /** @var CategoryPath $path*/
    private $path;
    /** @var InternationalizedString */
    private $labels;

    private function __construct()
    {
    }
}
