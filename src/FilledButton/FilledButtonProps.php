<?php

namespace Phx\Molecule\FilledButton;

use Phx\Core\CommonProps;
use Phx\Core\Shape;
use Phx\Atom\Icon\IconVariant;

final class FilledButtonProps
{
	public CommonProps $common;
	public CommonProps $label_common;
	public CommonProps $icon_common;

	final public function __construct(
		public string $label,
		public ?IconVariant $icon = null,
		public FilledButtonVariant $variant = FilledButtonVariant::ELEVATED,
		public FilledButtonSize $size = FilledButtonSize::S,
		public Shape $shape = Shape::ROUND,
		public bool $toggleable = false,
		public bool $toggled = false,
		?CommonProps $common = null,
		?CommonProps $label_common = null,
		?CommonProps $icon_common = null,
	) {
		$this->common = $common ?? new CommonProps();
		$this->label_common = $label_common ?? new CommonProps();
		$this->icon_common = $icon_common ?? new CommonProps();
	}
}
