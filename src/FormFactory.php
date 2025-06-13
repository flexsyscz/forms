<?php

declare(strict_types=1);

namespace Flexsyscz\Forms;

use Nette;


abstract class FormFactory
{
	public function create(?callable $onRender = null): Nette\Application\UI\Form
	{
		$form = new Nette\Application\UI\Form();
		$form->onRender[] = $onRender ?? Nette\Utils\Callback::check([$this, 'onRender']);

		return $form;
	}


	abstract public function onRender(Nette\Application\UI\Form $form): void;
}
