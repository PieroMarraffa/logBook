<?php


class CAdmin
{
    /**
     *
     */
    static function verificaCredenziali() {
        $logged = FPersistentManager::checkAdminCredentials("email", "password");
    }
}