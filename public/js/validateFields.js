var passFlag=false;
function revelate(){
    if(passFlag==false){
        passFlag=true;
        document.getElementById('pass').type="text";
        document.getElementById('eye').className="fa fa-eye-slash"
    }else{
        passFlag=false;
        document.getElementById('pass').type="password";
        document.getElementById('eye').className="fa fa-eye"
    }
}
// function validatePassword(event){
//     console.log(document.getElementById('pass').value);
// }