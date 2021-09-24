function convalidaForm(Form) {
    if (Form.new_password.value == "") {
        alert("You must insert a new password!")
        Form.new_password.focus()
        return false
    }
    if (Form.new_password.value != Form.confirm_password.value) {
        alert("The inserted passwords doesn't match!")
        Form.new_password.focus()
        Form.new_password.select()
        return false
    }
    if(Form.new_password.value == Form.old_password.value){
        alert("The inserted password match with the old password!")
        Form.new_password.focus()
        Form.new_password.select()
        return false
    }

    return true;
}