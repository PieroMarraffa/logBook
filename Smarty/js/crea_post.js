    function creaImage(){
        nuovo_elemento = document.createElement("div");
        var numCode = parseInt(document.getElementById("container2").childNodes.length+1);
        nuovo_elemento.setAttribute("id","quadretto"+parseInt(document.getElementById("container2").childNodes.length+1));
        nuovo_elemento.setAttribute("class","quadrato");
        nuovo_elemento.innerHTML=
            "<input width='100%' class='btn btn-primary my-1' type='file' name='image"+ numCode +"' id='image' accept='image/png, image/jpeg, image/jpg'>";
        document.getElementById("container2").appendChild(nuovo_elemento);
        obj=eval("document.getElementById(\"quadretto"+parseInt(document.getElementById("container2").childNodes.length)+"\")");
        obj.style.height="70px";
        obj.style.width="300px";
    }


    function selectPlace(){
        var place= window.prompt("Insert place here");
        var array = new Array()
        if(place in array){
            return place;
        }
        else{
            window.alert("Place is not in our database");
        }
    }


    function addPlace(){
        nuovo_elemento = document.createElement("div");
        nuovo_elemento.setAttribute("id","quadro"+parseInt(document.getElementById("container").childNodes.length+1));
        nuovo_elemento.setAttribute("class","quadrato");
        nuovo_elemento.innerHTML=
            "<form method='post' action='/logBook/CreatePost/create'><div id='a'class='card'>" +
            "<div class='card-body'>{$array->getName()} <button onclick=''  class='btn btn-primary'>x</button></div></div></form>";
        document.getElementById("container2").appendChild(nuovo_elemento);
        obj=eval("document.getElementById(\"quadro"+parseInt(document.getElementById("container2").childNodes.length)+"\")");
        obj.style.height="100px";
        obj.style.width="200px";
    }


    function remove(numero){
            var elem = document.getElementById("quadro" + numero);
            elem.parentNode.removeChild(elem);
            return false;
    }


    function geocode(num){

        var location = document.getElementById("location-input" + num).value;
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
            params: {
                address:location,
                key:'AIzaSyD08h2askcbDIx7A8NU6G8CgprXCYpRtXw'
            }
        })
            .then(function (response){
                console.log(response);
                var status = response.data.status;
                if (status === "ZERO_RESULTS"){
                    alert("The place:'" + location + "' was not found in the database. Insert other place or the esperience won't be saved");
                    document.getElementById("location-input" + num).value = null;
                }
            })
            .catch(function (error){
                console.log(error);
            })
    }
