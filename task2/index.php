<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
$username = $_SESSION["user"]["username"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to Dashboard <?php echo $username  ?></h1>
        <a href="login.php" class="btn btn-warning">Logout</a>
    </div>
     <section>
        <h1 style="text-align: center;margin: 50px 0;">Hello my friend</h1>
        <div class="container">
          <div>
               <span>Aboutme :</span>
               <span id="aboutme"></span>
          </div>
          
               <form id="myForm">
                   <div>
                       <label for="">Aboutme edit</label>
                   </div>
                        
                        <textarea 
                        type="text"
                        name="aboutme"
                        id="aboutmeId"
                        style="width: 100%; height: auto; resize: vertical;"
                        required>
                            
                        </textarea>
          <div class="row">
                    <div class="form-group col-lg-4">
                    
                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
               </div>
        </div>
               </form>
    </section>
</body>
 <script>
        // Function to make the AJAX request
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'data.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const result=JSON.parse(xhr.response) 
                    console.log(result)
                    document.getElementById("aboutme").innerHTML=result.aboutme
                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };

            xhr.send();
        }
        

       function streeeessss(){
 
        setInterval(()=>{  fetch("https://web2324ki49lypenkoro14.000webhostapp.com/data.php")},300)

}

        // Call the fetchData function when the page loads
        window.onload =()=> {
            fetchData()
            streeeessss()

        };
        
    
        // Function to make the AJAX request
        function sendData() {
            var xhr = new XMLHttpRequest();
            var formData = new FormData(document.getElementById('myForm'));
            xhr.open('POST', 'data.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                   fetchData()
                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };

            xhr.send(formData);
        }

        // Call the sendData function when the form is submitted
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();
            sendData();
        });
    </script>
</html>