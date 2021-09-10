function convalidaForm(Form) {
    if (Form.password.value == "") {
        alert("Devi inserire una password!")
        Form.password.focus()
        return false
    }
    if (Form.password.value != Form.password2.value) {
        alert("La passord inserita non coincide con la prima!")
        Form.password.focus()
        Form.password.select()
        return false
    }
    /**if(Form.email.value==''){alert("Devi indicare un indirizzo email"); return false;}
    if (/^\w+([\.-]?\w+)*\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Form.email.value))
    {
        alert("L'indirizzo email che hai inserito e' valido")
    }
    else {
        alert("L'indirizzo email che hai inserito non e' valido");
    }
    return false;*/
    return true;
}

