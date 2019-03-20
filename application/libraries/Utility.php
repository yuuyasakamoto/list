<?php

Class Utility
{
    /**
     * パスワードのハッシュ化
     * @param type $password
     * @param type $created
     * @return type
     */
    public function hash(string $password, string $created)
    {
        $hash = sha1($password . $created);
        return $hash;
    }
}