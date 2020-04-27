<?php

class Bank
{
  private $saldo;

  /**
   * Construct the bank account
   * 
   * @param Int $saldo The current saldo
   * 
   * @return void
   */
  public function __construct(Int $saldo)
  {
    $this->saldo = $saldo;
  }

  /**
   * Withdraw from the bank account saldo
   * 
   * @param Int $amount The amount to be withdrawn
   */
  public function withdraw(Int $amount) {
    if ($amount < 1) return;
    if ($amount > $this->saldo) return;

    $this->saldo -= $amount;
  }


  /**
   * Deposit to the bank account
   * 
   * @param Int $amount The amount to be deposited
   */
  public function deposit(Int $amount) {
    if ($amount < 1) return;

    $this->saldo += $amount;
  }

  
  /**
   * Get the current bank account saldo
   * 
   * @return Int The current saldo
   */
  public function getSaldo() {
    return $this->saldo;
  }

  /**
   * Exchange rates
   * 
   * @return Array Exchange rates
   */
  static function getExchangeRates() {
    return [
      'USD' => 8.45,
      'EUR' => 9.86,
      'GBP' => 11.2
    ];
  }
}
