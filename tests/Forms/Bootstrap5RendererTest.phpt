<?php

declare(strict_types=1);

namespace Tests\Forms;

use Flexsyscz\Forms\Renderers\Bootstrap5;
use Nette;
use Tester\Assert;
use Tester\TestCase;
use Tests\Resources\MyForm;

require __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class Bootstrap5RendererTest extends TestCase
{
	public function setUp(): void
	{
	}


	public function testControl(): void
	{
		$form = new MyForm;
		$form->onRender[] = function(Nette\Forms\Form $form) {
			Bootstrap5::make($form, [
				Bootstrap5::OptionButtonClass => [
					'primary' => 'btn btn-success',
					'secondary' => 'btn btn-outline-light',
				],
			]);

			$submit = $form->getComponent('submit');
			Assert::true($submit instanceof Nette\Forms\Controls\SubmitButton, sprintf('Expected %s', Nette\Forms\Controls\SubmitButton::class));

			if($submit instanceof Nette\Forms\Controls\SubmitButton) {
				Assert::contains('class="btn btn-success"', $submit->getControl()->toHtml(), '');
			}
		};

		$form->addText('name', 'Name')
			->setRequired('Name is required.');

		$form->addSubmit('submit', 'Submit');
		$form->render();
	}
}

(new Bootstrap5RendererTest())->run();
