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
    var myRegEx = /^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/;
    if ( myRegEx.test(Form.email.value) )
        return true;
    else{
        alert('Indirizzo email non valido');
        return false;
    }

    return true;
}

