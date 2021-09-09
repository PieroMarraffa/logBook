<?php


class VUser
{
    /**
     * Funzione che si occupa di gestire la visualizzazione della homepage dopo il login ( se è andato a buon fine)
     * @param $array elenco di Anunci da visualizzare
     * @throws SmartyException
     */
    public function loginOk($array) {
        $this->smarty->assign('immagine', "/logBook/Smarty/immagini/truck.png");
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('array', $array);
        $this->smarty->assign('toSearch', 'trasporti');
        $this->smarty->display('home.tpl');
    }
}