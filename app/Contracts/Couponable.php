<?php

namespace App\Contracts;

interface Couponable
{
    public function discount($amount);
    public function type();
    public function coupon();
}