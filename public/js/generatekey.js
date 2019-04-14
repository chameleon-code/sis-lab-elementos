function generatePassword(){
    var text=document.getElementById("password");
    //var text2=document.getElementById("password-confirm");
    var t = base64(15);
    text.value=t;
    //text2.value=t;
}
function base64(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
    for (var i = 0; i < length; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
