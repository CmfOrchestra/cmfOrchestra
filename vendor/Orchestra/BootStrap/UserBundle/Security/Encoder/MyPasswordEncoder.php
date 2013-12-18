<?php
/**
 * This file is part of the <User> project.
 * Creating a Custom Voter from the blacklist defined in the services.yml
 *
 * (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;

class MyPasswordEncoder extends BasePasswordEncoder
{
	public function encodePassword($raw, $salt)
    {
        $this->algorithm = 'sha512';
        $this->encodeHashAsBase64 = true;
        $this->iterations = 5000;
        
        if (!in_array($this->algorithm, hash_algos(), true)) {
        	throw new \LogicException(sprintf('The algorithm "%s" is not supported.', $this->algorithm));
        }
        
        $salted = $this->mergePasswordAndSalt($raw, $salt);
        $digest = hash($this->algorithm, $salted, true);
        
        // "stretch" hash
        for ($i = 1; $i < $this->iterations; $i++) {
        	$digest = hash($this->algorithm, $digest.$salted, true);
        }
        
        return $this->encodeHashAsBase64 ? base64_encode($digest) : bin2hex($digest);
        
        // ex : return md5($salt.$raw.$salt);
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $this->comparePasswords($encoded, $this->encodePassword($raw, $salt));
    }
}