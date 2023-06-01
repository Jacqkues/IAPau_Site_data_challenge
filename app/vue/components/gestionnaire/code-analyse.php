<h1>Outil d'analyse de code </h1>
<div class="flexcol">
    <div class="flexcol">
        <input type="file" name="file-input" id="finp">
        <br>
        <div class="bouton" onclick="send()">Analyser</div>
    </div>

    <div id="cta">
        <div id="resultat">
        </div>
    </div>
</div>


<script>
    let resCont = document.getElementById("cta");
    function sendFileWithAjax(file) {
        var formData = new FormData();
        formData.append('file', file);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8001/upload');

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Request was successful
                var response = xhr.responseText;
                showdata(JSON.parse(response));
            } else {
                // Request failed
                console.log('Request failed. Status:', xhr.status);
            }
        };

        xhr.onerror = function () {
            // An error occurred during the request
            console.log('Request error.');
        };

        xhr.send(formData);
    }

    // Usage example
    function send() {
        var fileInput = document.getElementById('finp');
        var file = fileInput.files[0];
        sendFileWithAjax(file);
    }


    function showdata(data) {
        console.log(data);
        let title = document.createElement("h2");
        title.innerHTML = "Resultat de l'analyse";
        resCont.appendChild(title);
        let nbf =document.createElement("p");
        nbf.innerHTML = "Nombre de fonctions : "+data.countFunctions;
        resCont.appendChild(nbf);

        let nbl =document.createElement("p");
        nbl.innerHTML = "Nombre de lignes : "+data.countLines;
        resCont.appendChild(nbl);

        let tailleFmax =document.createElement("p");
        tailleFmax.innerHTML = "Taille de la plus grande fonction : "+data.maxFLines;
        resCont.appendChild(tailleFmax);

        let tailleFmin =document.createElement("p");
        tailleFmin.innerHTML = "Taille de la plus petite fonction : "+data.minFLines;
        resCont.appendChild(tailleFmin);

        let tailleFmoy =document.createElement("p");
        tailleFmoy.innerHTML = "Taille moyenne des fonctions : "+data.moyFLines;
        resCont.appendChild(tailleFmoy);

    }


</script>