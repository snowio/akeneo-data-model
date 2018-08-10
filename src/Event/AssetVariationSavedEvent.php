<?php
namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AssetVariationData;

final class AssetVariationSavedEvent extends EntityStateEvent
{
    public static function fromJson(array $json): self
    {
        $currentData = AssetVariationData::fromJson($json['new']);
        $currentTimestamp = (int)$json['new']['@timestamp'];
        if (isset($json['old'])) {
            $previousData = AssetVariationData::fromJson($json['old']);
            $previousTimestamp = (int)$json['old']['@timestamp'];
        } else {
            $previousData = null;
            $previousTimestamp = null;
        }
        return new self(
            $currentData->getAsset(),
            $currentData,
            $previousData,
            $currentTimestamp,
            $previousTimestamp
        );
    }

    public function getAssetCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getChannel(): string
    {
        return $this->getCurrentAssetVariationData()->getChannel();
    }

    public function getCurrentAssetVariationData(): AssetVariationData
    {
        return $this->getCurrentEntityData();
    }

    public function getPreviousAssetVariationData(): ?AssetVariationData
    {
        return $this->getPreviousEntityData();
    }

    public function hasPreviousFamilyVariantData(): bool
    {
        return $this->hasPreviousEntityData();
    }
}