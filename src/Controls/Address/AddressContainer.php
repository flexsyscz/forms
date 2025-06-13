<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Controls\Address;

use Nette\Forms\Container;
use Nette\Forms\Form;


class AddressContainer extends Container
{
	/**
	 * @param string $name
	 * @param string[]|null $countries
	 */
	public function __construct(string $name, ?array $countries = null)
	{
		$this->addText('street', sprintf('%s.street.label', $name))
			->setRequired(sprintf('%s.street.rules.required', $name))
			->addRule(Form::MaxLength, sprintf('%s.street.rules.maxLength', $name), 160);

		$this->addText('streetNo', sprintf('%s.streetNo.label', $name))
			->setRequired(sprintf('%s.streetNo.rules.required', $name))
			->addRule(Form::MaxLength, sprintf('%s.streetNo.rules.maxLength', $name), 20);

		$this->addText('city', sprintf('%s.city.label', $name))
			->setRequired(sprintf('%s.city.rules.required', $name))
			->addRule(Form::MaxLength, sprintf('%s.city.rules.maxLength', $name), 100);

		$this->addText('zipCode', sprintf('%s.zipCode.label', $name))
			->setRequired(sprintf('%s.streetNo.rules.required', $name))
			->addRule(Form::MaxLength, sprintf('%s.streetNo.rules.maxLength', $name), 10);

		if ($countries) {
			$this->addSelect('country', sprintf('%s.country.label', $name))
				->setPrompt(sprintf('%s.country.prompt', $name))
				->setItems($countries)
				->setRequired(sprintf('%s.country.rules.required', $name));
		}
	}
}
