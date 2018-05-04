function bigMap(){
  var map = document.getElementsByTagName('iframe')['0'];
  map.className = 'container map';
  map.style.width = 800;
  map.style.height = 600;
}

function verifParcours(title){
  if(title == 1){
    var titre = document.getElementById('titleID');
  	var error = document.createElement('p');
  	error.innerHTML = 'Il vous faut rentrer un titre';
  	error.style.color = 'red';
  	titre.appendChild(error);
  }
  
}
