<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Renderers;

use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Form;


class Bootstrap5 implements Renderer
{
	public const OPTION_BUTTON_CLASS = 'buttonClass';
	public const OPTION_SWITCH = 'switch';

	public const DEFAULT_PRIMARY_BUTTON_CLASS = 'btn btn-primary';
	public const DEFAULT_SECONDARY_BUTTON_CLASS = 'btn btn-outline-secondary';


	/**
	 * @param Form $form
	 * @param array<array<string>> $options
	 * @return void
	 */
	public static function make(Form $form, array $options = []): void
	{
		$primaryButtonClass = $options[self::OPTION_BUTTON_CLASS]['primary'] ?? self::DEFAULT_PRIMARY_BUTTON_CLASS;
		$secondaryButtonClass = $options[self::OPTION_BUTTON_CLASS]['secondary'] ?? self::DEFAULT_SECONDARY_BUTTON_CLASS;

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
			$type = $control->getOption('type');
			if ($type === 'button') {
				$btnClass = $control->getOption(self::OPTION_BUTTON_CLASS);
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? $primaryButtonClass : $btnClass ?? $secondaryButtonClass);
				$usedPrimary = true;

			} elseif (in_array($type, ['text', 'textarea'], true)) {
				$control->getControlPrototype()->addClass('form-control');

			} elseif ($type === 'select') {
				$control->getControlPrototype()->addClass('form-select');

			} elseif ($type === 'file') {
				$control->getControlPrototype()->addClass('form-control form-control-file');

			} elseif (in_array($type, ['checkbox', 'radio'], true)) {
				if ($control instanceof Checkbox) {
					$control->getLabelPrototype()->setAttribute('class', 'form-check-label');
				} else {
					$control->getItemLabelPrototype()->addClass('form-check-label');
				}

				$control->getControlPrototype()->setAttribute('class', 'form-check-input');
				if ($control->getOption(self::OPTION_SWITCH)) {
					$control->getContainerPrototype()->setName('div')->setAttribute('class', 'form-check form-switch');

				} else {
					$control->getContainerPrototype()->setName('div')->setAttribute('class', 'form-check');
				}
			}
		}
	}
}
