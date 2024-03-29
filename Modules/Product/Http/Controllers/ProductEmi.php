<?php

namespace Modules\Product\Http\Controllers;

use Modules\Product\Entities\Emi;
use Modules\Product\Entities\BankEmi;

trait ProductEmi
{
    public function get_emi_data($price)
    {
        return [
            new BankEmi('Standard Chartered Bank', 'SCB', [
                    new Emi(3, 3.63, $price),
                    new Emi(6, 5.82, $price),
                    new Emi(9, 8.70, $price),
                    new Emi(12, 11.73, $price),
                    new Emi(18, 15.61, $price),
                    new Emi(24, 21.21, $price),
                    new Emi(36, 29.03, $price),
                ],
                'VISA, MASTERCARD',
            ), 
            new BankEmi('Lanka Bangla Finance', 'LBF', [
                    new Emi(3, 3.63, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA, MASTERCARD',
            ), 
            new BankEmi('Shahjalal Islami Bank Limited', 'SIBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                ],
                'VISA, MASTERCARD',
            ), 
            new BankEmi('Dutch Bangla Bank Limited', 'DBBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('Southeast Bank Limited', 'SEBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('Standard Bank Limited', 'SBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('Mutual Trust bank Limited', 'MTB', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('Eastern Bank Limited', 'EBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('United Commercial Bank', 'UCBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(24, 18.34, $price),
                ],
                'VISA, MASTERCARD',
            ),
            new BankEmi('Bank Asia Limited', 'BAL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                ],
                'VISA',
            ),
            new BankEmi('Dhaka Bank Limited', 'DBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                ],
                'VISA',
            ),
            new BankEmi('Meghana Bank Limited', 'MeghanaBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                ],
                'VISA',
            ),
            new BankEmi('Jamuna Bank Limited', 'JBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('National Credit & Commerce Bank Limited', 'NCC', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                ],
                'VISA',
            ),
            new BankEmi('NRB Bank Limited', 'NRB', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                ],
                'VISA',
            ),
            new BankEmi('NRBC Bank Limited ', 'NRBC', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                ],
                'VISA',
            ),
            new BankEmi('South Bangla Agriculture Bank', 'SBAC', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('Midland Bank Limited', 'MDL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('Exim Bank Limited', 'Exim', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                ],
                'VISA',
            ),
            new BankEmi('Prime Bank Limited', 'Prime', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                ],
                'VISA',
            ),
            new BankEmi('Al-Arafah Islami Bank Limited', 'Arafah', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('Community Bank Bangladesh Limited ', 'Community', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(30, 19.76, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('Trust Bank Limited', 'Trust', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('One Bank LTD', 'One', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
            new BankEmi('Mercantile Bank Limited', 'MBL', [
                    new Emi(3, 3.09, $price),
                    new Emi(6, 4.71, $price),
                    new Emi(9, 6.95, $price),
                    new Emi(12, 9.29, $price),
                    new Emi(18, 12.99, $price),
                    new Emi(24, 18.34, $price),
                    new Emi(36, 24.22, $price),
                ],
                'VISA',
            ),
        ];
    }
}



