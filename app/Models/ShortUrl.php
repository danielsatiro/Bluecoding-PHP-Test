<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Jobs\CrawlerPageTitle;

class ShortUrl extends Model
{
    use HasFactory;

    protected $table = 'short_urls';
    protected $fillable = [
        'url', 'title', 'hits',
    ];
    public static $alphabet = "abcdefghijklmnopqrstuvwxyz0123456789";

    public function validator(array $data)
    {
        $data['id'] = $data['id'] ?? 0;
        $rules = [
            'url' => ['required', 'url'],
        ];

        return Validator::make($data, $rules);
    }

    public function createShortUrl(array $data)
    {
        $this->validator($data)->validate();

        $short = self::firstOrCreate([
            'url' => $data['url']
        ], $data);

        CrawlerPageTitle::dispatch($short);

        return self::encode($short->id);
    }

    public static function encode(int $i): string
    {
        if ($i == 0) {
            return self::$alphabet[0];
        }

        $s = '';
        $base = strlen(self::$alphabet);

        while ($i > 0)
        {
            $s .= self::$alphabet[$i % $base];
            $i = (int) $i / $base;
        }

        return strrev($s);
    }

    public static function decode(string $s): int
    {
        $i = 0;
        $base = strlen(self::$alphabet);

        foreach (str_split($s) as $letter)
        {
            $i = ($i * $base) + strpos(self::$alphabet, $letter);
        }

        return $i;
    }
}
