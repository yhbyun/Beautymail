<?php namespace Snowfire\Beautymail;

use Snowfire\Beautymail\CssCapture\CaptureInterface;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Beautymail
{
    /**
     * Contains settings for emails processed by Beautymail.
     *
     * @var
     */
    private $settings;

    /**
     * @var CaptureInterface[]
     */
    protected $css = [];

    /**
     * Initialise the settings and mailer.
     *
     * @param $settings
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
        $this->setLogoPath();
    }

    /**
     * Retrieve the settings.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->settings;
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\View\View
     */
    public function render($view, array $data = [])
    {
        $data = array_merge($this->settings, $data);

        $content = view($view, $data)->render();
        $formatter = new CssToInlineStyles($content, $this->stringifyCss());

        return $formatter->convert();
    }

    /**
     * @param CaptureInterface $capture
     * @return $this
     */
    public function addCss(CaptureInterface $capture)
    {
        array_push($this->css, $capture);
        return $this;
    }

    /**
     * @return string
     */
    protected function stringifyCss()
    {
        $css = '';
        foreach ($this->css as $capture) {
            $css .= $capture->content();
        }
        return $css;
    }

    /**
     * @return mixed
     */
    protected function setLogoPath()
    {
        $this->settings['logo']['path'] = str_replace(
            '%PUBLIC%',
            \Request::getSchemeAndHttpHost(),
            $this->settings['logo']['path']
        );
    }
}
