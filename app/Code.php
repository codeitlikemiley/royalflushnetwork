<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';

    protected $fillable = ['pin'];

    protected $dates = ['created_at', 'updated_at', 'date_used'];

    public static function findByPin($pin)
    {
        return self::where('pin', $pin)->where('used', false)->firstorFail();
    }

    public function link()
    {
        return $this->belongsTo('App\Link', 'consumer');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }

    public function generateCodes($qty)
    {
        $u = $qty;
        $i = 0;
        while ($i < $u) {
            try {
                $code = new self();
                $code->pin = $this->generatePin();
                $code->secret = $this->generateSecret();
                $code->creator = 1;
                $code->save();
                ++$i;
            } catch (\Illuminate\Database\QueryException $e) {
                $i;
            }
        }

        return "You Created  $i / $u Codes";
    }

    public function generatePin()
    {
        $pin = substr(md5(rand()), 0, 7);

        return $pin;
    }

    public function generateSecret()
    {
        $secret = substr(md5(rand()), 0, 7);

        return $secret;
    }
}
