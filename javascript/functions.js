 //MyPlace javascript functions
 
 /**
 * Show user with first letter uppercase
 */
function changeUserLogo(value){
    var username = value;
    var fC = "";
    
    var spatiu = 0;
    for(var i=0; i < username.length; i++){
        if(i == 0){
            fC += username[i].toUpperCase();
            
        }else if(username[i] == " "){
            fC += username[i]
            spatiu = 1;
        }else if(spatiu == 1){
            fC += username[i].toUpperCase();
            spatiu = 0;
        }else{
            fC += username[i];
        }
        
    }
    
    return fC;
}

var user = document.getElementById("usernameLogo").innerText;
document.getElementById("usernameLogo").innerText = changeUserLogo(user);

// Show numbers of posts
if(document.getElementById("getNUmberOfPosts") != null){
    var numberOfPosts = document.getElementById("getNUmberOfPosts").innerText;
    var showElement = document.getElementById("showNumberOfPosts");
    showElement.innerHTML = numberOfPosts;
    showElement.style.marginLeft = "30px";
}
