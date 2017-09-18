<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelProductDataSet extends SingleChannelItemDataSet
{
    /**
     * @param SingleChannelProductData[] $items
     */
    public static function of(array $items): self
    {
        foreach ($items as $item) {
            if (!$item instanceof SingleChannelProductData) {
                throw new \Error('Items must be instances of ' . SingleChannelProductData::class . ' but something else was specified.');
            }
        }
        return parent::of($items);
    }

    public static function fromJson(array $json): self
    {
        $items = [];
        foreach ($json as $itemJson) {
            $items[] = SingleChannelProductData::fromJson($itemJson);
        }
        return self::of($items);
    }

    public function getMultiChannelData(): MultiChannelProductData
    {
        return parent::getMultiChannelData();
    }

    protected function createMultiChannelItemData(SingleChannelItemData $itemData): MultiChannelItemData
    {
        if (!$itemData instanceof SingleChannelProductData) {
            throw new \InvalidArgumentException;
        }
        return MultiChannelProductData::of($itemData->getProperties());
    }
}
