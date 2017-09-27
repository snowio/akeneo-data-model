<?php
namespace SnowIO\AkeneoDataModel;

class Category
{
    public function getCode(): string
    {
        return $this->code;
    }

    public function getParent(): string
    {
        return $this->parent;
    }

    public function getReference(): CategoryReference
    {
        return $this->reference;
    }

    public function getLabels(): array
    {
        return $this->labels;
    }

    public function getLabel(string $locale): ?string
    {
        return $this->labels[$locale] ?? null;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public static function fromJson(array $json): self
    {
        $category = new self;
        $category->code = $json['code'];
        $category->parent = $json['parent'];
        $category->reference = CategoryReference::of($json['path']);
        $category->labels = $json['labels'];
        $category->timestamp = $json['@timestamp'];
        return $category;
    }

    public function toJson(): array
    {
        return [
            'code' => $this->code,
            'parent' => $this->parent,
            'path' => $this->reference->getPath(),
            'labels' => $this->labels,
            '@timestamp' => $this->timestamp,
        ];
    }

    private $code;
    private $parent;
    /** @var CategoryReference $reference*/
    private $reference;
    private $labels;
    private $timestamp;

    private function __construct()
    {
    }
}
