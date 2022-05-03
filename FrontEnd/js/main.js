function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
function openNav() {
    var count=0;
    if(count==0){
        document.getElementById("mySidebar").style.width = "187px";
        count=1;
    }
    else{
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }        
}
function postTable() {
    var x = document.getElementById("post").value;
    if (x !== "<--None-->")
        document.getElementById("post_table").style.display = "block";
    else
        document.getElementById("post_table").style.display = "none";
}