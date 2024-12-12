function check(){
    var fname=document.fname.value;
    alert(""+fname);
}
function validateForm(){
  let x = document.forms["users"]["cpass"].value;
  let y = document.forms["users"]["pass"].value;
  if (x != y) {
    alert("Confirm Password Doesn\'t match");
    return false;
}
}