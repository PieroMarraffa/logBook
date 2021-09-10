
function convalidaPassword(passwordForm) {
    if (passwordForm.password.value == "") {
        alert("Devi inserire una password!")
        passwordForm.password.focus()
        return false
    }
    return true
}
