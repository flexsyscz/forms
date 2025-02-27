<?php

declare(strict_types=1);

namespace Flexsyscz\Forms\Traits;


trait DynamicValues
{
	private array $_values = [];


	public function __set(string $name, mixed $value): void
	{
		$this->_values[$name] = $value;
	}


	public function __isset(string $name): bool
	{
		return isset($this->_values[$name]);
	}


	public function __get(string $name): mixed
	{
		return $this->_values[$name] ?? null;
	}
}
