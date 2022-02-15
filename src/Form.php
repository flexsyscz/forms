<?php

declare(strict_types=1);

namespace Flexsyscz\Forms;

use Flexsyscz\Forms\Controls\AddressContainer;
use Nette;


class Form extends Nette\Forms\Form
{
	/**
	 * @param string $name
	 * @param string[]|null $countries
	 * @return AddressContainer
	 */
	public function addAddress(string $name, array $countries = null): AddressContainer
	{
		$address = new AddressContainer($name, $countries);
		$this->addComponent($address, $name);

		return $address;
	}
}
