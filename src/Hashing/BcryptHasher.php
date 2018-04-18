<?php

namespace Zaky\Hashing;

use Zaky\Contracts\Hashing\Hasher;

class BcryptHasher implements Hasher
{
    /**
     * Default crypt cost factor.
     *
     * @var int
     */
    protected $rounds = 10;

    /**
     * @param string $value
     * @param array $options
     * @return mixed
     */
    public function make($value, array $options = [])
    {
        $hash = password_hash($value, PASSWORD_BCRYPT, [
            'cost' => $this->cost($options),
        ]);

        if ($hash === false) {
            throw new \Exception('Bcrypt hashing not supported');
        }

        return $hash;
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return mixed
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return password_verify($value, $hashedValue);
    }

    /**
     * @param string $hashedValue
     * @param array $options
     * @return mixed
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return password_needs_rehash($hashedValue, PASSWORD_BCRYPT, [
            'cost' => $this->cost($options),
        ]);
    }

    /**
     * Set the default password work factor.
     *
     * @param  int  $rounds
     * @return $this
     */
    public function setRounds($rounds)
    {
        $this->rounds = (int) $rounds;

        return $this;
    }

    /**
     * Extract the cost value from the options array.
     *
     * @param  array  $options
     * @return int
     */
    protected function cost(array $options = [])
    {
        return $options['rounds'] ?? $this->rounds;
    }

}