<?php

interface AbstractFactory {
    public function createProductA(): AbstractProductA;
    public function createProductB(): AbstractProductB;
}

class ConcreteFactory1 implements AbstractFactory {
    public function createProductA(): AbstractProductA {
        return new ConcreteProductA1;
    }

    public function createProductB(): AbstractProductB {
        return new ConcreteProductB1;
    }
}

class ConcreteFactory2 implements AbstractFactory {
    public function createProductA(): AbstractProductA {
        return new ConcreteProductA2;
    }

    public function createProductB(): AbstractProductB {
        return new ConcreteProductB2;
    }
}

interface AbstractProductA {
    public function usefulFunctionA(): string;
}

class ConcreteProductA1 implements AbstractProductA {
    public function usefulFunctionA(): string{
        return "The result of product A1.";
    }
}

class ConcreteProductA2 implements AbstractProductA {
    public function usefulFunctionA(): string{
        return "The result of product A2.";
    }
}

interface AbstractProductB {
    public function usefulFunctionB(): string;
    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string;
}

class ConcreteProductB1 implements AbstractProductB {
    public function usefulFunctionB(): string {
        return "The result of product B2.\n";
    }

    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string {
        $result = $collaborator->usefulFunctionA();

        return "The result of product B2 with collaboration of ({$result})";
    }
}

class ConcreteProductB2 implements AbstractProductB {
    public function usefulFunctionB(): string
    {
        return "The result of product B2.\n";
    }

    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();

        return "The result of product B2 with collaboration of ({$result})";
    }
}

function clientCode(AbstractFactory $factory) {
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB();
    echo $productB->anotherUsefulFunctionB($productA);
}

echo "Testing client code with first AbstractFactory type:\n";
clientCode(new ConcreteFactory1());

echo "\n";

echo "Testing client code with second AbstractFactory type: \n";
clientCode(new ConcreteFactory2());