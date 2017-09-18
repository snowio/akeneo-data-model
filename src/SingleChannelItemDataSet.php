<?php
namespace SnowIO\AkeneoDataModel;

abstract class SingleChannelItemDataSet
{
    /**
     * @param SingleChannelItemData[] $items
     * @return static
     */
    public static function of(array $items)
    {
        $channels = [];
        foreach ($items as $item) {
            if (!$item instanceof SingleChannelItemData) {
                throw new \Error('Items must be instances of ' . SingleChannelItemData::class . ' but something else was specified.');
            }
            $channel = $item->getChannel();
            if (\in_array($channel, $channels)) {
                throw new \Error("Duplicate channel specified $channel");
            }
            $channels[] = $channel;
        }

        $set = new static;
        $set->items = $items;
        return $set;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function getMultiChannelData()
    {
        if ($this->isEmpty()) {
            throw new \Error();
        }

        $dataForMostRecentlyUpdatedChannel = $this->getDataForMostRecentlyUpdatedChannel();
        return $this->createMultiChannelItemData($dataForMostRecentlyUpdatedChannel)
            ->withAttributeValues($this->getAttributeValues())
            ->withAttributeOptions($this->getAttributeOptions());
    }

    abstract protected function createMultiChannelItemData(SingleChannelItemData $itemData): MultiChannelItemData;

    /** @var SingleChannelItemData[] */
    private $items = [];

    private function __construct()
    {

    }

    private function getDataForMostRecentlyUpdatedChannel(): SingleChannelItemData
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
        \usort($items, function (SingleChannelItemData $itemData1, SingleChannelItemData $itemData2) {
            return $itemData1->getTimestamp() - $itemData2->getTimestamp();
        });
        $attributeOptions = AttributeOptionSet::empty();
        /** @var SingleChannelItemData $item */
        foreach ($items as $item) {
            $attributeOptions = $attributeOptions->merge($item->getAttributeOptions());
        }
        return $attributeOptions;
    }
}
