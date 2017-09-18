<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelVariantGroupDataSet extends SingleChannelItemDataSet
{
    /**
     * @param SingleChannelVariantGroupData[] $items
     */
    public static function of(array $items): self
    {
        foreach ($items as $item) {
            if (!$item instanceof SingleChannelVariantGroupData) {
                throw new \Error('Items must be instances of ' . SingleChannelVariantGroupData::class . ' but something else was specified.');
            }
        }
        return parent::of($items);
    }

    public static function fromJson(array $json): self
    {
        $items = [];
        foreach ($json as $itemJson) {
            $items[] = SingleChannelVariantGroupData::fromJson($itemJson);
        }
        return self::of($items);
    }

    public function getMultiChannelData(): MultiChannelVariantGroupData
    {
        return parent::getMultiChannelData();
    }

    protected function createMultiChannelItemData(SingleChannelItemData $itemData): MultiChannelItemData
    {
        if (!$itemData instanceof SingleChannelVariantGroupData) {
            throw new \InvalidArgumentException;
        }
        return MultiChannelVariantGroupData::of($itemData->getProperties());
    }
}
