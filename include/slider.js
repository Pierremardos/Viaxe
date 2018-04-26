function price() {
  
  var slider = document.getElementById("firstSlider");
  var output = document.getElementById("price");
  output.innerHTML = `Prix maximum : ${slider.value}`;

  console.log(slider);
  slider.oninput = function() {
  output.innerHTML = `Prix maximum : ${slider.value}`;
  }
}
