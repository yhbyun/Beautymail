<?php namespace Snowfire\Beautymail\CssCapture;

class FileCapture implements CaptureInterface
{
    /**
     * @var string
     */
    protected $fileName;

    /**
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function content()
    {
        return file_get_contents($this->fileName);
    }
}
