<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Renderers;

use Nette\Forms\Form;


interface Renderer
{
	static function make(Form $form): void;
}
