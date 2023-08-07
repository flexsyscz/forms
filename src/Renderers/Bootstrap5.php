<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Renderers;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\Form;


class Bootstrap5 implements Renderer
{
	public const OptionButtonClass = 'buttonClass';
	public const OptionSwitch = 'switch';

	public const DefaultPrimaryButtonClass = 'btn btn-primary';
	public const DefaultSecondaryButtonClass = 'btn btn-outline-secondary';


	/**
	 * @param Form $form
	 * @param array<array<string>> $options
	 * @return void
	 */
	public static function make(Form $form, array $options = []): void
	{
		$primaryButtonClass = $options[self::OptionButtonClass]['primary'] ?? self::DefaultPrimaryButtonClass;
		$secondaryButtonClass = $options[self::OptionButtonClass]['secondary'] ?? self::DefaultSecondaryButtonClass;

		$renderer = $form->getRenderer();
		if (isset($renderer->wrappers)) {
			$renderer->wrappers['controls']['container'] = $options['controls']['container'] ?? 'div class="container form-controls"';
			$renderer->wrappers['pair']['container'] = $options['pair']['container'] ?? 'div class="row mb-3"';
			$renderer->wrappers['pair']['.error'] = $options['pair']['.error'] ?? 'has-danger';
			$renderer->wrappers['control']['container'] = $options['control']['container'] ?? 'div class="col-sm-9"';
			$renderer->wrappers['label']['container'] = $options['label']['container'] ?? 'div class="col-sm-3 col-form-label"';
			$renderer->wrappers['control']['description'] = $options['control']['description'] ?? 'span class="form-text"';
			$renderer->wrappers['control']['errorcontainer'] = $options['control']['errorcontainer'] ?? 'span class="form-control-feedback"';
			$renderer->wrappers['control']['erroritem'] = $options['control']['erroritem'] ?? 'span class="invalid-feedback"';
			$renderer->wrappers['control']['.error'] = $options['control']['.error'] ?? 'is-invalid';
			$renderer->wrappers['hidden']['container'] = $options['hidden']['container'] ?? 'div class="container form-hidden-controls"';
		}

		foreach ($form->getControls() as $control) {
			if ($control instanceof BaseControl) {
				$type = $control->getOption('type');
				if ($control instanceof Button) {
					$btnClass = $control->getOption(self::OptionButtonClass);
					$control->getControlPrototype()->setAttribute('class', empty($usedPrimary) ? $primaryButtonClass : $btnClass ?? $secondaryButtonClass);
					$usedPrimary = true;

				} elseif ($control instanceof TextBase) {
					$control->getControlPrototype()->setAttribute('class', 'form-control');

				} elseif ($control instanceof SelectBox) {
					$control->getControlPrototype()->setAttribute('class', 'form-select');

				} elseif ($control instanceof UploadControl) {
					$control->getControlPrototype()->setAttribute('class', 'form-control form-control-file');

				} elseif ($control instanceof Checkbox || $control instanceof RadioList) { // @todo test & add checkbox list
					if ($control instanceof Checkbox) {
						$control->getLabelPrototype()->setAttribute('class', 'form-check-label');
					} else {
						$control->getItemLabelPrototype()->setAttribute('class', 'form-check-label');
					}

					$control->getControlPrototype()->setAttribute('class', 'form-check-input');
					if ($control->getOption(self::OptionSwitch)) {
						$control->getContainerPrototype()->setName('div')->setAttribute('class', 'form-check form-switch');

					} else {
						$control->getContainerPrototype()->setName('div')->setAttribute('class', 'form-check');
					}
				}
			}
		}
	}
}
