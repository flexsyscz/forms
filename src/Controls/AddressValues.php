<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Controls;


class AddressValues
{
	public function __construct(
		public ?string $street = null,
		public ?string $streetNo = null,
		public ?string $city = null,
		public ?string $zipCode = null,
		public ?string $country = null,
	) {}
}
