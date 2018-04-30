function price() {

  var slider = document.getElementById("firstSlider");
  var output = document.getElementById("price");
  output.innerHTML = `Prix : ${slider.value}`;

  console.log(slider);
  slider.oninput = function() {
  output.innerHTML = `Prix: ${slider.value}`;
  }
}

function place() {

  var slider = document.getElementById("secondSlider");
  var output = document.getElementById("place");
  output.innerHTML = `Nombre de places : ${slider.value}`;

  console.log(slider);
  slider.oninput = function() {
  output.innerHTML = `Nombre de places : ${slider.value}`;
  }
}
