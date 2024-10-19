<?php

namespace code;

class Employee{
  private string $name;
  private int $age;
  private int $salary;

  public function __construct(string $name, int $age, int $salary){
    $this->name = $name;
    $this->age = $age;
    $this->salary = $salary;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName($value): void{
    $this->name = $value;
  }
  public function getAge(): string {
    return $this->age;
  }

  public function setAge($value): void{
    $this->age = $value;
  }
  public function getSalary(): string {
    return $this->salary;
  }

  public function setSalary($value): void{
    $this->salary = $value;
  }


  public static function getSalarySum(Employee $emp1, Employee $emp2): int {
    return $emp1->salary + $emp2->salary;
  }

  public function ageSort(Employee $empl): string {
    return ($this->getAge() > $empl->getAge()) ? "Старше " . $this->name . ' ' . $this->age . " лет" : "Старше " . $empl->name . ' ' . $empl->age . " лет";
  }

}

$employee_1 = new Employee('Олег', 25, 1000);
$employee_2 = new Employee('Мария', 26, 2000);

echo $employee_2->getSalary() + $employee_1->getSalary() . PHP_EOL;
echo Employee::getSalarySum($employee_1, $employee_2) . PHP_EOL;


// if ($employee_1->getAge() > $employee_2->getSalary()) {
//   echo $employee_1->getName() . '-' . $employee_1->getAge();
// } else {
//   echo $employee_2->getName() . '-' . $employee_2->getAge();
// }

echo $employee_1->ageSort($employee_2);