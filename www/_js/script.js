
buttonSuppr = document.body.getElementsByClassName('btn-danger');

function confSuppr(e) {
    boolConf = confirm("Voulez-vous vraimnet supprimer cet élément ?");
    if (boolConf) return false;
    e.preventDefault();
}


buttonSuppr.forEach((item) => {
    item.addEventListener('click', event => confSuppr(e))
})
