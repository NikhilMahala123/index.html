function myFunction1() {
    var x = document.getElementById("ansid");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
  }


  var first=document.getElementsByClassName("que")[0];
  first.addEventListener("click" , myFunction1);

// function myFunction1() {
//     var element = document.getElementById("ansid");
//     element.classList.toggle("show_content")
//   }

function myFunction2() {
    var y = document.getElementById("ansid2");
      if (y.style.display === "none") {
        y.style.display = "block";
      } else {
        y.style.display = "none";
      }
  }


  var fir=document.getElementsByClassName("que2")[0];
  fir.addEventListener("click" , myFunction2);



  function myFunction3() {
    var y2 = document.getElementById("ansid3");
      if (y2.style.display === "none") {
        y2.style.display = "block";
      } else {
        y2.style.display = "none";
      }
  }


  var fire=document.getElementsByClassName("que3")[0];
  fire.addEventListener("click" , myFunction3);





    var classadd = document.getElementById("block-productfeatures");
    classadd.classList.add("wow");

    var classad = document.getElementById("block-productfeatures");
    classad.classList.add("fadeInUp");




    // var cla = document.getElementById("block-webform");
    // cla.classList.add("wow");

    // var classa = document.getElementById("block-webform");
    // classa.classList.add("fadeInUp");
