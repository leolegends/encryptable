<?php

namespace leolegends\ModelEncryptable\Traits;


use Illuminate\Support\Facades\Config;

trait ModelEncryptableTrait
{
    protected $key;
    protected $crypt;
    /**
     * If the attribute is in the encryptable array
     * then decrypt it.
     *
     * @param  $key
     *
     * @return $value
     */
    public function getAttribute($key)
    {
        $this->setAuth();

        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable) && $value !== '') {
            $value = $this->crypt->decrypt($value);
        }

        return $value;
    }

    /**
     * If the attribute is in the encryptable array
     * then encrypt it.
     *
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        $this->setAuth();

        if (in_array($key, $this->encryptable)) {
            $value = $this->crypt->encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * When need to make sure that we iterate through
     * all the keys.
     *
     * @return array
     */
    public function attributesToArray()
    {

        $this->setAuth();
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = $this->crypt->decrypt($attributes[$key]);
            }
        }

        return $attributes;
    }

    public function setAuth(){
        $this->key = env('DECRIPT_KEY');
        $this->crypt = new \Illuminate\Encryption\Encrypter($this->key, env('CYPHER'));

    }
}
