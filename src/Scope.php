<?php
declare(strict_types=1);
namespace SnowIO\AkeneoDataModel;

class Scope
{
    public static function ofChannel(string $channel): self
    {
        return (new self)->withChannel($channel);
    }

    public static function ofLocale(string $locale): self
    {
        return (new self)->withLocale($locale);
    }

    public static function global(): self
    {
        return new self;
    }

    public function withChannel(string $channel): self
    {
        $scope = clone $this;
        $scope->channel = $channel;
        return $scope;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function withLocale(string $locale): self
    {
        $scope = clone $this;
        $scope->locale = $locale;
        return $scope;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function isGlobal(): bool
    {
        return $this->channel === null && $this->locale === null;
    }

    public function equals(self $otherScope): bool
    {
        return $this->channel === $otherScope->channel && $this->locale === $otherScope->locale;
    }

    private $channel;
    private $locale;

    private function __construct()
    {

    }
}
