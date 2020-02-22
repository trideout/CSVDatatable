<?php
namespace redcat\Contracts;

abstract class Validation {
    abstract public function __construct($data);
    abstract public function validate(): bool;
}