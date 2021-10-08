function Delete(){
    if(window.confirm("Do You really want to delete !")){
        
        return true;
    }
    return false;

}

function validL(){
    var user=document.forms['loginForm']['email'];
    var password=document.forms['loginForm']['pass'];
    if(user.value==''){
        window.alert("This Field Can't be Empty !");
        user.focus();
        return false;

    }
    if(user.value.indexOf('@')<0){
        window.alert("Please Enter Your Valid Email Address :");
        user.focus();
        return false;

    }
    if(user.value.indexOf('.com')<0){
        window.alert("Please Enter Your Valid Email Address");
        user.focus();
        return false;

    }
    if(password.value==''){
        window.alert("Password Is Mandetory !");
        password.focus();
        return false;

    }
    return true;

}

function valid(){
    var fullName=document.forms['registrationForm']['fullname'];
    var email=document.forms['registrationForm']['email'];
    var mobile=document.forms['registrationForm']['mobile'];
    var password=document.forms['registrationForm']['password'];
    var conPassword=document.forms['registrationForm']['conPass'];


    var pass=/^(?=.*[0-9])(?=.*[!@])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    var mobNo=/^(?=.*[0-9])/;


    
    if(fullName.value==''){
        window.alert("Please Enter Your name");
        fullName.focus();
        return false;

    }
    if(email.value==''){
        window.alert("Please Enter Your Email Address !");
        email.focus();
        return false;

    }
    if(email.value.indexOf('@')<0){
        window.alert("Please Enter a Valid Email Address !");
        email.focus();
        return false;

    }
    if(email.value.indexOf('.com')<0){
        window.alert("Please Enter a Valid Email Address !");
        email.focus();
        return false;

    }
    if(mobile.value==''){
        window.alert("Please Enter Your Mobile Number !");
        mobile.focus();
        return false;

    }
    if(mobile.value.length!=10){
        window.alert("Please Enter Valid Mobile Number !");
        mobile.focus();
        return false;

    }
    if(!mobNo.test(mobile.value)){
        window.alert("Please Enter Valid Mobile Number !");
        mobile.focus();
        return false;

    }
    if(password.value==''){
        window.alert("Please Enter Your Password !");
        password.focus();
        return false;

    }
    if(!pass.test(password.value)){
        window.alert("Please Enter a Valid Password !");
        password.focus();
        return false;

    }
    if(password.value!=conPassword.value){
        window.alert("Please Enter Recheck Password !");
        conPassword.focus();
        return false; 
    }

    return true;
}



function buyNow()
{
    var qty=document.forms['buy_form']['p_qty'];
    var cust_name=document.forms['buy_form']['cust_name'];
    var pin=document.forms['buy_form']['d_pin'];
    var h_no=document.forms['buy_form']['h_no'];
    var d_area=document.forms['buy_form']['d_area'];
    var d_city=document.forms['buy_form']['d_city'];
    var d_state=document.forms['buy_form']['d_state'];
    var mobile=document.forms['buy_form']['mobile'];
    var pin_code=/^(?=.*[0-9])/;
    var mob= /^(?=.*[0-9])/;





    if(qty.value==""){
        window.alert("this field can't be empty");
        qty.focus();
        return false;
    }
    if(qty.value<1){
        window.alert("Please Enter 1 or greater number");
        qty.focus();
        return false;
    }
    if(cust_name.value==""){
        window.alert("this field can't be empty");
        cust_name.focus();
        return false;
    }
    if(pin.value==""){
        window.alert("this field can't be empty");
        pin.focus();
        return false;
    }
    if(!pin_code.test(pin.value)){
        window.alert("Please Enter Valid pin Number !");
        pin.focus();
        return false;

    }
    if(pin.value.length!=6){
        window.alert("Please Enter Valid pin Number !");
        pin.focus();
        return false;

    }
    if(h_no.value==""){
        window.alert("this field can't be empty");
        h_no.focus();
        return false;
    }
    if(d_area.value==""){
        window.alert("this field can't be empty");
        d_area.focus();
        return false;
    }
    if(d_city.value==""){
        window.alert("this field can't be empty");
        d_city.focus();
        return false;
    }
    if(d_state.value==""){
        window.alert("this field can't be empty");
        d_state.focus();
        return false;
    }
    if(mobile.value==""){
        window.alert("this field can't be empty");
        mobile.focus();
        return false;
    }
    if(!mob.test(mobile.value)){
        window.alert("Please Enter Valid mobile Number !");
        mobile.focus();
        return false;

    }
    if(mobile.value.length!=10){
        window.alert("Please Enter Valid mobile Number !");
        mobile.focus();
        return false;

    }
    return true;
}

function calTotalPrice(){
    var qty=document.forms['buy_form']['p_qty'];
    var price=document.forms['buy_form']['price'];
    var total=document.getElementById("totalAmount");
    if(qty.value==""){
        total.value=0;
    }
    else
    {
        total.value=qty.value*price.value;
    }


}