//DONE
function testLength(value,length,exactLength) {
        if(value.length == length){
            exactLength = true;
        } else {
            exactLength = false;
        }

        return exactLength;
}
//DONE
function testNumber(value) {
        var state = true;

        for(var i = 0; i < value.length; i++){
           
            if(!Number.isInteger(parseInt(value.toString().charAt(i),10))){
                state = false;
            } 
        }
      

        return state;
}
//DONE
function validateEmail(value){
    var correct = false;
    const regex = /[a-zA-Z0-9]+@[a-z]+.com/
    
    if(regex.test(value)){
        correct = true;
    } else{
      alert("Email: Email is not correct!");
    }


    return correct;
}
//DONE
function validateCreditCard(value) {
    var correct = true;
    var str = value.split(" ").join('');
    var ch = str.toString().charAt(0)
   
    //NUmber Test
    if(testNumber(str)){
    } else{
        correct = false;
        alert("Card Number: Not a number!");
    }
   
    
    //First Digit
    if(ch == "6"||ch == "5"||ch == "4"||ch== "3"){
    } else {
        correct =false;
        alert("Card Number: Enter valid first digit!");
    }
    //Length Tester
    //Amex
    if(ch== "3"&&testLength(str.toString(),15,false)){
    //Discover, MasterCard, Visa
    } else if((ch== "6" ||ch== "5" ||ch== "4")&& testLength(str.toString(),16,false)){
    } else {
        alert('Card Number: Incorrect Length!');
        correct = false;
    }

    return correct;

}
//DONE
function validateState(){
    var correct = true;
    if(document.getElementById("state").value.toString() == "" || document.getElementById("state").value.toString() == "Select State"){    
        correct =false;
        alert("Select a correct state");
    } else {
    
    }

    return correct;
}

//DONE
function validateControl(control,name,length){
    var worked = true;

    if(name.toString() == "zip"){
        if(testLength(control.toString(),5,false) && testNumber(control)){
        } else{
            alert("Zip Code: Error with Zip Code");
            worked = false;
        }
    } else if(name.toString() == "csv"){
            if(testLength(control.toString(),3,false) && testNumber(control)){
            } else{
                alert("CSV: Error with CSV");
                worked = false;
            }
    }

    return worked;
}
//DONE
function validatePassword(value,minLength){
    var worked = true;

    if(testLength(value.toString(),minLength) || value.toString().length > minLength) {
    } else {
        worked = false;
        alert("Password: Password needs to be greater than or equal to 6 charactetrs")
    }

    return worked;
}

function updateForm(control) {
   var x = document.getElementById('pay');
   var y = document.getElementById('credit');
    if(control.id == "r2"){
         x.style.display = "block";
         y.style.display = "none";
    } else {
        y.style.display = "block";
        x.style.display = "none";
    } 
}
//DONE
function validateDate(value){
    var correct = true;
   var res = value.toString().slice(0,4);
   var res2 = value.toString().slice(5,7);
   if(parseInt(res,10) > 2017){
       if(parseInt(res,10) === 2018 && parseInt(res2,10) > 9){
       } else if(parseInt(res,10) > 2018){
       }else{
           correct = false;
           alert('Month too early');
       }

   } else{
       alert("Year too early");
       correct = false;
   }
   return correct;
}

//done
function validateForm() {

    var work = true;

    var r1 = document.getElementById("r1");
    var r2 = document.getElementById("r2");

    if(r1.checked == true ){

   if(validateDate(document.getElementById("date").value)){
   } else {
       work =false;
   }
    if(validateCreditCard(document.getElementById("number").value)){
    } else {
       work = false;
    }
    if(validateEmail(document.getElementById("email").value)){
    } else {
     work = false;
    }
    if(validateState()){
    } else {
        work =false;
    }

    //zip code
    if(validateControl(document.getElementById("zip").value,"zip",5)){
    } else {
        work =false;
    }

     //csv
     if(validateControl(document.getElementById("csv").value,"csv",3)){
    } else {
        work =false;
    } 

    //make sure the feilds arent empty
    

    //first name
    if(document.getElementById("f").value == ''){
        work = false;
        alert("Please enter a first name");
    } 

    
    //last name
    if(document.getElementById("l").value == ''){
        work = false;
        alert("Please enter a last name");
    }
    //address
    if(document.getElementById("a").value == ''){
        work = false;
        alert("Please enter an address");
    }
    //city
    if(document.getElementById("c").value == ''){
        work = false;
        alert("Please enter a city");
    }
    //name on card
    if(document.getElementById("n").value == ''){
        work = false;
        alert("Please enter a card name");
    }
    

    }

    if(r2.checked == true) {
        if(validateEmail(document.getElementById("emai").value)){
        } else {
            work = false;
        }

        if(validatePassword(document.getElementById("pass").value,6)){
        } else{
            work = false;
        }
    }
   
    return work;
}

