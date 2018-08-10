<?php

namespace SnowIO\AkeneoDataModel\Event;

use SnowIO\AkeneoDataModel\AssetVariationData;

final class AssetVariationDeletedEvent extends EntityStateEvent
{
    public static function fromJson(array $json)
    {
        $assetVariation = AssetVariationData::fromJson($json);
        return new self(
            $assetVariation->getAsset(),
            null,
            $assetVariation,
            (int)$json['@timestamp'],
            (int)$json['@timestamp']
        );
    }

    public function getAssetCode(): string
    {
        return $this->getEntityIdentifier();
    }

    public function getPreviousAssetVariation(): AssetVariationData
    {
        return $this->getPreviousEntityData();
    }
}