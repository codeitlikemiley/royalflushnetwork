<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';

    protected $fillable = ['pin'];

    protected $dates = ['created_at', 'updated_at', 'date_used'];

    protected $casts = [
        'used'    => 'boolean',
        'blocked' => 'boolean',

    ];
    /**
     * Static Function to Get Specified Pin and Check if USED
     */
    public static function findByPin($pin)
    {
        return self::where('pin', $pin)->where('used', false)->firstorFail();
    }
    /**
     * Sets the Relationship to App\Link
     */
    public function link()
    {
        return $this->belongsTo('App\Link', 'consumer', 'id');
    }
    /**
     * Sets the Relationship to App\User
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'creator', 'id');
    }
    /**
     * Scope of Specified Pin
     */
    public function scopePin($query, $pin)
    {
        return $query->where('pin', $pin);
    }
    /**
     * Scope of Specified Secret
     */
    public function scopeSecret($query, $secret)
    {
        return $query->where('secret', $secret);
    }
    /**
     * Scope of UNUSED codes
     */
    public function scopeUnusedCodes($query)
    {
        return $query->where('used', false);
    }
    /**
     * Scope of Specified USERID
     */
    public function scopeCreator($query, $creator)
    {
        return $query->where('creator', $creator);
    }
    /**
     * Scope of a Specified LINKID
     */
    public function scopeConsumer($query, $consumer)
    {
        return $query->where('consumer', $consumer);
    }
    /**
     * Scope With > 3 Code Attempts
     */
    public function scopeTooManyCodeAttempts($query)
    {
        return $query->where('attempts', '>', 3);
    }
    /**
     * Generates a Set Amount of Code Without Creator or Consumer
     */
    public function generateCodes($qty)
    {
        $u = $qty;
        $i = 0;
        while ($i < $u) {
            try {
                $code          = new self();
                $code->pin     = $this->generatePin();
                $code->secret  = $this->generateSecret();
                $code->save();
                ++$i;
            } catch (\Illuminate\Database\QueryException $e) {
                $i;
            }
        }

        return "You Created  $i / $u Codes";
    }
    /**
     * Call this to Generate Pin (Unique)
     */
    public function generatePin()
    {
        $pin = substr(md5(rand()), 0, 7);

        return $pin;
    }
    /**
     * Call this to Generate Secret Key
     */
    public function generateSecret()
    {
        $secret = substr(md5(rand()), 0, 7);

        return $secret;
    }
    /**
     * Use this Code if Attempt in the Form Request Validation Fails
     */
    public function incrementCodeAttempts($pin)
    {
        return Code::findByPin($pin)->update(array('attempts' => $this->attempts++));
    }
    /**
     * Reset Attempts to 0 and set Blocked Status to False
     */
    public function resetCodeAttempts($pin)
    {
        return Code::findByPin($pin)->tooManyCodeAttempts()->update(array('blocked' => false, 'attempts' => 0));
    }
    /**
     * Once Maximum No of Attempt is Reach Block the Code
     */
    public function blockCode($pin)
    {
        return Code::findByPin($pin)->tooManyCodeAttempts()->update(array('blocked' => true));
    }
}
