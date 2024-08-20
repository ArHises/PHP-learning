<?php

namespace HW04\thirdTask;

class A {
    public function foo() {
    static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();

// $a1->foo();
// $a2->foo();
// $a1->foo();
// $a2->foo();

// > 1234
// Статика зависит от всех экземпляров данного класса

// Немного изменим п.5

namespace HW04\forthTask;

class A {
    public function foo() {
    static $x = 0;
    echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

// > 1234
// статика остается привязана к родительскому классу даже если она вызвана через дочерни зкземрляр