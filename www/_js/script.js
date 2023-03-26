boutonssSuppr = document.body.getElementsByClassName('btn-danger');

Array.prototype.forEach.call(boutonssSuppr,
    function (item) {
        item.addEventListener('click', (e) => confSuppr(e))
    }
)

function confSuppr(e) {
    boolConf = confirm("Voulez-vous vraimnet supprimer cet élément ?");
    if (boolConf) return false;
    e.preventDefault();
}