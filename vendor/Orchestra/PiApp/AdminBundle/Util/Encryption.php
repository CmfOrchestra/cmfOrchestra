<?php
/**
 * AF Application
 *
 * @category   Library
 * @package    Tools
 * @subpackage Encryption
 * @version    $Id: Encryption.php 2009-11-19 00:00:00 pi_etienne $
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */


/**
 * Classe uniformisant le système de gestion des Encryptions.
 *
 * @category   Library
 * @package    Tools
 * @subpackage Encryption
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */
class App_Tools_Encryption
{

    /**
     * des encryption
     */
    const ENCRYPT_DES = 'des';
    
    /**
     * blowfish crypt encryption
     */
    const ENCRYPT_BLOWFISH_CRYPT = 'blowfish_crypt';
    
    /**
     * md5 crypt encryption
     */
    const ENCRYPT_MD5_CRYPT = 'md5_crypt';
    
    /**
     * ext crypt encryption
     */
    const ENCRYPT_EXT_CRYPT = 'ext_crypt';

    /**
     * md5 encryption
     */
    const ENCRYPT_HASH = 'hash';
    
    /**
     * md5 encryption
     */
    const ENCRYPT_MD5 = 'md5';
    
    /**
     * smd5 encryption
     */
    const ENCRYPT_SMD5 = 'smd5';

    /**
     * sha encryption
     */
    const ENCRYPT_SHA = 'sha';
    
    /**
     * ssha encryption
     */
    const ENCRYPT_SSHA = 'ssha';
    
    /**
     * lmpassword encryption
     */
    const ENCRYPT_LMPASSWORD = 'lmpassword';
    
    /**
     * ntpassword encryption
     */
    const ENCRYPT_NTPASSWORD = 'ntpassword';
    
    /**
     * no encryption
     */
    const ENCRYPT_PLAIN = 'plain';
    
    const ENCRYPT_MAIL_UNSUBSCRIBE = 'mailunsubscribe';
    
    /**
     * returns all supported password encryptions types
     *
     * @return array
     */
    public static function getSupportedEncryptionTypes()
    {
        return array(
            self::ENCRYPT_BLOWFISH_CRYPT,
            self::ENCRYPT_EXT_CRYPT,
            self::ENCRYPT_DES,
            self::ENCRYPT_HASH,
            self::ENCRYPT_MD5,
            self::ENCRYPT_MD5_CRYPT,
            self::ENCRYPT_PLAIN,
            self::ENCRYPT_SHA,
            self::ENCRYPT_SMD5,
            self::ENCRYPT_SSHA,
            self::ENCRYPT_LMPASSWORD,
            self::ENCRYPT_NTPASSWORD,
            self::ENCRYPT_MAIL_UNSUBSCRIBE
        );
    }
    
    /**
     * encryptes password
     *
     * @param string $_password
     * @param string $_method
     */
    public static function encryptPassword($_password, $_method)
    {
        switch (strtolower($_method)) {
            case self::ENCRYPT_BLOWFISH_CRYPT:
                $salt = '$2$' . self::getRandomString(13);
                $password = '{CRYPT}' . crypt($_password, $salt);
                break;
                
            case self::ENCRYPT_EXT_CRYPT:
                $salt = self::getRandomString(9);
                $password = '{CRYPT}' . crypt($_password, $salt);
                break;
                
            case self::ENCRYPT_MD5:
                $password = '{MD5}' . base64_encode(pack("H*", md5($_password)));
                break;
                
            case self::ENCRYPT_MD5_CRYPT:
                $salt = '$1$' . self::getRandomString(9);
                $password = '{CRYPT}' . crypt($_password, $salt);
                break;
                
            case self::ENCRYPT_PLAIN:
                $password = $_password;
                break;
                
            case self::ENCRYPT_SHA:
                if(function_exists('mhash')) {
                    $password = '{SHA}' . base64_encode(mhash(MHASH_SHA1, $_password));
                }
                break;

            case self::ENCRYPT_HASH:
                if(function_exists('hash')) {
                    $password = hash_hmac('ripemd160', $_password, '314secret911');
                }
                break;
                
            case self::ENCRYPT_SMD5:
                if(function_exists('mhash')) {
                    $salt = self::getRandomString(8);
                    $hash = mhash(MHASH_MD5, $_password . $salt);
                    $password = '{SMD5}' . base64_encode($hash . $salt);
                }
                break;
                
            case self::ENCRYPT_SSHA:
                if(function_exists('mhash')) {
                    $salt = self::getRandomString(8);
                    $hash = mhash(MHASH_SHA1, $_password . $salt);
                    $password = '{SSHA}' . base64_encode($hash . $salt);
                }
                break;
                
            case self::ENCRYPT_LMPASSWORD:
                $crypt = new PEAR_Crypt_CHAP_MSv1();
                $password = strtoupper(bin2hex($crypt->lmPasswordHash($_password)));
                break;
                
            case self::ENCRYPT_NTPASSWORD:
                $crypt = new PEAR_Crypt_CHAP_MSv1();
                $password = strtoupper(bin2hex($crypt->ntPasswordHash($_password)));
                
                // @todo replace Crypt_CHAP_MSv1
                //$password = hash('md4', Zend_Auth_Adapter_Http_Ntlm::toUTF16LE($_password), TRUE);
                break;
                
            case self::ENCRYPT_MAIL_UNSUBSCRIBE:
                $crypt 				= new PEAR_Crypt_CHAP_MSv1();
				$crypt->password 	= $_password;
				$crypt->challenge 	= pack('H*', '102DB5DF085D3041');
				
//				$unipw 					= '{MAIL}' . $crypt->str2unicode($crypt->password);    
//              $password['unicode-pw']	= '{MAIL}' . strtoupper(bin2hex($unipw));
//              $password['NT-HASH']	= '{MAIL}' . strtoupper(bin2hex($crypt->ntPasswordHash()));
//              $password['NT-Resp']	= '{MAIL}' . strtoupper(bin2hex($crypt->challengeResponse()));
//              $password['LM-HASH']	= '{MAIL}' . strtoupper(bin2hex($crypt->lmPasswordHash()));
//              $password['LM-Resp']	= '{MAIL}' . strtoupper(bin2hex($crypt->lmChallengeResponse()));
//              $password['Response']	= '{MAIL}' . strtoupper(bin2hex($crypt->response()));
                
                $password	=	strtoupper(bin2hex($crypt->ntPasswordHash()));
                break;                

            case self::ENCRYPT_DES:
                $salt = self::getRandomString(2);
                $password  = '{CRYPT}'. crypt($_password, $salt);
                break;
                                
            default:
				break;
        }
        
        if (! $password) {
            throw new Zend_Exception("$_method is not supported by your php version");
        }
        
        return $password;
    }    
    
    /**
     * generates a randomstrings of given length
     *
     * @param int $_length
     */
    public static function getRandomString($_length)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $randomString = '';;
        for ($i=0; $i<(int)$_length; $i++) {
            $randomString .= $chars[mt_rand(1, strlen($chars)) -1];
        }
        
        return $randomString;
    }

}
