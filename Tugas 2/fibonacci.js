const fibonacciGenerator = function* (n) {
    let a = 0, b = 1;
    for (let i = 0; i < n; i++) {
        yield a;
        [a, b] = [b, a + b];
    }
};

console.log([...fibonacciGenerator(22)]);