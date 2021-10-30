
    function creaExperience(){
    nuovo_elemento = document.createElement("div");
    var numCode = parseInt(document.getElementById("container").childNodes.length+1);
    nuovo_elemento.setAttribute("id","quadro"+parseInt(document.getElementById("container").childNodes.length+1));
    nuovo_elemento.setAttribute("class","quadrato");
    nuovo_elemento.innerHTML=
        "<div class='card'>" +
        "<div class='card-header'>" +
        "<textarea class='form-control' name='titleExperience"+ numCode +"' rows='1' maxlength='49' placeholder='Insert experience title here'></textarea>" +
        "<div class='row py-2'>" +
        "<div class='col-md-3'>" +
        "<input type='date' name='startDate"+ numCode +"' class='px-2'>" +
        "</div><div class='col-md-3'>" +
        "<input type='date' name='endDate"+ numCode +"' class='px-2'>" +
        "</div><div class='col-md-3'>" +
        //"<button class='btn btn-primary' onclick='selectPlace()'> + Add Place </button>" +
        "<select class='btn btn-primary' name='place"+ numCode +"'>" +
        "{if isset($arrayPlace)}" +
        "{foreach $arrayPlace as $p}" +
        "<option value='{$p->getPlaceID()}'>{$p->getName()}</option>{/foreach}{/if}</select>" +
        "</div>"+
        "<div class='col-md-3'></div></div></div>" +
        "<div class='card-body'>" +
        "<textarea class='form-control' name='description"+ numCode +"' maxlength='499' rows='6' placeholder='Insert description here'></textarea>" +
        "</div><div align='end'>" +
        "<a type='button' class='my-3 mx-3 btn btn-danger '  onclick='remove("+ numCode +")' href='#experiences'>- Delete Experience</a>" +
        "</div></div>";
    document.getElementById("container").appendChild(nuovo_elemento);
    obj=eval("document.getElementById(\"quadro"+parseInt(document.getElementById("container").childNodes.length)+"\")");
    obj.style.height="450px";
    obj.style.width="1000px";
    }


    function creaImage(){
        nuovo_elemento = document.createElement("div");
        var numCode = parseInt(document.getElementById("container2").childNodes.length+1);
        nuovo_elemento.setAttribute("id","quadretto"+parseInt(document.getElementById("container2").childNodes.length+1));
        nuovo_elemento.setAttribute("class","quadrato");
        nuovo_elemento.innerHTML=
            "<input width='100%' class='btn btn-primary my-1' type='file' name='file' id='image' accept='image/png, image/jpeg'>";
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

