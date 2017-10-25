<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class FamilyAttributeData
{
    public function getCode(): string
    {
        return $this->code;
    }

    public function isRequired(string $channel): bool
    {
        return $this->isRequired[$channel] ?? false;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public static function fromJson(array $json): self
    {
        $familyAttributeData = new self;
        $familyAttributeData->code = $json['code'];
        $familyAttributeData->isRequired = $json['is_required'];
        $familyAttributeData->group = $json['group'];
        $familyAttributeData->sortOrder = $json['sort_order'];
        return $familyAttributeData;
    }

    private $code;
    private $isRequired;
    private $group;
    private $sortOrder;

    private function __construct()
    {
    }
}
