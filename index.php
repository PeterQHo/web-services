<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}
  
  .pokemon{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	max-width:50px;
  }

  
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function pokemonTemplate(pokemon) {
  return `
        <div class="pokemon">
        <b>PokemonName</b>: ${pokemon.PokemonName}<br />
        <b>Type</b>: ${pokemon.Type}<br />
        <b>Abilities</b>: ${pokemon.Abilities}<br />
        <b>Weakness</b>: ${pokemon.Weakness}<br />
        <b>Evolution</b>: ${pokemon.Evolution}<br />
        <div class="pic"><img src="thumbnails/${pokemon.Image}" /></div>
      </div>
  `;
} 



  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

     //place data.title on page
     $("#pokemontitle").html(data.title);

     //clear previous films
     $("#pokemon").html("")

    //loop through data.films and place on page 
    $.each(data.pokemon,function(i,item){
      let myData = pokemonTemplate(item);
      $("<div></div>").html(myData).appendTo("#pokemon");
    });
     
    /*
    let myData = JSON.stringify(data,null,4);
    myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData);
    */

     
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 



</script>
</head>
	<body>
	<h1> Web Service</h1>
    <p>Creating a webpage with a list of pokemon and sorting them by two different types either by names or types. This is done by a initial jQuery with wiring to a click event on a tags with a class of category. Using JSON.stringify() to place pre-formatted text on the page and than use CSS to style the text. When the click the page will show eachs sort and when click the the page will clear the previous data. This is accomplishe by using  $("#pokemon").html(""). </p>
		<a href="poke" class="category">Pokemon By Name</a><br />
		<a href="type" class="category">Pokemon by Type</a>
		<h3 id="pokemontitle">Title Will Go Here</h3>
		<div id="pokemon">
      <!--
      <div class="film">
        <b>Film</b>: 1<br />
        <b>Title</b>: Dr. No<br />
        <b>Year</b>: 1962<br />
        <b>Director</b>: Terence Young<br />
        <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br />
        <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br />
        <b>Composer</b>: Monty Norman<br />
        <b>Bond</b>: Sean Connery<br />
        <b>Budget</b>: $1,000,000.00<br />
        <b>BoxOffice</b>: $59,567,035.00<br />
        <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
      </div>
      -->
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
