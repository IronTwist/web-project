<footer>
    <div class="footerDiv">
        <a href="home_place.php">Home</a> - 
        <a href="myplace.php">MyPlace</a> - 
        <a href="profile.php">Profile</a>  
    </div>
    <!-- <div><a href="#headerLogo">Back to the top</a></div>-->
    <div class="friendReqSentReceived"><small>&copy; Copyright 2021, MyPlace Social Blogging platform by Fratean Radu Razvan</small></div> 
</footer>

    <script src="/css/bootstrap-4.5.3-dist/js/popper.min.js"></script>
    <script src="/css/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script>
        $(".textareaNote").keydown(function(e){
            if(e.keyCode === 9){
                console.log("Ai apasat tab");

                let start = this.selectionStart;
                let end = this.selectionEnd;

                $(this).val($(this).val().substring(0, start) + "\t" + $(this).val().substring(end));

                this.selectionStart = this.selectionEnd = start + 1;

                return false;
            }
        });
    </script>
    <script>
        function addCategory(category){

            let value = category.value;

            if(value == ""){
                alert("Category field can't be empty!");
            }else{
                var selCategory = document.getElementById('category');
                var option = document.createElement('option');
                option.appendChild( document.createTextNode(value));
                option.value = value;
                selCategory.appendChild(option); 
                category.value = "";
                document.getElementById('category').value = value;
            }   
        }
        
    </script>
    <script type="text/javascript" src="/javascript/functions.js"></script>
</body>

</html>
<?php
    if(isset($connection)){
        $connection->close();
    }
?>
