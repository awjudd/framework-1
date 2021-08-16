<?php
namespace Haunt\Http\Views\Traits;

trait Theme
{
    /**
     * The theme to apply.
     * @var string
     */
    public string $theme;

    /**
     * Apply the theme style.
     *
     * @return string
     */
    public function applyTheme(): string
    {
        switch($this->theme) {
            case 'error': {
                return 'bg-red-500 border-red-500 text-white';
                break;
            }
            case 'info': {
                return 'bg-blue-500 border-blue-500 text-white';
                break;
            }
            case 'primary': {
                return 'bg-primary border-primary text-white';
                break;
            }
            case 'success': {
                return 'bg-green-500 border-green-500 text-white';
                break;
            }
        }
    }

    /**
     * Apply the theme hover style.
     *
     * @return string
     */
    public function applyThemeHover(): string
    {
        switch($this->theme) {
            case 'error': {
                return 'hover:bg-red-600 hover:border-red-600';
                break;
            }
            case 'info': {
                return 'hover:bg-blue-600 hover:border-blue-600';
                break;
            }
            case 'primary': {
                return 'hover:primary-hover hover:border-primary-hover';
                break;
            }
            case 'success': {
                return 'hover:bg-green-600 hover:border-green-600';
                break;
            }
        }
    }
}
