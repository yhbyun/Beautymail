<?php namespace Snowfire\Beautymail\CssCapture;

class RawCapture implements CaptureInterface
{
    /**
     * @var string
     */
    protected $css;

    /**
     * @param string $css
     */
    public function __construct($css)
    {
        $this->css = $css;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->css;
    }
}
