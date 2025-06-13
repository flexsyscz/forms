<?php
declare(strict_types=1);

namespace Flexsyscz\Forms;

use Nextras\Dbal\Utils\DateTimeImmutable;


class FormValues
{
	public static function toDateTime(string $value, ?string $format = null): DateTimeImmutable
	{
		$formats = $format ? [$format] : [
			'j. n. Y',
			'j. n. Y H:i',
			'j. n. Y H:i:s'
		];

		foreach ($formats as $format) {
			$dateTime = DateTimeImmutable::createFromFormat($format, $value);
			if($dateTime) {
				return new DateTimeImmutable($dateTime->format('Y-m-d H:i:s'));
			}
		}

		throw new InvalidArgumentException(sprintf('Cannot create instance from value %s.', $value));
	}
}
