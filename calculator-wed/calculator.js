"use strict"
window.onload = function () {
    var stack = [];
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;
            if(stack[stack.length-1]=="=") {
                stack = [];
                displayVal = "0";
                document.getElementById('expression').innerHTML = "0";
            }
            if(value=="AC") {
                displayVal = "0";
                stack = [];
                document.getElementById('expression').innerHTML = "0";
            } else if(/^\d$/.test(value)) {
                if(stack[stack.length-1]=="!") {
                    alert("ERROR : input operator right after input !(factorial)");
                } else {
                    if(displayVal.charAt(0)=="0") {
                        displayVal = value;
                    } else {
                        displayVal += value;
                    }
                }
            } else if(value==".") {
                if(!(/.\.?./.test(displayVal))) {
                    displayVal += value;
                }
            } else {
                if(stack[stack.length-1]=="!") {
                    stack.pop();
                    displayVal = "";
                } else {
                   stack.push(parseFloat(displayVal));
                }
                var displayExp;
                displayExp = displayVal + value;
                if(document.getElementById('expression').innerHTML.charAt(0)=="0") {
                    document.getElementById('expression').innerHTML = displayExp;                    
                } else {
                    document.getElementById('expression').innerHTML += displayExp;    
                }
                displayVal = "0";
                if(/(\/|\*|\^)/.test(stack[stack.length-2])) {
                    highPriorityCalculator(stack, value);
                }
                if(value=="!") {
                    stack.push(parseFloat(factorial(stack.pop())));
                    stack.push(value);
                } else if(value=="=") {
                    displayVal = calculator(stack);
                    stack.push(value);
                } else {
                    stack.push(value);
                }
            }
            document.getElementById('result').innerHTML = displayVal;
        };
    }
};
function factorial (x) {
    if(x==1) {
        return 1;
    } else {
        return x*factorial(x-1);
    }
}
function highPriorityCalculator(s, val) {
    var opernand2 = s.pop();
    var operator = s.pop();
    var opernand1 = s.pop();

    var result;
    if(operator=="*") {
        result = opernand1 * opernand2;
    } else if(operator=="/") {
        result = opernand1 / opernand2;
    } else if(operator=="^") {
        result = Math.pow(opernand1, opernand2);
    }
    s.push(parseFloat(result));
}
function calculator(s) {
    var result = 0;
    var operator = "+";

    s.reverse();
    var iter = s.length;
    for (var i=0; i< iter; i++) {
        if(i%2==0) { //at even times
            if(operator == "+") {
                result = result + parseFloat(s.pop());
            } else if(operator == "-") {
                result = result - parseFloat(s.pop());
            }
        } else { //at odd times
            operator = s.pop();
        }
    }
    return result;
}
