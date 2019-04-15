<?php namespace App\Tests;

use App\Tests\AcceptanceTester;


class HomePageTest extends \Codeception\Test\Unit
{
    public function homePageContent(AcceptanceTester $I){
        $I->amOnPage('/');
        $I->see('/homepage/');
        $I->click('Questions');
        $I->see('/vote/');
  }
    public function votePageContent(AcceptanceTester $I){
        $I->amOnPage('/vote/');
        $I->see('/Vote Index/');
        $I->click('VOTE');
        $I->see('/vote/{id}/');
    }
    public function PollingTest(AcceptanceTester $I){
        $I->amOnPage('/polling/new/{id}/');
        $I->click('Save');
    }
}