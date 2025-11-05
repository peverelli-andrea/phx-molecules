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

			if($props->variant === FilledButtonVariant::ELEVATED) {
				$default_icon_color = BackgroundColor::PRIMARY;
				$color_states = new ColorStates(
					disabled: ForegroundColor::ON_SURFACE,
					hover: BackgroundColor::PRIMARY,
					focus: BackgroundColor::PRIMARY,
					pressed: BackgroundColor::PRIMARY,
					toggled_default: ForegroundColor::ON_PRIMARY,
					toggled_hover: ForegroundColor::ON_PRIMARY,
					toggled_focus: ForegroundColor::ON_PRIMARY,
					toggled_pressed: ForegroundColor::ON_PRIMARY,
				);
			} else if($props->variant === FilledButtonVariant::FILLED) {
			} else if($props->variant === FilledButtonVariant::TONAL) {
			} else if($props->variant === FilledButtonVariant::OUTLINED) {
			} else {
			}

			$this->addCss(
				class_name: "molecule_filled_button_{$props->variant->value}_icon",
				props_id: "icon",
				css: function(string $class_name) use($color_states) {
					return $this->getColorStatesCss(
						color_states: $color_states,
						css_color_property: CssColorProperty::COLOR,
						main_class_name: $class_name,
					);
				},
			);

			if($props->toggled) {
				$this->addClass(
					class_name: "toggled",
					props_id: "icon",
				);
			}

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

		if($props->variant === FilledButtonVariant::ELEVATED) {
			$default_label_color = BackgroundColor::PRIMARY;
			$color_states = new ColorStates(
				disabled: ForegroundColor::ON_SURFACE,
				hover: BackgroundColor::PRIMARY,
				focus: BackgroundColor::PRIMARY,
				pressed: BackgroundColor::PRIMARY,
				toggled_default: ForegroundColor::ON_PRIMARY,
				toggled_hover: ForegroundColor::ON_PRIMARY,
				toggled_focus: ForegroundColor::ON_PRIMARY,
				toggled_pressed: ForegroundColor::ON_PRIMARY,
			);
		} else if($props->variant === FilledButtonVariant::FILLED) {
		
		} else if($props->variant === FilledButtonVariant::TONAL) {
		
		} else if($props->variant === FilledButtonVariant::OUTLINED) {
		
		} else {
		
		}

		$this->addCss(
			class_name: "molecule_filled_button_label",
			props_id: "label",
			css: function(string $class_name) use($color_states): string {
				return $this->getColorStatesCss(
					color_states: $color_states,
					css_color_property: CssColorProperty::COLOR,
					main_class_name: $class_name,
				);
			},
		);

		if($props->toggled) {
			$this->addClass(
				class_name: "toggled",
				props_id: "label",
			);
		}

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
			flex: 1;
			justify-content: center;
			align-items: center;
			height: 48px;
			min-height: 48px;
			max-height: 48px;
			width: 100%;
		}
		CSS;
		$button_size_class_name = "molecule_filled_button_{$props->size->value}";
		if($props->size === FilledButtonSize::XS) {
			$this->addCss(
				class_name: $button_size_class_name,
				css: (<<<CSS
				.{$button_size_class_name} {
					height: 32px;
					min-height: 32px;
					max-height: 32px;
				}
				CSS) . $div_target_area_css,
			);
		} else if($props->size === FilledButtonSize::S) {
			$this->addCss(
				class_name: $button_size_class_name,
				css: (<<<CSS
				.{$button_size_class_name} {
					height: 40px;
					min-height: 40px;
					max-height: 40px;
				}
				CSS) . $div_target_area_css,
			);
		} else if($props->size === FilledButtonSize::M) {
		
		} else if($props->size === FilledButtonSize::L) {
		
		} else {
		
		}

		$button_variant_class_name = "molecule_filled_button_{$props->variant->value}";
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

			$color_states = new ColorStates(
				default: BackgroundColor::SURFACE_CONTAINER_LOW,
				disabled: ForegroundColor::ON_SURFACE,
				toggled_default: BackgroundColor::PRIMARY,
			);
		} else if($props->variant === FilledButtonVariant::FILLED) {
		
		} else if($props->variant === FilledButtonVariant::TONAL) {
		
		} else if($props->variant === FilledButtonVariant::OUTLINED) {
		
		} else {
		
		}

		$button_shape_class_name = "molecule_filled_button_{$props->shape->value}_{$props->size->value}";
		if($props->shape === Shape::ROUND) {
			if($props->size === FilledButtonSize::XS) {
				$this->addCss(
					class_name: $button_shape_class_name,
					css: <<<CSS
					.{$button_shape_class_name} {
						border-radius: 16px;
					}
					CSS,
				);
			} else if($props->size === FilledButtonSize::S) {
				$this->addCss(
					class_name: $button_shape_class_name,
					css: <<<CSS
					.{$button_shape_class_name} {
						border-radius: 20px;
					}
					CSS,
				);
			}
		} else if ($props->shape === Shape::SQUARE) {
			if($props->size === FilledButtonSize::XS || $props->size === FilledButtonSize::S) {
				$clip_path = self::makeSquareCornersCss(size: 12);
				$this->addCss(
					class_name: $button_shape_class_name,
					css: <<<CSS
					.{$button_shape_class_name} {
						$clip_path
					}
					CSS,
				);
			} else {
			}
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
			css: function(string $class_name) use($color_states) {
				return (<<<CSS
				.{$class_name} {
					display: flex;
					flex: 1;
					flex-direction: row;
					justify-content: center;
					align-items: center;
					width: 100%;
					border: none;
					gap: 8px;
					padding-left: 12px;
					padding-right: 12px;
				}
				CSS) . $this->getColorStatesCss(
					color_states: $color_states,
					css_color_property: CssColorProperty::BACKGROUND_COLOR,
					main_class_name: $class_name,
					state_color: BackgroundColor::PRIMARY,
					toggled_state_color: ForegroundColor::ON_PRIMARY,
				);
			},
		);

		if($props->toggled) {
			$this->addClass(class_name: "toggled");
		}

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

		$button_id = self::getId();
		$toggled_value = $props->toggled ? "true" : "false";
		$this->addScriptBefore(
			script_name: "button_toggle",
			script: <<<JS
			let {$button_id}_toggled = "$toggled_value";
			JS,
		);

		return $this->makeRender(html: $html);
	}
}
