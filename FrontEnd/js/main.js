const closeNav = () => {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
const openNav = () => {
    let count=0;
    if(count==0){
        document.getElementById("mySidebar").style.width = "187px";
        count=1;
    }
    else{
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }        
}
// const postTable = () => {
//     let x = document.getElementById("post").value;
//     if (x !== "<--None-->")
//         document.getElementById("post_table").style.display = "block";
//     else
//         document.getElementById("post_table").style.display = "none";
// }

// registration
const selector = () => {
    let x;
    x = document.querySelector("input[name='special_child']:checked").id;
    if ( x == 'special_child1' ){
        document.getElementById('sp_ch').style.display = 'block';
        document.getElementById('sp_ch1').style.display = 'block';
    }
    else{
        document.getElementById('sp_ch').style.display = 'none';
        document.getElementById('sp_ch1').style.display = 'none';
    }
}