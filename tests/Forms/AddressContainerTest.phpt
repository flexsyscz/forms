<?php

declare(strict_types=1);

namespace Tests\Forms;

use Nette;
use Tester\Assert;
use Tester\TestCase;
use Tests\Resources\MyForm;

require __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class AddressContainerTest extends TestCase
{
	public function setUp(): void
	{
	}


	public function testControl(): void
	{
		$form = new MyForm;
		$address = $form->addAddress('billingAddress');

		$street = $address->getComponent('street');
		$streetNo = $address->getComponent('streetNo');
		$city = $address->getComponent('city');
		$zipCode = $address->getComponent('zipCode');

		Assert::true($street instanceof Nette\Forms\Controls\TextInput, sprintf('Expected %s', Nette\Forms\Controls\TextInput::class));
		Assert::true($streetNo instanceof Nette\Forms\Controls\TextInput, sprintf('Expected %s', Nette\Forms\Controls\TextInput::class));
		Assert::true($city instanceof Nette\Forms\Controls\TextInput, sprintf('Expected %s', Nette\Forms\Controls\TextInput::class));
		Assert::true($zipCode instanceof Nette\Forms\Controls\TextInput, sprintf('Expected %s', Nette\Forms\Controls\TextInput::class));

		Assert::throws(function() use ($address) {
			$address->getComponent('country');
		}, Nette\InvalidArgumentException::class);

		$address = $form->addAddress('deliveryAddress', [
			'cs' => 'Czech Republic',
			'de' => 'Germany',
			'uk' => 'United Kingdom',
		]);

		$country = $address->getComponent('country');
		Assert::true($country instanceof Nette\Forms\Controls\SelectBox, sprintf('Expected %s', Nette\Forms\Controls\SelectBox::class));
	}
}

(new AddressContainerTest)->run();
