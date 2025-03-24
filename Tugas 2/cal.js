const calculator = (operator, ...numbers) => {
    let result;
    switch (operator) {
        case '+':
            result = numbers.reduce((acc, num) => acc + num, 0);
            break;
        case '-':
            result = numbers.reduce((acc, num) => acc - num);
            break;
        case '*':
            result = numbers.reduce((acc, num) => acc * num, 1);
            break;
        case '/':
            result = numbers.reduce((acc, num) => acc / num);
            break;
        case '%':
            result = numbers.reduce((acc, num) => acc % num);
            break;
        default:
            return "Operator tidak valid";
    }
    return result * 100; 
};


console.log(calculator('+', 1, 2, 3));  
console.log(calculator('-', 10, 2, 1)); 
console.log(calculator('*', 2, 3));     
console.log(calculator('/', 100, 2));   
console.log(calculator('%', 105, 10));  
