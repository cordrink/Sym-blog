<?php

namespace App\Services;

use SebastianBergmann\Diff\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadFile extends AbstractController {
    public function generate_name($length = 20): string
    {
        $code = "qwertyu1iopa2sdfg59hj80k6l5zx7cvbnm";
        $result = "";

        while (strlen($result) < 20) {
            $result .= $code[rand(0, strlen($code) - 1)];
        }

        return $result;
    }

    public function saveFile($file): string
    {
        $extension = $file->guessExtension();
        $filename = $this->generate_name(30). '.' .$extension;
        $file->move($this->getParameter('image_dir'), $filename);

        return '/assets/images/articles/'.$filename;
    }

    public function updateFile($file, $oldFile): string
    {
        $file_url = $this->saveFile($file);
        try {
            unlink($this->getParameter('static_dir').$oldFile);
        } catch (\Throwable $th) {
//            code
        }
        return $file_url;
    }
}