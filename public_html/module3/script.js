var nums = [];
var u = [];

//DONE
function calcMean() {
    var mean = parseFloat(calcSum()/parseFloat(nums.length)).toFixed(2);
    return parseFloat(mean).toFixed(2);
}
//DONE
function calcMedian() {
        var median = 0.0;

        
    if(nums.length%2==0){
            median = (parseFloat(nums[parseInt(nums.length/2)]) +parseFloat(nums[parseInt(nums.length/2)-1]))/2;
    } else {
        median = parseFloat(nums[parseInt(nums.length/2)]);
    }
    return median.toFixed(2);
}

function there(value){
    var t = false;
    
    for(j = 0; j < u.length; j++){
       // alert(u[j] + " " + );

        if(u[j] == value){
            t = true;
        }

        
    }
    //alert("ran");
    return t;
}
//DONE
function calcMode() {

    var count = 0;
    var counts = [];
    //gets all the unique values
    for(i =0; i < nums.length; i++) {
        if(!there(nums[i])){
            u.push(nums[i]);
        }
    }

    //counts each individual value
    for(i = 0; i < u.length; i++){
        for(j=0; j < nums.length; j++){
            if(u[i]==nums[j]){
                count++;
            }
        }
        counts.push(count);
        count = 0;
    }

    var max = 0;

    //finds the max
    for(i =0; i< counts.length; i++){
        if(parseInt(counts[i]) > max){
            max = parseInt(counts[i]);
        }
    }
    var median = "";
    //gets the indexs
    for(i = 0; i < counts.length; i++){
        if(parseInt(counts[i]) == max && max != 1){
            median = median + " " + u[i];
        }
    }

    if(max == 1){
        median = "No Mode";
    }
   // alert(max);


    return median;
   
}
//DONE
function calcStdDev() {

    return parseFloat(Math.sqrt(calcVariance())).toFixed(2);
}
//DONE
function calcSum() {
    var sum = 0.0;
    for(i = 0; i < nums.length; i++){
        sum = sum + parseFloat(nums[i]);
    }

    return sum.toFixed(2);

}

function calcVariance() {
    var vari = 0.0;
    var temp = 0.0;
    var mean = calcMean();
    for(i = 0; i < nums.length; i++) {

       temp = parseFloat(nums[i]).toFixed(2) - mean;
        temp = temp * temp;
        vari = vari + temp;

    }

    return parseFloat(vari/nums.length).toFixed(2);
}
//DONE
function findMax() {
    var max = 0.0;
    for(i = 0; i < nums.length; i++){
        if(parseFloat(nums[i]) > max) {
                max = parseFloat(nums[i]).toFixed(2);
        }
    }

    return max;
}
//DONE
function findMin() {

    var min = parseFloat(nums[0]);
    for(i = 0; i < nums.length; i++){
        if(parseFloat(nums[i]) < min) {
                min = parseFloat(nums[i]);
        }
    }

    return min.toFixed(2);
}

function performStatistics(){
    fillArray(document.getElementById("area").value);
    document.getElementById("Mean").value = calcMean();
    document.getElementById("Sum").value = calcSum();
    document.getElementById("Max").value = findMax();
    document.getElementById("Min").value = findMin();
    document.getElementById("Vari").value = calcVariance();
    document.getElementById("Std").value = calcStdDev();
    document.getElementById("med").value = calcMedian();
    document.getElementById("mode").value = calcMode();
    nums = [];
    u = [];
    document.getElementById("area").value="";
    
}

function n(value){
    var bol = true;

    if(value == "0" || value == "1" || value == "2" || value == "3" || value == "4" || value == "5" ||value == "6" || value == "7" ||value == "8" || value == "9" || value == " "){
    } else {
   
        bol = false;
    }


    return bol;
}

function fillArray(number){
       
        var temp = "";
        for(i = 0; i < number.length; i++){

            if(!n(number.charAt(i))) {
                alert("Please only enter numbers");
                break;
            }
                if(number.charAt(i) == " " && temp != ""){
                  
                       nums.push(temp);
                        temp="";
                } else if(i == number.length-1){
                  
                    temp = temp+number.charAt(i);
                    nums.push(temp);
                } else if(number.charAt(i) == " " && temp == "") {
                  
                }else {
                  
                    temp = temp+number.charAt(i);
                  
                } 
        }

       
        for(i=0; i < number.length-1;i++){

            for(j = 0; j < number.length-1; j++){
            if(parseFloat(nums[j]) > parseFloat(nums[j+1])){
                    temp = nums[j];
                    nums[j] = nums[j+1];
                    nums[j+1] = temp;
            }
        }
        }

       //alert(nums);
}
