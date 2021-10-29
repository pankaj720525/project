<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    public function parse($data) {
        $parsed = preg_replace_callback('/{{(.*?)}}/', function ($matches) use ($data) {
            list($shortCode, $index) = $matches;
            if (isset($data[$index])) {
                return $data[$index];
            } else {
                throw new Exception("Shortcode {$shortCode} not found in template id {$this->id}", 1);
            }
        }, $this->content);

        return $parsed;
    }
}
