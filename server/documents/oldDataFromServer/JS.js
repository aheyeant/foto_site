function doplnPolozky() {
    let uzivatelskyInput = document.querySelector("#studentInput").value;
    document.querySelector(".nasePolozky").innerHTML += "<li>"+uzivatelskyInput+"</li>";

    let request = new XMLHttpRequest();
    request.open("GET", "./students.php");
    request.send();
    request.onreadystatechange += function (){
        //READY STATE == DONE a STATUS == HTTP OK
        if(this.readyState == 4 && this.status == 200){
            let naseOdpovedZeServeru = this.responseText;
            console.log(naseOdpovedZeServeru);
        }
    }


}

document.querySelector("#studentInput").addEventListener("input", doplnPolozky)