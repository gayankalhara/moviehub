
<body onload="rate()">

<script>
function rate()

{
  var starrate = document.getElementById("rating").innerHTML;
  starrate=Math.round(starrate*(125/10));
  document.getElementById("Stars1").style.width=starrate+"px";
}

</script>
<style type="text/css">
  #Stars1
{
  width: 0px;
  height:100px;
  float:right;

  overflow: hidden;
  z-index: 1;
  margin-top: 30px;

}

#Stars2
{
  margin-top: 30px;
  width: 200px;
  height: 100px;

  z-index: -1;
  overflow: hidden;
}

#ratingcont
{

  width: 200px;
  float:left;
  margin-left: -33px;
}

#rating
{
  line-height: 90px;
  display: inline-block;
  font-size:25px; 
  height:70px; 
  line-height:70px;
  position: relative;
  left: 140px;
}


</style>
<?php
function rating($new)
{
		echo '<div id="ratingcont">
  				<div style="position: relative; left:35px ;top:-7px;">	
    				<div style="position: absolute; top: 0; left: 0; " id="Stars1">
  						<img src="img/star-yellow.png">
  					</div>
	 				<div style="position: absolute; top: 0; left: 0; ;" id="Stars2">
  						<img src="img/star-black.png">
    				</div>
  				</div>
		</div>
    <div id="rating">'.$new.
    '</div>  ';
    }