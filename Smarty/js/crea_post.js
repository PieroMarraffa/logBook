
    function creaExperience(){
    nuovo_elemento = document.createElement("div");
    nuovo_elemento.setAttribute("id","quadro"+parseInt(document.getElementById("container").childNodes.length+1));
    nuovo_elemento.setAttribute("class","quadrato");
    nuovo_elemento.innerHTML=
        "<form method='post' action='/logBook/CreatePost/create'><div class='card'>" +
        "<div class='card-header'>" +
        "<textarea class='form-control' rows='1' maxlength='49' placeholder='Insert title here'> </textarea>" +
        "<div class='row py-2'>" +
        "<div class='col-md-3'>" +
        "<input type='date' class='px-2'>" +
        "</div><div class='col-md-3'>" +
        "<input type='date' class='px-2'>" +
        "</div><div class='col-md-3'>" +
        "<button class='btn btn-primary' onclick='selectPlace()'> + Add Place </button>" +
        "</div>"+
        "<div class='col-md-3'></div></div></div>" +
        "<div class='card-body'>" +
        "<textarea class='form-control' maxlength='499' rows='6' placeholder='Insert description here'> </textarea>" +
        "</div></div></form>";
    document.getElementById("container").appendChild(nuovo_elemento);
    obj=eval("document.getElementById(\"quadro"+parseInt(document.getElementById("container").childNodes.length)+"\")");
    obj.style.height="400px";
    obj.style.width="1000px";
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

    function remove(){
            var elem = document.getElementById(this.id);
            elem.parentNode.removeChild(elem);
            return false;
    }
