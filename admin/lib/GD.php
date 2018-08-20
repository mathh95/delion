<?php
/**
 *
 * Thiago Tadashi
 *
 * Nome do Arquivo - GD.class.php
 * Descrição - Classe destinada ao tratamento de imagens
 *
 */

ini_set("gd.jpeg_ignore_warning", 1);

class GD
{
    private $imageSrc = NULL;
    private $imagePath = NULL;
    private $imageNewSrc = NULL;
    private $imageType = NULL;
    private $imageHeight = NULL;
    private $imageWidth = NULL;
    private $imageSize = NULL;
    private $imageNewMaxHeight = NULL;
    private $imageNewMaxWidth = NULL;


    public function __construct($path)
    {

        list($this->imageWidth, $this->imageHeight, $this->imageType) = getimagesize($path);
        $this->imageSize = filesize($path);

        switch ($this->imageType) {
            case '1':
                $this->imageType = 'gif';
                $this->imagePath = $path;
                break;

            case '2':
                $this->imageType = 'jpg';
                $this->imageSrc = imagecreatefromjpeg($path);
                break;

            case '3':
                $this->imageType = 'png';
                $this->imageSrc = imagecreatefrompng($path);
                break;
        }
    }

    public function __destruct()
    {
        if (is_resource($this->imageSrc)) imagedestroy($this->imageSrc);
    }

    public function setNewMaxHeight($int)
    {
        $this->imageNewMaxHeight = (int)$int;
        $this->imageNewMaxWidth = NULL;
    }

    public function setNewMaxWidth($int)
    {
        $this->imageNewMaxWidth = (int)$int;
        $this->imageNewMaxHeight = NULL;
    }

    public function cutOutImage($coord = array())
    {
        if (is_resource($this->imageNewSrc)) {
            $beforeImage = $this->imageNewSrc;
            $this->imageNewSrc = NULL;
        } else {
            $beforeImage = $this->imageSrc;
        }

        $this->imageNewSrc = imagecreatetruecolor($coord['w'], $coord['h']);

        if ($this->imageType == 'png') {
            $color = imagecolorallocatealpha($this->imageNewSrc, 0x00, 0x00, 0x00, 127);
            imagesavealpha($this->imageNewSrc, true);
            imagefill($this->imageNewSrc, 0, 0, $color);
        }

        imagecopyresampled($this->imageNewSrc, $beforeImage, 0, 0, $coord['x1'], $coord['y1'], $coord['w'], $coord['h'], $coord['w'], $coord['h']);

    }

    public function render()
    {
        if ($this->imageNewMaxWidth || $this->imageNewMaxHeight) {

            if ($this->imageNewMaxWidth > $this->imageNewMaxHeight) {
                $ration = min($this->imageNewMaxWidth / $this->imageWidth, 1.0); // 1.0 seria 100% da imagem
            } elseif ($this->imageNewMaxWidth < $this->imageNewMaxHeight) {
                $ration = min($this->imageNewMaxHeigth / $this->imageHeigth, 1.0); // 1.0 seria 100% da imagem
            }

            $this->imageNewMaxHeight = (int)($this->imageHeight * $ration);
            $this->imageNewMaxWidth = (int)($this->imageWidth * $ration);

            $this->imageNewSrc = imagecreatetruecolor($this->imageNewMaxWidth, $this->imageNewMaxHeight);

            if ($this->imageType == 'png') {
                $color = imagecolorallocatealpha($this->imageNewSrc, 0x00, 0x00, 0x00, 127);
                imagesavealpha($this->imageNewSrc, true);
                imagefill($this->imageNewSrc, 0, 0, $color);
            }

            imagecopyresampled($this->imageNewSrc, $this->imageSrc, 0, 0, 0, 0, $this->imageNewMaxWidth, $this->imageNewMaxHeight, $this->imageWidth, $this->imageHeight);
        }
    }


    public function output($outputFile)
    {
        //header(NULL);
        switch ($this->imageType) {
            case 'gif':
                move_uploaded_file($this->imagePath, ($outputFile . '.' . $this->imageType));
                break;

            case 'jpg':
                if ($this->imageNewSrc) {
                    imagejpeg($this->imageNewSrc, ($outputFile . '.' . $this->imageType));
                    imagedestroy($this->imageNewSrc);

                } else {
                    imagejpeg($this->imageSrc, ($outputFile . '.' . $this->imageType));
                }
                break;

            case 'png':
                if ($this->imageNewSrc) {

                    imagepng($this->imageNewSrc, ($outputFile . '.' . $this->imageType));
                    imagedestroy($this->imageNewSrc);
                } else {

                    $color = imagecolorallocatealpha($this->imageSrc, 0x00, 0x00, 0x00, 127);
                    imagesavealpha($this->imageSrc, true);
                    imagefill($this->imageSrc, 0, 0, $color);

                    imagepng($this->imageSrc, ($outputFile . '.' . $this->imageType));
                }
                break;
        }

    }

    public function getType()
    {
        return $this->imageType;
    }

    public function getSize()
    {
        return $this->imageSize;
    }

}