<?php
namespace SnowIO\AkeneoDataModel;

class SingleChannelVariantGroupDataSet
{
    /**
     * @param SingleChannelVariantGroupData[] $items
     */
    public static function of(array $items): self
    {
        $channels = [];
        foreach ($items as $item) {
            if (!$item instanceof SingleChannelVariantGroupData) {
                throw new \Error('Items must be instances of ' . SingleChannelVariantGroupData::class . ' but something else was specified.');
            }
            $channel = $item->getChannel();
            if (\in_array($channel, $channels)) {
                throw new \Error("Duplicate channel specified $channel");
            }
            $channels[] = $channel;
        }
        return new self($items);
    }

    public static function fromJson(array $json): self
    {
        $items = [];
        foreach ($json as $itemJson) {
            $items[] = SingleChannelVariantGroupData::fromJson($itemJson);
        }
        return self::of($items);
    }

    public function getMultiChannelData(): ?MultiChannelVariantGroupData
    {
        if ($this->isEmpty()) {
            throw new \Error();
        }

        $dataForMostRecentlyUpdatedChannel = $this->getDataForMostRecentlyUpdatedChannel();
        $mostRecentlyUpdatedChannel = $dataForMostRecentlyUpdatedChannel->getChannel();
        $properties = $dataForMostRecentlyUpdatedChannel->getProperties();
        $attributeValues = $this->getAttributeValues();
        $attributeOptions = $this->getAttributeOptions();
        return MultiChannelVariantGroupData::of($properties, $attributeValues, $attributeOptions, $mostRecentlyUpdatedChannel);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /** @var SingleChannelVariantGroupData[] */
    private $items;

    private function __construct(array $items)
    {
        $this->items = $items;
    }

    private function getDataForMostRecentlyUpdatedChannel(): SingleChannelVariantGroupData
    {
        $newest = \reset($this->items);
        foreach ($this->items as $singleChannelData) {
            if ($singleChannelData->getTimestamp() > $newest->getTimestamp()) {
                $newest = $singleChannelData;
            }
        }
        return $newest;
    }

    private function getAttributeValues(): AttributeValueSet
    {
        $attributeValues = $this->getDataForMostRecentlyUpdatedChannel()->getAttributeValues()
            ->filter(function (AttributeValue $attributeValue) {
                return $attributeValue->getScope()->getChannel() === null;
            });

        foreach ($this->items as $item) {
            $attributeValues = $item->getAttributeValues()
                ->filter(function (AttributeValue $attributeValue) {
                    return $attributeValue->getScope()->getChannel() !== null;
                })
                ->add($attributeValues);
        }

        return $attributeValues;
    }

    private function getAttributeOptions(): AttributeOptionSet
    {
        $items = $this->items;
        \usort($items, function (SingleChannelProductData $productData1, SingleChannelProductData $productData2) {
            return $productData1->getTimestamp() - $productData2->getTimestamp();
        });
        $attributeOptions = AttributeOptionSet::empty();
        /** @var SingleChannelProductData $item */
        foreach ($items as $item) {
            $attributeOptions = $attributeOptions->merge($item->getAttributeOptions());
        }
        return $attributeOptions;
    }
}
