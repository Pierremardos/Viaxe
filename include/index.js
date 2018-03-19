$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 500,
    values: [ 100, 300 ],
    slide: function( event, ui1 ) {
      $( "#amount1" ).val( ui1.values[ 0 ] + "€ - " + ui1.values[ 1 ] + "€" );
    }
  });
  $( "#amount1" ).val( $( "#slider-range" ).slider( "values", 0 ) + "€" +
    " - " + $( "#slider-range" ).slider( "values", 1 ) + "€");
} );

$( function() {
  $( "#slider-range-min" ).slider({
    range: "min",
    value: 1,
    min: 1,
    max: 10,
    slide: function( event, ui ) {
      $( "#amount" ).val( ui.value );
    }
  });
  $( "#amount" ).val( $( "#slider-range-min" ).slider( "value" ) );
} );
