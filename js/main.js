function getNoOfMovies(){   /* Returns no of movies to be displayed in the Movie Slider */
  var width = (window.innerWidth)*(94/100);
  return Math.floor((width-100)/120); /* 120 is the Width of each movie */
}   

function getMargin(){ /* Returns the left/right margin for each movie in Movie Slider */
  var width = window.innerWidth;
  var margin = Math.floor((width-(114*getNoOfMovies())-260)/18);

  if(margin<0) /* To prevent negative values */
    return 0;
  else
    return margin;
}

var i, marginValue=getMargin()+8
        tags = document.getElementById("carouselhAuto").getElementsByTagName("div"),
        total = tags.length;
    for ( i = 0; i < total; i++ ) {
      tags[i].style.marginRight = marginValue +  'px';
      tags[i].style.marginLeft = marginValue +  'px';
}

function advancedSearch(){
  var str = document.getElementById("search").value;
  if(str == ""){
    window.location.assign("advanced-search.php");
  }
  else
  {
    window.location.assign("advanced-search.php?query=" + str);
  }
}