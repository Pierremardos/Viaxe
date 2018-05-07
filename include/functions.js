function bigMap(){
  var map = document.getElementsByTagName('iframe')['0'];
  map.className = 'container map';
  map.style.width = 800;
  map.style.height = 600;
}

function verifParcours(title,date,price){
  if(title == 1){
    var titre = document.getElementById('titleID');
  	var error = document.createElement('p');
  	error.innerHTML = 'Il faut rentrer un titre';
  	error.style.color = 'red';
  	titre.appendChild(error);
  }
  if(date == 1){
    var jour = document.getElementById('dateID');
    var error1 = document.createElement('p');
    error1.innerHTML = 'Il faut rentrer une date';
    error1.style.color = 'red';
    jour.appendChild(error1);
  }
  if(price == 1){
    var prix = document.getElementById('priceID');
    var error2 = document.createElement('p');
    error2.innerHTML = 'Il faut rentrer un prix';
    error2.style.color = 'red';
    prix.appendChild(error2);
  }
}
