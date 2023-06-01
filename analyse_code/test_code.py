def factorial(n):
    if n == 0 or n == 1:
        return 1
    else:
        return n * factorial(n-1)

def greet(name):
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")    
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")
    print("Hello, " + name + "!")

def factorial2(n):
    if n == 0 or n == 1:
        return 1
    else:
        return n * factorial(n-1)

def is_prime(num):
    if num < 2:
        return False
    for i in range(2, int(num**0.5) + 1):
        if num % i == 0:
            return False
    return True

def calculate_sum(a, b):
    a = b
    return a + b

def main():
    greet("Hugo")
    x = 5
    y = 10
    print("Sum:", calculate_sum(x, y))

if __name__ == "__main__":
    main()