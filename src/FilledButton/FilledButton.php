<?php

namespace Phx\Molecule\FilledButton;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\TypographyRole;
use Phx\Core\TypographySubRole;
use Phx\Core\BackgroundColor;
use Phx\Core\ForegroundColor;
use Phx\Core\ColorStates;
use Phx\Core\CssColorProperty;
use Phx\Core\Shape;
use Phx\Core\ShadowLevel;
use Phx\Atom\Icon\Icon;
use Phx\Atom\Icon\IconSize;
use Phx\Atom\Label\Label;

final class FilledButton extends Component
{
	final public function __construct() {}

	final public function render(FilledButtonProps $props): Render
	{
		$this->registerCommonProps(common_props: [
			$props->common,
			"icon" => $props->icon_common,
			"label" => $props->label_common,
		]);

		// ICON

		$icon = "";
		if($props->icon !== null) {
			if($props->size === FilledButtonSize::XS || $props->size === FilledButtonSize::S) {
				$icon_size = IconSize::PX20;
			} else if($props->size === FilledButtonSize::M) {
				$icon_size = IconSize::PX24;
			} else if($props->size === FilledButtonSize::L) {
				$icon_size = IconSize::PX32;
			} else {
				$icon_size = IconSize::PX40;
			}

			$icon_class_name = "molecule_filled_button_{$props->variant->value}_icon";
			if($props->variant === FilledButtonVariant::ELEVATED) {
				$default_icon_color = BackgroundColor::PRIMARY;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					toggled_default: ForegroundColor::ON_PRIMARY,
				);
			} else if($props->variant === FilledButtonVariant::FILLED) {
				if($props->toggleable) {
					$icon_class_name .= "_toggleable";
					$default_icon_color = ForegroundColor::ON_SURFACE_VARIANT;
					$color_states = new ColorStates(
						disabled: ForegroundColor::ON_SURFACE,
						toggled_default: ForegroundColor::ON_PRIMARY,
					);
				} else {
					$default_icon_color = ForegroundColor::ON_PRIMARY;
					$color_states = new ColorStates(
						disabled: ForegroundColor::ON_SURFACE,
					);
				}
			} else if($props->variant === FilledButtonVariant::TONAL) {
				$default_icon_color = ForegroundColor::ON_SECONDARY_CONTAINER;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					toggled_default: ForegroundColor::ON_SECONDARY,
				);
			} else if($props->variant === FilledButtonVariant::OUTLINED) {
				$default_icon_color = ForegroundColor::ON_SURFACE_VARIANT;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					toggled_default: ForegroundColor::INVERSE_ON_SURFACE,
				);
			} else {
				$default_icon_color = BackgroundColor::PRIMARY;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
				);
			}

			$this->addCss(
				class_name: $icon_class_name,
				props_id: "icon",
				css: $this->getColorStatesCss(
					color_states: $color_states,
					css_color_property: CssColorProperty::COLOR,
					main_class_name: $icon_class_name,
					disabled_alpha: 0.38,
				),
			);

			if($props->toggled) {
				$this->addClass(
					class_name: "toggled",
					props_id: "icon",
				);
			}
			$this->addClass(
				class_name: $props->disabled ? "disabled" : "enabled",
				props_id: "icon",
			);

			$icon = $this->newComponent(
				component: Icon::class,
				props: [
					"variant" => $props->icon,
					"size" => $icon_size,
					"color" => $default_icon_color,
					"with_copy" => true,
					"common" => $this->getCommonProps(props_id: "icon"),
				],
			);
		}

		// LABEL

		$label_content = $props->label;

		if($props->size === FilledButtonSize::XS || $props->size === FilledButtonSize::S) {
			$label_role = TypographyRole::LABEL;
			$label_sub_role = TypographySubRole::LARGE;
		} else if($props->size === FilledButtonSize::M) {
			$label_role = TypographyRole::BODY;
			$label_sub_role = TypographySubRole::LARGE;

			$label_content = "<b>$label_content</b>";
		} else if($props->size === FilledButtonSize::L) {
			$label_role = TypographyRole::HEADLINE;
			$label_sub_role = TypographySubRole::SMALL;
		} else {
			$label_role = TypographyRole::HEADLINE;
			$label_sub_role = TypographySubRole::LARGE;
		}

		$label_class_name = "molecule_filled_button_{$props->variant->value}_label";
		if($props->variant === FilledButtonVariant::ELEVATED) {
			$default_label_color = BackgroundColor::PRIMARY;
			$color_states = new ColorStates(
				disabled: ForegroundColor::ON_SURFACE,
				toggled_default: ForegroundColor::ON_PRIMARY,
			);
		} else if($props->variant === FilledButtonVariant::FILLED) {
			if($props->toggleable) {
				$label_class_name .= "_toggleable";
				$default_label_color = ForegroundColor::ON_SURFACE_VARIANT;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					toggled_default: ForegroundColor::ON_PRIMARY,
				);
			} else {
				$default_label_color = ForegroundColor::ON_PRIMARY;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
				);
			}
		} else if($props->variant === FilledButtonVariant::TONAL) {
			$default_label_color = ForegroundColor::ON_SECONDARY_CONTAINER;
			$color_states = new ColorStates(
				disabled: ForegroundColor::ON_SURFACE,
				toggled_default: ForegroundColor::ON_SECONDARY,
			);
		} else if($props->variant === FilledButtonVariant::OUTLINED) {
			$default_label_color = ForegroundColor::ON_SURFACE_VARIANT;
			$color_states = new ColorStates(
				disabled: ForegroundColor::ON_SURFACE,
				toggled_default: ForegroundColor::INVERSE_ON_SURFACE,
			);
		} else {
			$default_label_color = BackgroundColor::PRIMARY;
			$color_states = new ColorStates(
				disabled: ForegroundColor::ON_SURFACE,
			);
		}

		$this->addCss(
			class_name: $label_class_name,
			props_id: "label",
			css: $this->getColorStatesCss(
				color_states: $color_states,
				css_color_property: CssColorProperty::COLOR,
				main_class_name: $label_class_name,
				disabled_alpha: 0.38,
			)
		);

		if($props->toggled) {
			$this->addClass(
				class_name: "toggled",
				props_id: "label",
			);
		}
		$this->addClass(
			class_name: $props->disabled ? "disabled" : "enabled",
			props_id: "label",
		);

		$label = $this->newComponent(
			component: Label::class,
			props: [
				"content" => $label_content,
				"role" => $label_role,
				"sub_role" => $label_sub_role,
				"color" => $default_label_color,
				"common" => $this->getCommonProps(props_id: "label"),
			],
		);

		// BUTTON

		$div_target_area_class_name = "molecule_filled_button_div_target_area";
		$div_target_area_css = <<<CSS
		.{$div_target_area_class_name} {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			height: 48px;
			min-height: 48px;
			max-height: 48px;
			flex: 1;
			width: 100%;
		}
		CSS;
		$button_size_class_name = "molecule_filled_button_{$props->size->value}";
		if($props->size === FilledButtonSize::XS) {
			$button_height = "32px";
			$button_padding = "12px";
			$button_gap = "4px";

			$this->addCss(
				class_name: $div_target_area_class_name,
				css: $div_target_area_css,
			);
		} else if($props->size === FilledButtonSize::S) {
			$button_height = "40px";
			$button_padding = "16px";
			$button_gap = "8px";

			$this->addCss(
				class_name: $div_target_area_class_name,
				css: $div_target_area_css,
			);
		} else if($props->size === FilledButtonSize::M) {
			$button_height = "56px";
			$button_padding = "24px";
			$button_gap = "8px";

		} else if($props->size === FilledButtonSize::L) {
			$button_height = "96px";
			$button_padding = "48px";
			$button_gap = "12px";

		} else {
			$button_height = "136px";
			$button_padding = "64px";
			$button_gap = "16px";
		}

		$this->addCss(
			class_name: $button_size_class_name,
			css: <<<CSS
			.{$button_size_class_name} {
				height: $button_height;
				min-height: $button_height;
				max-height: $button_height;
				padding-left: $button_padding;
				padding-right: $button_padding;
				gap: $button_gap;
			}
			CSS,
		);

		$button_variant_class_name = "molecule_filled_button_{$props->variant->value}";
		$button_variant_state_colors_class_name = "{$button_variant_class_name}_state_colors";
		if($props->variant === FilledButtonVariant::ELEVATED) {
			$this->addCss(
				class_name: $button_variant_class_name,
				css: (<<<CSS
				.{$button_variant_class_name} {
					z-index: 1;
				}
				CSS) . $this->getShadowCss(
					class_name: $button_variant_class_name,
					shadow_level: ShadowLevel::L1,
				),
			);

			$button_state_colors = $this->getColorStatesCss(
				color_states: new ColorStates(
					default: BackgroundColor::SURFACE_CONTAINER_LOW,
					disabled: ForegroundColor::ON_SURFACE,
					hover: true,
					focus: true,
					pressed: true,
					toggled_default: BackgroundColor::PRIMARY,
					toggled_hover: true,
					toggled_focus: true,
					toggled_pressed: true,
				),
				css_color_property: CssColorProperty::BACKGROUND_COLOR,
				main_class_name: $button_variant_state_colors_class_name,
				state_color: BackgroundColor::PRIMARY,
				toggled_state_color: ForegroundColor::ON_PRIMARY,
				disabled_alpha: 0.1,
			);
		} else if($props->variant === FilledButtonVariant::FILLED) {
			if($props->toggleable) {
				$button_variant_state_colors_class_name .= "_toggleable";
				$button_state_colors = $this->getColorStatesCss(
					color_states: new ColorStates(
						default: BackgroundColor::SURFACE_CONTAINER,
						disabled: ForegroundColor::ON_SURFACE,
						hover: true,
						focus: true,
						pressed: true,
						toggled_default: BackgroundColor::PRIMARY,
						toggled_hover: true,
						toggled_focus: true,
						toggled_pressed: true,
					),
					css_color_property: CssColorProperty::BACKGROUND_COLOR,
					main_class_name: $button_variant_state_colors_class_name,
					state_color: ForegroundColor::ON_SURFACE_VARIANT,
					toggled_state_color: ForegroundColor::ON_PRIMARY,
					disabled_alpha: 0.1,
				);
			} else {
				$button_state_colors = $this->getColorStatesCss(
					color_states: new ColorStates(
						default: BackgroundColor::PRIMARY,
						disabled: ForegroundColor::ON_SURFACE,
						hover: true,
						focus: true,
						pressed: true,
					),
					css_color_property: CssColorProperty::BACKGROUND_COLOR,
					main_class_name: $button_variant_state_colors_class_name,
					state_color: ForegroundColor::ON_PRIMARY,
					disabled_alpha: 0.1,
				);
			}
		} else if($props->variant === FilledButtonVariant::TONAL) {
			$button_state_colors = $this->getColorStatesCss(
				color_states: new ColorStates(
					default: BackgroundColor::SECONDARY_CONTAINER,
					disabled: ForegroundColor::ON_SURFACE,
					hover: true,
					focus: true,
					pressed: true,
					toggled_default: BackgroundColor::SECONDARY,
					toggled_hover: true,
					toggled_focus: true,
					toggled_pressed: true,
				),
				css_color_property: CssColorProperty::BACKGROUND_COLOR,
				main_class_name: $button_variant_state_colors_class_name,
				state_color: ForegroundColor::ON_SECONDARY_CONTAINER,
				toggled_state_color: ForegroundColor::ON_SECONDARY,
				disabled_alpha: 0.1,
			);
		} else if($props->variant === FilledButtonVariant::OUTLINED) {
			$this->addCss(
				class_name: $button_variant_class_name,
				css: <<<CSS
				.{$button_variant_class_name} {
					background-color: transparent;
					border: 1px solid var(--color-outline-variant);
				}
				CSS,
			);
			$this->colors[ForegroundColor::OUTLINE_VARIANT->value] = ForegroundColor::OUTLINE_VARIANT;


			$button_state_colors = $this->getColorStatesCss(
				color_states: new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					hover: true,
					focus: true,
					pressed: true,
					toggled_default: BackgroundColor::INVERSE_SURFACE,
					toggled_hover: true,
					toggled_focus: true,
					toggled_pressed: true,
				),
				css_color_property: CssColorProperty::BACKGROUND_COLOR,
				main_class_name: $button_variant_state_colors_class_name,
				state_color: ForegroundColor::ON_SURFACE_VARIANT,
				toggled_state_color: ForegroundColor::ON_SURFACE,
				disabled_alpha: 0.1,
			);
		} else {
			$this->addCss(
				class_name: $button_variant_class_name,
				css: <<<CSS
				.{$button_variant_class_name} {
					background-color: transparent;
				}
				CSS,
			);

			$button_state_colors = $this->getColorStatesCss(
				color_states: new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					hover: true,
					focus: true,
					pressed: true,
				),
				css_color_property: CssColorProperty::BACKGROUND_COLOR,
				main_class_name: $button_variant_state_colors_class_name,
				state_color: BackgroundColor::PRIMARY,
				disabled_alpha: 0.1,
			);
		}

		$this->addCss(
			class_name: $button_variant_state_colors_class_name,
			css: $button_state_colors,
		);

		$button_shape_class_name = "molecule_filled_button_{$props->shape->value}_{$props->size->value}";
		if($props->shape === Shape::ROUND) {
			if($props->size === FilledButtonSize::XS) {
				$border_radius = "16px";
			} else if($props->size === FilledButtonSize::S) {
				$border_radius = "20px";
			} else if($props->size === FilledButtonSize::M) {
				$border_radius = "28px";
			} else if($props->size === FilledButtonSize::L) {
				$border_radius = "48px";
			} else {
				$border_radius = "68px";
			}

			$this->addCss(
				class_name: $button_shape_class_name,
				css: <<<CSS
				.{$button_shape_class_name} {
					border-radius: $border_radius;
				}
				CSS,
			);
		} else if ($props->shape === Shape::SQUARE) {
			if($props->size === FilledButtonSize::XS || $props->size === FilledButtonSize::S) {
				$clip_path = self::makeSquareCornersCss(size: 12);
			} else {
			}
			$this->addCss(
				class_name: $button_shape_class_name,
				css: <<<CSS
				.{$button_shape_class_name} {
					$clip_path
				}
				CSS,
			);
		} else {
			$this->addCss(
				class_name: $button_shape_class_name,
				css: <<<CSS
				.{$button_shape_class_name} {
					border-radius: 0px;
				}
				CSS,
			);
		}

		$this->addCss(
			class_name: "molecule_filled_button",
			css: <<<CSS
				.molecule_filled_button {
					display: flex;
					flex: 1;
					flex-direction: row;
					justify-content: center;
					align-items: center;
					width: 100%;
					border: none;
				}
			CSS,
		);

		if($props->toggled) {
			$this->addClass(class_name: "toggled");
		}
		$this->addClass(class_name: $props->disabled ? "disabled" : "enabled");

		$attributes = $this->makeAttributes();

		if($props->size === FilledButtonSize::XS || $props->size === FilledButtonSize::S) {
			$html = <<<HTML
			<div class="$div_target_area_class_name">
				<button$attributes>
					$icon
					$label
				</button>
			</div>
			HTML;
		} else {
			$html = <<<HTML
			<button$attributes>
				$icon
				$label
			</button>
			HTML;
		}

		$this->registerId();

		return $this->makeRender(html: $html);
	}
}
