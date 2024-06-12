
function envoyerDonnees( idArticle ) {
    let url = window.location.href;
    let fullUrl = `${url}/start`


     fetch(fullUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'idArticle': idArticle
        })
    })
    window.location.href = url
}

function envoyerDonneesQte( idArticle , qteArticle ) {
    let url = window.location.href ;
    let fullUrl = `${url}/validate` ;

    fetch( fullUrl , {
        method : 'POST' ,
        headers : {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify({
            'idArticle' : idArticle,
            'qte' : qteArticle
        })
    })

    window.location.href = url ;
}

function envoyerDonneesMotifQte( idArticle , idMotif , qteArticle ) {
    let url = window.location.href ;
    let fullUrl = `${url}/validate`

    fetch( fullUrl , {
        method : 'POST' ,
        headers : {
            'Content-Type': 'application/json'
        },
        body : JSON.stringify({
            'idArticle' : idArticle,
            'idMotif' : idMotif,
            'qte' : qteArticle
        })
    })
    window.location.href = url ;
}

