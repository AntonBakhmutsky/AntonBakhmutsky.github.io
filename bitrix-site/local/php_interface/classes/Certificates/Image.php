<?php

namespace ITLeague\Certificates;

use CFile;
use Exception;
use Intervention\Image\ImageManager;

class Image
{
    private string $code;
    private string $rating;
    private string $activeTo;

    private \Intervention\Image\Image $file;

    public function __construct(Coupon $coupon, float $rating)
    {
        $this->code = $coupon->getCode();
        $this->rating = number_format($rating, 0, '', ' ').' РУБ';
        $this->activeTo = $coupon->getActiveTo()->format('d.m.Y');
    }

    private function generate(): void
    {
        $manager = new ImageManager();
        $this->file = $manager->make(__DIR__.'/files/template.png');
        $color = $this->file->pickColor(716, 584);
        $this->file->text("Сертификат действителен до $this->activeTo г.", 2305, 2035, function ($font) {
            $font->file(__DIR__.'/files/font.ttf');
            $font->size(32);
        });
        $this->file->text($this->code, 2480, 1278, function ($font) use ($color) {
            $font->file(__DIR__.'/files/font.ttf');
            $font->size(53);
            $font->color($color);
        });
        $this->file->text($this->rating, 3072, 1278, function ($font) {
            $font->file(__DIR__.'/files/font.ttf');
            $font->size(53);
        });
    }

    /**
     * @throws Exception
     */
    public function getFileId(): int
    {
        $this->generate();
        $fileId = (int) CFile::SaveFile([
            'content' => $this->file->encode('jpg')->getEncoded(),
            'name' => "$this->code.jpg",
            'MODULE_ID' => 'sale'
        ], 'certificates');

        if ($fileId > 0) {
            $this->file->destroy();
            return $fileId;
        }
        throw new Exception('File saving error!');
    }
}