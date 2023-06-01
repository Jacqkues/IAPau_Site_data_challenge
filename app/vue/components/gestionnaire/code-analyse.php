<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h1>Outil d'analyse de code </h1>
<div class="flexcol">
    <div class="flexcol">
        <input type="file" name="file-input" id="finp">
        <br>
        <div class="bouton" onclick="send()">Analyser</div>
    </div>

    <div id="cta">
        <div id="resultat">
            <canvas id="myChart"></canvas>
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
                console.log(response)
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


    /* function showdata(data) {
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
 
     }*/

    function showdata(data) {
       /* const data = {
            minFLines: 3,
            maxFLines: 19,
            moyFLines: 7,
            countLines: 48,
            countFunctions: 6,
        };*/

        // Get the canvas element
        const canvas = document.getElementById('myChart');

        // Create the chart
        const chart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: ['Nb ligne Max pour une fonction', 'Nb ligne Min pour une fonction', 'Nb ligne moyen des fonctions', 'Nombre de lignes', 'Number de fonctions'],
                datasets: [{
                    label: 'Data',
                    data: [
                        data.minFLines,
                        data.maxFLines,
                        data.moyFLines,
                        data.countLines,
                        data.countFunctions
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Set the color of the bars
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Start the y-axis at zero
                    }
                }
            }
        });

    }


</script>

<style>
    canvas {
        width:45vw;
    }
</style>