<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Asynchronous Form</title>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

      <style>
      #result {
        display: none;
      }
      .error{
          border: 1px solid red;
      }

   #spinner{
       display: none;
   }

    </style>
  </head>
  <body>

    <div id="measurements">
      <p>Enter measurements below to determine the total volume.</p>
      <form id="measurement-form" action="process_measurements.php" method="POST">
        Length: <input type="text" name="length" /><br />
        <br />
        Width: <input type="text" name="width" /><br />
        <br />
        Height: <input type="text" name="height" /><br />
        <br />
        <input id="html-submit" type="submit" value="Submit" />
<!--        <input id="ajax-submit" type="button" value="Ajax Submit" />-->
      </form>
    </div>

    <div id="spinner">
        <img src="spinner.gif" alt="" width="50" height="50">
    </div>

    <div id="result">
      <p>The total volume is: <span id="volume"></span></p>
    </div>

    <script>

      var result_div = document.getElementById("result");
      var volume = document.getElementById("volume");
      var button = document.getElementById("html-submit");
//      var button =$.("#ajax-submit");

      function showSpinner () {
          $("#spinner").show(1000);

      }

      function hideSpinner () {
          $("#spinner").hide(1000);

      }
      
      function disableSubmitButton() {
//              $( "#ajax-submit" ).prop( "disabled", true ).val( "Loading..." );
//          button.prop( "disabled", true ).val( "Loading..." );

//          var button = document.getElementById("ajax-submit");
          button.disabled=true;
//          $( "#ajax-submit" ).val( "Loading..." );

      }


      function enableSubmitButton() {
//              $( "#ajax-submit" ).prop( "disabled", false ).val( "Ajax Submit" );
//          button.prop( "disabled", false ).val( "Ajax Submit" );

//          var button = document.getElementById("ajax-submit");
          button.disabled=false;

      }
      function displayErrors(errors) {
          var inputs = document.getElementsByTagName('input');
          for(i=0; i < inputs.length; i++) {
              var input = inputs[i];
              if(errors.indexOf(input.name) >= 0) {
                  input.classList.add('error');
              }
          }
      }


        function clearErrors() {
            var inputs = document.getElementsByTagName('input');
            for(i=0; i < inputs.length; i++) {
                 inputs[i].classList.remove('error');

            }
        }
      
      
      function postResult(value) {
        volume.innerHTML = value;
        result_div.style.display = 'block';
      }

      function clearResult() {
        volume.innerHTML = '';
        result_div.style.display = 'none';
      }

      function calculateMeasurements() {
          clearResult();
          clearErrors();
          showSpinner ();
          disableSubmitButton();


          var form = document.getElementById("measurement-form");
          var action = form.getAttribute("action");
          // determine form action
          // gather form data
//          var form_data=gatherFormData(form);
          var form_data = $('#measurement-form').serializeArray();
//          console.log(form_data);

          $.post(action, form_data, function (data, status, xhr) {
              xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              if (xhr.readyState == 4 && xhr.status == 200) {
                  hideSpinner();
                  enableSubmitButton();
//                  var result = data;
                  var json=data;
//                  postResult(result);
                  if(json.hasOwnProperty('errors') && json.errors.length>0){
                      displayErrors(json.errors)
                  }else {
                      $( "ajax-submit" ).prop( "disabled", false );

                      postResult(json.volume);
                  }

                  console.log('Result: ' + result);
              }
          },'json');

      }


      button.addEventListener("click", function (event) {
          event.preventDefault();
          calculateMeasurements();
      });


    </script>

  </body>
</html>
