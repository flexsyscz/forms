<?php

declare(strict_types=1);

namespace Tests\Resources;

use Flexsyscz\Forms\Traits\Address;
use Nette;


class MyForm extends Nette\Forms\Form
{
	use Address;
}
