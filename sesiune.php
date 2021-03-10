<h1>Just for debugging</h1>
<body onload="loadComments(453)">

</body>
<?php

    session_start();

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
    
    // $filename = "myfile.txt";
    // $file = fopen($filename,"a+");

    // $filesize = filesize($filename);
    // $filedata = fread($file, $filesize);


    // echo $filedata;

    // $array = explode("t",$filedata);

    // print_r($array);

    /**
     * Algoritm incarcare mai multe
     */

    $comments = [
        1 => "unu",
        2 => "doi",
        3 => "trei",
        4 => "patru",
        5 => "cinci",
        6 => "sase",
        7 => "sapte",
        8 => "opt",
        9 => "noua",
        10 => "zece"
    ];


    // print_r($comments);

    if (isset($_GET["start"]) && isset($_GET["end"])) {
        $start = $_GET["start"];
        $end = $_GET["end"];
    }else{
        $_GET["start"] = 0;
        $_GET["end"] = 4;
        $start = $_GET["start"];
        $end = $_GET["end"];
        header(("Location: sesiune.php?start=$start&end=$end"));
        
    }   

    $count = 0;
    foreach ($comments as $comment) {
        if ($count < $end) {
            echo $comment."</br>";
        } else {
            $pana = $end+4;
            echo "<a href=\"sesiune.php?start=$start&end=$pana\">Incarca urmatoarele</a>";
            exit;
        }
        $count++;
    }
?>

<ul id="ul">
       
</ul>

<script>
var arrayColectat = [];

function loadComments(postId){
    let comments = [];

	var request=new XMLHttpRequest();
	request.onreadystatechange=function() {
		if (request.readyState == 4)
			if (request.status == 200){

                var arr = JSON.parse(request.response);
                
                var i = 0;
                while(i < arr.length){
                    arrayColectat.push(arr[i]);
                    i++;
                }

                document.getElementById("ul").innerHTML += "<li>"+arr[0].comment+"</li>";
                document.getElementById("ul").innerHTML += "<li>"+arr[1].comment+"</li>";
				
			}
			else 
                emailExist=parseInt(0);
	}

	request.open("GET","/includes/loadComments.php?postId="+postId,true);
	request.send("");
}

</script>
<button id="incrementor" onclick="loadMore(arrayColectat)">Load more comments</button>
<script>


var start = 2;
var end = 4;

function loadMore(data){
    
    while(start < end){
        
            if(data[start] != undefined){
            document.getElementById("ul").innerHTML += "<li>"+data[start].comment+"</li>";
            // console.log(data[start]);
            }
            start++;
    }

    end  += 2;
  
}

</script>