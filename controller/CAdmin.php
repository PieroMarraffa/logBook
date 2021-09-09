<?php


class CAdmin
{
    /**
     * Funzione utilizzata per visualizzare la homepage dell'amministratore, nella quale sono presenti tutti gli utenti della piattaforma.
     * Gli utenti sono divisi in due liste: bannati e attivi.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati con le credenziali dell'amministratore viene visualizzata la homepage con l'elenco di tutti gli utenti;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati ma non come amministratore, viene visualizzata una pagina di errore 401;
     * 3) altrimenti, reindirizza alla pagina di login.
     */
    static function homepage () {
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            if (CUser::isLogged()) {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com") {
                    $view = new VAdmin();
                    $pm = new FPersistentManager();
                    //visualizza elenco utenti attivi e bannati
                    $utentiAttivi = $pm->loadUtenti(1);
                    $utentiBannati = $pm->loadUtenti(0);
                    $img_attivi = static::set_immagini($utentiAttivi);
                    $img_bann = static::set_immagini($utentiBannati);
                    $view->HomeAdmin($utentiAttivi, $utentiBannati,$img_attivi,$img_bann);
                }
                else {
                    $view = new VError();
                    $view->error('1');
                }
            }
            else
                header('Location: /logBook/User/login');
        }
    }
}